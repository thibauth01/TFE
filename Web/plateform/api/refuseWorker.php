<?php

    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');


    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $idWork = trim(htmlspecialchars($obj['idWork']));

    $returnJSON = array(
        "status" => null
    );

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
        }
        else{
            $returnJSON['status'] = false;
        }
    }
    else{
        $returnJSON['status'] = false;
    }

    echo json_encode($returnJSON);
    

