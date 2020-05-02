<?php

    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');


    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $idWork = trim(htmlspecialchars($obj['idWork']));

    $returnJSON = array(
        "status" => null
    );

    $Query = $dbh->query(" UPDATE work
                            SET finish = 1,
                                paid = 1
                            WHERE id =".$idWork);

    if($Query){
        $Query->closeCursor();
        $returnJSON['status'] = true;
    }
    else{
        $returnJSON['status'] = false; 
    }

    echo json_encode($returnJSON);

