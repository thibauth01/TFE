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

        $Query = $dbh->query("SELECT work.id as id, profile_path,work.title as title
                                FROM work
                                JOIN requester on work.id_requester = requester.id
                                JOIN account on requester.id_account = account.id
                                WHERE finish = 0 AND cancelled = 0 AND id_worker =".$idTypeAccount);

        

    }


    else if($type == "requester"){

        $returnJSON['status'] = true;

        $Query1 = $dbh->query("SELECT requester.id FROM requester WHERE id_account = ".$idAccount);
        $idTypeAccount = $Query1->fetch(PDO::FETCH_ASSOC);
        $idTypeAccount = $idTypeAccount['id'];

        $Query = $dbh->query("SELECT work.id as id, profile_path,work.title as title
                                FROM work
                                JOIN worker on work.id_worker = worker.id
                                JOIN account on worker.id_account = account.id
                                WHERE finish = 0 AND cancelled = 0 AND id_requester =".$idTypeAccount);

        

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
    