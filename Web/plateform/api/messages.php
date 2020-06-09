<?php

    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');


    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $returnJSON = array(
        "status" => null,
        "txt" => null,
        "data" => null,
        'idTypeAccount' => null
    );

    $type = trim(htmlspecialchars($obj['type']));
    $idWork = trim(htmlspecialchars($obj['idWork']));
    $idAccount = trim(htmlspecialchars($obj['idAccount']));
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

            $returnJSON['status'] = true;
            $Query1 = $dbh->query("SELECT worker.id FROM worker WHERE id_account = ".$idAccount);
            $idTypeAccount = $Query1->fetch(PDO::FETCH_ASSOC);
            $idTypeAccount = $idTypeAccount['id'];
        }
    
        else if($type == "requester"){
            $returnJSON['status'] = true;
            $Query1 = $dbh->query("SELECT requester.id FROM requester WHERE id_account = ".$idAccount);
            $idTypeAccount = $Query1->fetch(PDO::FETCH_ASSOC);
            $idTypeAccount = $idTypeAccount['id'];
        }
    
        else{
            $returnJSON['status'] = false;
            $returnJSON['txt'] = "Erreur type";
    
            echo json_encode($returnJSON);
        }
    
        if($returnJSON['status']){
            $Query = $dbh->query("SELECT *
                                FROM message
                                WHERE id_work =".$idWork);
    
            $messages = $Query->fetchAll(PDO::FETCH_ASSOC);
            $Query->closeCursor();
    
            $Query = $dbh->query("UPDATE message SET isRead = 1 WHERE id_work =".$idWork." AND id_sender !=".$idTypeAccount);
    
            $returnJSON['data'] = $messages;
            $returnJSON['idTypeAccount'] =$idTypeAccount;
            
            echo json_encode($returnJSON);
    
        }
    
    }
    else{
        print_r('access denied');
    }

   