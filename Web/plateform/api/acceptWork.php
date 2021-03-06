<?php

    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');


    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $idWork = trim(htmlspecialchars($obj['idWork']));
    $idAccount = trim(htmlspecialchars($obj['idAccount']));
    $idTypeAccount = trim(htmlspecialchars($obj['idTypeAccount']));
    $firstName = trim(htmlspecialchars($obj['firstName']));
    $lastName = trim(htmlspecialchars($obj['lastName']));
    $jwt = trim(htmlspecialchars($obj['jwt']));

    if($jwt == null){
        print_r('access denied');
        die();
    }

    $Query = $dbh->query("SELECT jwt FROM account WHERE id = ".$idAccount);
    $jwtAccount = $Query->fetch(PDO::FETCH_ASSOC);
    $Query->closeCursor();


    $returnJSON = array(
        "status" => null
    );

    if($jwtAccount['jwt'] == $jwt){
        $Query = $dbh->query("SELECT id_worker,id_requester,title,date_start
                            FROM work 
                            WHERE id =".$idWork);


        $infoswork = $Query->fetch(PDO::FETCH_ASSOC);
        $Query->closeCursor();

        if($infoswork['id_worker'] != null){
            echo false;
        }
        else{
            $Query = $dbh->query(" UPDATE work
                                SET id_worker = '$idTypeAccount'
                                WHERE id =".$idWork);

            if($Query){
                $Query->closeCursor();
                $returnJSON['status'] = true;

                //notif
                $message = "Votre travail ".$infoswork['title']." à été accepté par ".$firstName." ".$lastName ;
            
                $id_receiver = $infoswork['id_requester'];

                $Query = $dbh->query("INSERT INTO `notification` (`id_receiver`,`content`,`isRead`,`type`) VALUES ('".$id_receiver."','".$message."',0,'info')");
                
                $Query->closeCursor();

            }
            else{
                $returnJSON['status'] = false; 
            }

            echo json_encode($returnJSON);
        }


    }
    else{
        print_r('access denied');

    }

    
    

