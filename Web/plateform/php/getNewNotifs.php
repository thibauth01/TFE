<?php
    require_once('../inc/db_connect.php');
    session_start();

    $Query = $dbh->query("SELECT id,content,sendtime,isRead,type
                            FROM notification 
                            WHERE id_receiver =".$_SESSION['idTypeAccount']." AND isRead = 0 ORDER BY sendtime");


    $notifs = $Query->fetchAll(PDO::FETCH_ASSOC);
    $Query->closeCursor();

    print_r(json_encode($notifs));

