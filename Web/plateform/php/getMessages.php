<?php

    session_start();
    require_once('../inc/db_connect.php');

    $Query = $dbh->query("SELECT *
                            FROM message
                            WHERE id_work =".$_POST['id']);

    $messages = $Query->fetchAll(PDO::FETCH_ASSOC);
    $Query->closeCursor();
    $toReturn = array(
        "messages" => $messages,
        "idTypeAccount" => $_SESSION['idTypeAccount']
    );

    echo json_encode($toReturn);