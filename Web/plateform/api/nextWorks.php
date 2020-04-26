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
        $Query1 = $dbh->query("SELECT worker.id FROM worker WHERE id_account = ".$idAccount);
        $idTypeAccount = $Query1->fetch(PDO::FETCH_ASSOC);
        $idTypeAccount = $idTypeAccount['id'];

        $Query = $dbh->query(" SELECT work.id,title,id_type,type_work.name as type,description,date_start,time_start,time_end,place,name,price,first_name,last_name,city,profile_path,birth_date
                                FROM work
                                JOIN requester on work.id_requester = requester.id
                                JOIN account on requester.id_account = account.id
                                JOIN type_work on work.id_type = type_work.id
                                WHERE finish = 0 AND cancelled = 0 AND id_worker =".$idTypeAccount);


    }

    else if ($type == "requester") {

        $returnJSON['status'] = true;
        $Query1 = $dbh->query("SELECT requester.id FROM requester WHERE id_account = ".$idAccount);
        $idTypeAccount = $Query1->fetch(PDO::FETCH_ASSOC);
        $idTypeAccount = $idTypeAccount['id'];

        $Query = $dbh->query("SELECT work.id as id,title, name as type, description,price,date_start,time_start,time_end,place,price,account.city as city,account.first_name as first_name,account.last_name as last_name,account.profile_path as profile_path,account.birth_date as birth_date,account.phone as phone
                                        FROM work 
                                        JOIN type_work on type_work.id = work.id_type
                                        JOIN worker on  worker.id = work.id_worker
                                        JOIN account on account.id = worker.id_account
                                        WHERE id_worker IS NOT NULL AND finish = 0 AND cancelled = 0 AND id_requester = $idTypeAccount ORDER BY date_start asc LIMIT 20 ");
    

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