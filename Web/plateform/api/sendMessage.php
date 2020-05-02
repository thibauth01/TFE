<?php
    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');

    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $returnJSON = array(
        "txt" => null
    );


    $type = trim(htmlspecialchars($obj['type']));
    $idWork = trim(htmlspecialchars($obj['idWork']));
    $idAccount = trim(htmlspecialchars($obj['idAccount']));
    $content = trim(htmlspecialchars($obj['content']));
    

    if($type == "worker"){

        $Query1 = $dbh->query("SELECT worker.id FROM worker WHERE id_account = ".$idAccount);
        $idTypeAccount = $Query1->fetch(PDO::FETCH_ASSOC);
        $idTypeAccount = $idTypeAccount['id'];

    }
    else if($type == "requester"){

        $Query1 = $dbh->query("SELECT requester.id FROM requester WHERE id_account = ".$idAccount);
        $idTypeAccount = $Query1->fetch(PDO::FETCH_ASSOC);
        $idTypeAccount = $idTypeAccount['id'];
    }
    $Query = $dbh->query("INSERT INTO message (id_work,id_sender,content,isRead) VALUES ('$idWork','$idTypeAccount','$content',0)");

    if(!$Query){
        $returnJSON['txt'] = "Erreur lors de l'envoi du message";
    }
    echo json_encode($returnJSON);

    $Query->closeCursor();