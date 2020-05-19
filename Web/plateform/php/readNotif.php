<?php

    require_once('../inc/db_connect.php');
    session_start();

    $Query = $dbh->query(" UPDATE notification
    SET isRead = 1
    WHERE id =".$_POST['id']);

    $Query->closeCursor();