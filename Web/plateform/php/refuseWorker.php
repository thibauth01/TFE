<?php
    require_once('../inc/db_connect.php');
    session_start();

    $Query = $dbh->query("SELECT id_worker,title FROM work WHERE id = ".$_POST['id']);
    $id_worker = $Query->fetch(PDO::FETCH_ASSOC);
    $Query->closeCursor();
    $title = $id_worker['title'];
    $id_worker = $id_worker['id_worker'];

    $Query = $dbh->query("UPDATE work
                            SET id_worker = null
                            WHERE id =".$_POST['id']);
    $Query->closeCursor();

    $idWork = $_POST['id'];
    $Query = $dbh->query("INSERT INTO refused_worker (id_work,id_worker) VALUES ('$idWork','$id_worker')");
    $Query->closeCursor();


    // create notif
    $message = "Le travail ".$title." de ".$_SESSION['first_name']." ".$_SESSION['last_name']. " vous à été refusé" ;
        
    $id_receiver = $id_worker;

    $Query = $dbh->query("INSERT INTO `notification` (`id_receiver`,`content`,`isRead`,`type`) VALUES ('".$id_receiver."','".$message."',0,'danger')");
    
    $Query->closeCursor();



