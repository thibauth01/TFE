<?php

    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');


    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $idWork = trim(htmlspecialchars($obj['idWork']));
    $firstName = trim(htmlspecialchars($obj['firstName']));
    $lastName = trim(htmlspecialchars($obj['lastName']));
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

         $Query = $dbh->query("SELECT id_worker,id_requester,title,date_start
                            FROM work 
                            WHERE id =".$idWork);


        $infoswork = $Query->fetch(PDO::FETCH_ASSOC);
        $Query->closeCursor();

        $Query = $dbh->query(" UPDATE work
                                SET id_worker = null
                                WHERE id =".$idWork);

        if($Query){
            $Query->closeCursor();
            $returnJSON['status'] = true;

            // create notif
            $message = $firstName." ".$lastName. " ne pourra pas effectuer votre travail ".$infoswork['title'].". Il est de nouveau libre !" ;
                    
            $id_receiver = $infoswork['id_requester'];

            $Query = $dbh->query("INSERT INTO `notification` (`id_receiver`,`content`,`isRead`,`type`) VALUES ('".$id_receiver."','".$message."',0,'warning')");

            $Query->closeCursor();
        }
        else{
            $returnJSON['status'] = false; 
        }

        echo json_encode($returnJSON);
    }
    else{
        print_r('access denied');

    }

   

