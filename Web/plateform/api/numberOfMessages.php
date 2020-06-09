<?php

    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');

    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $returnJSON = array(
        "data" => null
    );


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
        $Query = $dbh->query(" SELECT COUNT(id) as count FROM message WHERE id_work =".$idWork);

        $returnJSON['data'] = $Query->fetch(PDO::FETCH_ASSOC);
        $Query->closeCursor();


        echo json_encode($returnJSON);
    }
    else{
        print_r('access denied');
    }

    