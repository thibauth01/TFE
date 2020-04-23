<?php

    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');


    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $returnJSON = array(
        "status" => null,
        "txt" => null,
        "data" => null
    );


    $type = trim(htmlspecialchars($obj['type']));
    $idAccount = trim(htmlspecialchars($obj['idAccount']));


    if($type == "worker"){
        $returnJSON['status'] = true;

    }

    else if ($type == "requester") {

        $returnJSON['status'] = true;
        $Query1 = $dbh->query("SELECT requester.id FROM requester WHERE id_account = ".$idAccount);
        $idTypeAccount = $Query1->fetch(PDO::FETCH_ASSOC);
        $idTypeAccount = $idTypeAccount['id'];

        $Query = $dbh->query("SELECT work.id as id,title, name as type, description,date_start,time_start,time_end,place,price,account.city as city,account.first_name as first_name,account.last_name as last_name,account.profile_path as profile_path
                                        FROM work 
                                        JOIN type_work on type_work.id = work.id_type
                                        JOIN worker on  worker.id = work.id_worker
                                        JOIN account on account.id = worker.id_account
                                        WHERE id_worker IS NOT NULL AND finish = 0 AND cancelled = 0 AND id_requester = $idTypeAccount ORDER BY date_start ");
    

    }

    else{

        $returnJSON['status'] = false;
        $returnJSON['txt'] = "Erreur type";

        echo json_encode($returnJSON);
    }


    // if not error
    if($returnJSON['status']){
        
        $returnJSON['data'] = $Query->fetchAll(PDO::FETCH_ASSOC);
        $Query->closeCursor();

        echo json_encode($returnJSON);
    }