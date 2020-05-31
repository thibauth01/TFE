<?php
    require_once('../inc/db_connect.php');
    session_start();

    $Query = $dbh->query("SELECT id,content,sendtime,isRead,type
                            FROM notification 
                            WHERE id_receiver =".$_SESSION['idTypeAccount']." AND isRead = 1 ORDER BY sendtime LIMIT 10");


    $notifs = $Query->fetchAll(PDO::FETCH_ASSOC);
    $Query->closeCursor();

    print_r(json_encode($notifs));

