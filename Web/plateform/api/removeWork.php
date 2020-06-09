<?php

    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');


    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $idWork = trim(htmlspecialchars($obj['idWork']));
    $firstName = trim(htmlspecialchars($obj['firstName']));
    $lastName = trim(htmlspecialchars($obj['lastName']));
    $isTake = trim(htmlspecialchars($obj['isTake']));
    $idAccount = trim(htmlspecialchars($obj['idAccount']));
    $jwt = trim(htmlspecialchars($obj['jwt']));

    $returnJSON = array(
        "status" => null
    );

    

    if($jwt == null){
        print_r('access denied');
        die();
    }

    $Query = $dbh->query("SELECT jwt FROM account WHERE id = ".$idAccount);
    $jwtAccount = $Query->fetch(PDO::FETCH_ASSOC);
    $Query->closeCursor();

    if($jwtAccount['jwt'] == $jwt){

        $Query = $dbh->query("SELECT id_worker,title,date_start
                                FROM work 
                                WHERE id =".$idWork);


        $infoswork = $Query->fetch(PDO::FETCH_ASSOC);
        $Query->closeCursor();

        $Query = $dbh->query(" UPDATE work
                                SET cancelled = 1
                                WHERE id =".$idWork);

        if($Query){
            $Query->closeCursor();
            $returnJSON['status'] = true;

            if($isTake){
                // create notif
                $message = "Le travail ".$infoswork['title']." de ".$firstName." ".$lastName. " a été annulé" ;  
                $id_receiver = $infoswork['id_worker'];
                $Query = $dbh->query("INSERT INTO `notification` (`id_receiver`,`content`,`isRead`,`type`) VALUES ('".$id_receiver."','".$message."',0,'danger')");
                $Query->closeCursor();

            }

            
        }
        else{
            $returnJSON['status'] = false; 
        }

        echo json_encode($returnJSON);

    }
    else{
        print_r('access denied');

    }

  

