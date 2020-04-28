<?php

    session_start();
    require_once('../inc/db_connect.php');


    $idWork = trim(htmlspecialchars($_POST['idWork']));
    $text = trim(htmlspecialchars($_POST['text']));
    $idSender=$_SESSION['idTypeAccount'];

    $Query = $dbh->query("INSERT INTO message (id_work,id_sender,content,isRead) VALUES ('$idWork','$idSender','$text',0)");

    $Query->closeCursor();
    

