<?php
    require_once('../inc/db_connect.php');
    session_start();

    $Query = $dbh->query("SELECT id_worker,id_requester,title,date_start
                            FROM work 
                            WHERE id =".$_POST['id']);


    $infoswork = $Query->fetch(PDO::FETCH_ASSOC);
    $Query->closeCursor();

    $Query = $dbh->query(" UPDATE work
    SET id_worker = null
    WHERE id =".$_POST['id']);

    $Query->closeCursor();

    // create notif
    $message = $_SESSION['first_name']." ".$_SESSION['last_name']. " ne pourra pas effectuer votre travail ".$infoswork['title'].". Il est de nouveau libre !" ;
            
    $id_receiver = $infoswork['id_requester'];

    $Query = $dbh->query("INSERT INTO `notification` (`id_receiver`,`content`,`isRead`,`type`) VALUES ('".$id_receiver."','".$message."',0,'warning')");

    $Query->closeCursor();