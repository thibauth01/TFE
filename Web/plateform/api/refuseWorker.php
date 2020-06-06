<?php

    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');


    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $idWork = trim(htmlspecialchars($obj['idWork']));
    $firstName = trim(htmlspecialchars($obj['firstName']));
    $lastName = trim(htmlspecialchars($obj['lastName']));

    $returnJSON = array(
        "status" => null
    );

    $Query = $dbh->query("SELECT id_worker,title FROM work WHERE id = ".$idWork);
    $id_worker = $Query->fetch(PDO::FETCH_ASSOC);
    $Query->closeCursor();
    $title = $id_worker['title'];
    $id_worker = $id_worker['id_worker'];

    $Query = $dbh->query("SELECT id_worker FROM work WHERE id = ".$idWork);
    $id_worker = $Query->fetch(PDO::FETCH_ASSOC);
    $Query->closeCursor();
    $id_worker = $id_worker['id_worker'];


    $Query = $dbh->query("UPDATE work
                            SET id_worker = null
                            WHERE id =".$idWork);

    if($Query){
        $Query->closeCursor();


        $Query = $dbh->query("INSERT INTO refused_worker (id_work,id_worker) VALUES ('$idWork','$id_worker')");
        if($Query){
            $Query->closeCursor();
            $returnJSON['status'] = true;

            // create notif
            $message = "Le travail ".$title." de ".$firstName." ".$lastName. " vous à été refusé" ;
                
            $id_receiver = $id_worker;

            $Query = $dbh->query("INSERT INTO `notification` (`id_receiver`,`content`,`isRead`,`type`) VALUES ('".$id_receiver."','".$message."',0,'danger')");
            
            $Query->closeCursor();

        }
        else{
            $returnJSON['status'] = false;
        }
    }
    else{
        $returnJSON['status'] = false;
    }

    echo json_encode($returnJSON);
    

