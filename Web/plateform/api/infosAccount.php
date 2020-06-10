<?php
    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');

    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $returnJSON = array(
        "workDone" => null,
        "salary" => null,
        "path" => null
    );

    $idAccount = trim(htmlspecialchars($obj['idAccount']));
    $idTypeAccount = trim(htmlspecialchars($obj['idTypeAccount']));
    $type = trim(htmlspecialchars($obj['type']));
    $jwt = trim(htmlspecialchars($obj['jwt']));

    if($jwt == null){
        print_r('access denied');
        die();
    }

    $Query = $dbh->query("SELECT jwt FROM account WHERE id = ".$idAccount);
    $jwtAccount = $Query->fetch(PDO::FETCH_ASSOC);
    $Query->closeCursor();

    if($jwtAccount['jwt'] == $jwt){
        
        if($type == "worker"){
            $Query = $dbh->query("SELECT count(work.id) as nbrWork,account.profile_path as profile_path
                                    FROM work 
                                    JOIN worker on worker.id = work.id_worker 
                                    JOIN account on account.id=worker.id_account
                                    WHERE finish=1 AND cancelled = 0 AND id_worker = ".$idTypeAccount);
            $workDone = $Query->fetch(PDO::FETCH_ASSOC);
            $Query->closeCursor();

            $returnJSON['workDone'] = $workDone['nbrWork'];
            $returnJSON['path'] = $workDone['profile_path'];
            

            $Query = $dbh->query("SELECT date_start,time_start,time_end,price
                                    FROM work 
                                    WHERE finish = 1 AND paid = 1 AND cancelled = 0 AND id_worker = ".$idTypeAccount);
            $salary = $Query->fetchAll(PDO::FETCH_ASSOC);
            $Query->closeCursor();

            $totalPrice=0;
            foreach($salary as $work){
                $minutesWork = timeSpace($work['time_start'],$work['time_end']);
                $price = $minutesWork * ($work['price']/60);
                $price= (float)round($price,2);
                $totalPrice += $price;
            }

            $returnJSON['salary'] = $totalPrice;




        }

        else if($type =="requester"){

            $Query = $dbh->query("SELECT count(work.id) as nbrWork,account.profile_path as profile_path
                        FROM work 
                        JOIN requester on requester.id = work.id_requester 
                        JOIN account on account.id=requester.id_account
                        WHERE finish=1 AND cancelled = 0 AND id_requester = ".$idTypeAccount);
                        
            $workDone = $Query->fetch(PDO::FETCH_ASSOC);
            $Query->closeCursor();

            $returnJSON['workDone'] = $workDone['nbrWork'];
            $returnJSON['path'] = $workDone['profile_path'];
        }

        else{
            print_r('erreur type');
        }



        echo json_encode($returnJSON);
    }

    

    else{
        print_r('access denied');

    }