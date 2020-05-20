<?php
require_once('../inc/db_connect.php');
session_start();


        $Query = $dbh->query("SELECT id_worker,title,date_start
                                FROM work 
                                WHERE id =".$_POST['id']);


        $infoswork = $Query->fetch(PDO::FETCH_ASSOC);
        $Query->closeCursor();


    $Query = $dbh->query(" UPDATE work
    SET cancelled = 1
    WHERE id =".$_POST['id']);

    $Query->closeCursor();

    if($_POST['take']){
        // create notif
        $message = "Le travail ".$infoswork['title']." de ".$_SESSION['first_name']." ".$_SESSION['last_name']. " a été annulé" ;
        
        $id_receiver = $infoswork['id_worker'];

        $Query = $dbh->query("INSERT INTO `notification` (`id_receiver`,`content`,`isRead`,`type`) VALUES ('".$id_receiver."','".$message."',0,'danger')");
        
        $Query->closeCursor();

    }

