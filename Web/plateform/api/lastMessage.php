<?php
    require_once('../inc/db_connect.php');
    require_once('../php/utils.php');

    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);

    $returnJSON = array(
        "data" => null
    );


    $idWork = trim(htmlspecialchars($obj['idWork']));

    $Query = $dbh->query(" SELECT * FROM message WHERE id_work = '$idWork' ORDER BY sendtime desc LIMIT 1");
    $lastMessage = $Query->fetch(PDO::FETCH_ASSOC);
   

    if($Query){
        $Query->closeCursor();
        $returnJSON['data'] = $lastMessage;
    }
    else{
        $returnJSON['data'] = "flop";

    }


    echo json_encode($returnJSON);