<?php

    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');
    require_once('../php/apiDistance.php');
    require_once('../php/utils.php');



    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $returnJSON = array(
        "status" => null,
        "txt" => null,
        "dataFree" => null,
        "dataTake" => null,
        "dataDone" => null
    );


    $type = trim(htmlspecialchars($obj['type']));
    $idAccount = trim(htmlspecialchars($obj['idAccount']));

    if($type == "requester"){

        $returnJSON['status'] = true;
        $Query1 = $dbh->query("SELECT requester.id FROM requester WHERE id_account = ".$idAccount);
        $idTypeAccount = $Query1->fetch(PDO::FETCH_ASSOC);
        $idTypeAccount = $idTypeAccount['id'];

        //Free
        $WorkQuery = $dbh->query("  SELECT work.id,title, id_type, description, id_requester, min_age_worker, date_start, time_start, time_end, place, statut_progress, name as type, price
                                        FROM work JOIN type_work 
                                        ON work.id_type = type_work.id 
                                        WHERE id_requester = ".$idTypeAccount." AND id_worker is NULL AND finish = 0 AND cancelled =0 ORDER by date_start");

        $worksFree = $WorkQuery->fetchAll(PDO::FETCH_ASSOC);
        $WorkQuery->closeCursor();

        $returnJSON['dataFree'] = $worksFree;

        //Take
        $WorkQuery1 = $dbh->query("SELECT work.id as id, title, description, id_worker, date_start,time_start,time_end,place, type_work.name as type, id_account,star,city,first_name,last_name,birth_date,profile_path,price
                                    FROM work
                                    JOIN type_work on work.id_type = type_work.id
                                    JOIN worker on id_worker = worker.id
                                    JOIN account on worker.id_account = account.id
                                    WHERE work.id_requester = ".$idTypeAccount." AND id_worker is NOT NULL AND finish = 0 AND cancelled =0 ORDER by date_start");

        $worksTake = $WorkQuery1->fetchAll(PDO::FETCH_ASSOC);
        $WorkQuery1->closeCursor();

        $returnJSON['dataTake'] = $worksTake;


        //Done
        $WorkQuery = $dbh->query("SELECT work.id as id, title, description, id_worker, date_start,time_start,time_end,place, type_work.name as type, id_account,star,first_name,city,last_name,birth_date,profile_path,price
                                    FROM work
                                    JOIN type_work on work.id_type = type_work.id
                                    JOIN worker on id_worker = worker.id
                                    JOIN account on worker.id_account = account.id
                                    WHERE work.id_requester = ".$idTypeAccount." AND id_worker is NOT NULL AND finish = 1 AND cancelled =0 ORDER by date_start");

        $worksDone = $WorkQuery->fetchAll(PDO::FETCH_ASSOC);
        $WorkQuery->closeCursor();

        $returnJSON['dataDone'] = $worksDone;
        
    }

    if($type == "worker"){

        $returnJSON['status'] = true;
        $Query1 = $dbh->query("SELECT worker.id FROM worker WHERE id_account = ".$idAccount);
        $idTypeAccount = $Query1->fetch(PDO::FETCH_ASSOC);
        $idTypeAccount = $idTypeAccount['id'];

        //Proposal

        //SELECT infos worker (adress,max distance)
        $infosWorkerQuery = $dbh->query("   SELECT account.id as id,street,birth_date, postcode,city,country,maximum_distance 
                                            FROM account 
                                            JOIN worker on account.id = worker.id_account
                                            WHERE account.id =".$idAccount);

        $infosWorker = $infosWorkerQuery->fetchAll(PDO::FETCH_ASSOC);
        $infosWorkerQuery->closeCursor(); 
        $infosWorker = $infosWorker[0]; 

        //SELECT availability worker (id,day)
        $availableWorkerQuery = $dbh->query("   SELECT id_day,nom
                    FROM worker 
                    JOIN availability on worker.id = availability.id_worker
                    JOIN day on availability.id_day = day.id
                    WHERE worker.id =".$idTypeAccount);

        $availableWorker = $availableWorkerQuery->fetchAll(PDO::FETCH_ASSOC);
        $availableWorkerQuery->closeCursor();

        //SELECT type_work worker (id,type)
        $typeWorkerQuery = $dbh->query("SELECT id_type_work,name
            FROM worker 
            JOIN woker_Typer_work on worker.id = woker_Typer_work.id_worker
            JOIN type_work on woker_Typer_work.id_type_work = type_work.id
            WHERE worker.id =".$idTypeAccount);

        $typeWorker = $typeWorkerQuery->fetchAll(PDO::FETCH_ASSOC);
        $typeWorkerQuery->closeCursor();

        $age = age($infosWorker['birth_date']);

        //SELECT all works free with age
        $worksFreeQuery = $dbh->query("SELECT work.id as id, title,type_work.name as type,birth_date, description,id_type,type_work.name as type_name, id_requester,date_start,time_start,time_end,place,first_name,last_name,city,profile_path,price 
            FROM work
            JOIN type_work on work.id_type = type_work.id
            JOIN requester on id_requester = requester.id
            JOIN account on requester.id_account = account.id
            WHERE work.id_worker is NULL AND cancelled =0 AND finish = 0 AND min_age_worker <=".$age);

        $worksFree = $worksFreeQuery->fetchAll(PDO::FETCH_ASSOC);
        $worksFreeQuery->closeCursor();

        $worksOk=array();

        //If good type and day
        foreach($worksFree as $work){
            $timestamp = strtotime($work['date_start']);
            $numberDayWork = date('N', $timestamp);
            $now = date("Ymd");
            $dateStart = date("Ymd",strtotime($work['date_start']));
            
    
            foreach ($typeWorker as $type) {
                if($type['id_type_work'] == $work['id_type']){
                    foreach($availableWorker as $day){
                        if(($day['id_day'] == $numberDayWork) && ($dateStart >= $now)){
                          array_push($worksOk,$work);
                            break; 
                        } 
                    }
                    break;
                }
                
                
            }
            
        }

        $worksOkDistance = array();

        $adressWorker = $infosWorker['street'].", ".$infosWorker['postcode']." ".$infosWorker['city']." ".$infosWorker['country'];
        $distanceMax = (float) $infosWorker['maximum_distance'];

        foreach($worksOk as $work){
            try{
                $distance = getDistance($adressWorker,$work['place'],'K');
                if($distance < $distanceMax){
                    array_push($worksOkDistance,$work);
                }
            }
            catch(exception $e){
                break;
            }

        }

        $returnJSON['dataFree'] = $worksOkDistance;



        //Take
        $Query = $dbh->query(" SELECT work.id,title,id_type,type_work.name as type,description,date_start,time_start,time_end,place,name,price,first_name,last_name,city,profile_path,birth_date
                                        FROM work
                                        JOIN requester on work.id_requester = requester.id
                                        JOIN account on requester.id_account = account.id
                                        JOIN type_work on work.id_type = type_work.id
                                        WHERE finish = 0 AND cancelled = 0 AND id_worker ='$idTypeAccount' ORDER by date_start");

        $ToDoWorks = $Query->fetchAll(PDO::FETCH_ASSOC);
        $Query->closeCursor();

        $returnJSON['dataTake'] = $ToDoWorks;


        //Done
        $Query = $dbh->query(" SELECT work.id,title,id_type,type_work.name as type,description,date_start,time_start,time_end,place,name,price,first_name,last_name,city,profile_path,birth_date
                                        FROM work
                                        JOIN requester on work.id_requester = requester.id
                                        JOIN account on requester.id_account = account.id
                                        JOIN type_work on work.id_type = type_work.id
                                        WHERE finish = 1 AND cancelled = 0 AND id_worker ='$idTypeAccount' ORDER by date_start ");

        $DoneWorks = $Query->fetchAll(PDO::FETCH_ASSOC);
        $Query->closeCursor();        
        $returnJSON['dataDone'] = $DoneWorks;

    }

    if($returnJSON['status']){
        echo json_encode($returnJSON);
    }
