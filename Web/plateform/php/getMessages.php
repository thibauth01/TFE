<?php

    session_start();
    require_once('../inc/db_connect.php');

    $Query = $dbh->query("SELECT *
                            FROM message
                            WHERE id_work =".$_POST['id']);

    $messages = $Query->fetchAll(PDO::FETCH_ASSOC);
    $Query->closeCursor();

    $Query = $dbh->query("UPDATE message SET isRead = 1 WHERE id_work =".$_POST['id']." AND id_sender !=".$_SESSION['idTypeAccount']);
    $toReturn = array(
        "messages" => $messages,
        "idTypeAccount" => $_SESSION['idTypeAccount']
    );

    echo json_encode($toReturn);