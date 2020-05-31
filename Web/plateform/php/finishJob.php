<?php

require_once('../inc/db_connect.php');
require_once('utils.php');
session_start();


$Query = $dbh->query("SELECT id_worker,id_requester,title,date_start
                                FROM work 
                                WHERE id =".$_POST['id']);


        $infoswork = $Query->fetch(PDO::FETCH_ASSOC);
        $Query->closeCursor();


$Query = $dbh->query(" UPDATE work
                        SET finish = 1,
                        paid = 1
                        WHERE id =".$_POST['id']);

$Query->closeCursor();

//create notif
$message = $_SESSION['first_name']." ".$_SESSION['last_name']. " a marqué le travail ".$infoswork['title']." comme terminé et payé" ;

$id_receiver = $infoswork['id_worker'];


$Query = $dbh->query("INSERT INTO `notification` (`id_receiver`,`content`,`isRead`,`type`) VALUES ('".$id_receiver."','".$message."',0,'info')");
        
$Query->closeCursor();

