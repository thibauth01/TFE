<?php
    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');
    require_once('../php/apiDistance.php');


    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $returnJSON = array(
        "data" => null
    );


    $idAccount = trim(htmlspecialchars($obj['idAccount']));



    //SELECT infos worker (adress,max distance)
    $infosWorkerQuery = $dbh->query("   SELECT account.id as id,street,birth_date, postcode,city,country,maximum_distance, worker.id as idTypeAccount
                                        FROM account 
                                        JOIN worker on account.id = worker.id_account
                                        WHERE account.id =".$idAccount);

    $infosWorker = $infosWorkerQuery->fetch(PDO::FETCH_ASSOC);
    $infosWorkerQuery->closeCursor(); 
    $idTypeAccount = $infosWorker['idTypeAccount']; 


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


    $age  = age($infosWorker['birth_date']);

    //SELECT all works free with age
    $worksFreeQuery = $dbh->query("SELECT work.id as id, title, description,id_type,type_work.name as type_name, id_requester,date_start,time_start,time_end,place,first_name,last_name,city,profile_path,price 
                                    FROM work
                                    JOIN type_work on work.id_type = type_work.id
                                    JOIN requester on id_requester = requester.id
                                    JOIN account on requester.id_account = account.id
                                    WHERE work.id_worker is NULL AND cancelled =0 AND finish = 0 AND min_age_worker <=".$age);

    $worksFree = $worksFreeQuery->fetchAll(PDO::FETCH_ASSOC);
    $worksFreeQuery->closeCursor();
    
    $worksOk=array();
    

    foreach($worksFree as $work){
        $timestamp = strtotime($work['date_start']);
        $numberDayWork = date('N', $timestamp);

        foreach ($typeWorker as $type) {
            if($type['id_type_work'] == $work['id_type']){
                foreach($availableWorker as $day){
                    if($day['id_day'] == $numberDayWork){
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

    $returnJSON['data'] = $worksOkDistance;
    echo json_encode($returnJSON);
