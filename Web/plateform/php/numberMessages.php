<?php
    session_start();
    require_once('../inc/db_connect.php');

    $Query = $dbh->query(" SELECT COUNT(id) as count FROM message WHERE id_work =".$_POST['idWork']);

    $number = $Query->fetch(PDO::FETCH_ASSOC);
    $Query->closeCursor();
    

    echo json_encode($number);