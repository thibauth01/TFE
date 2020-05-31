<?php

    require_once('../inc/db_connect.php');
    require_once('utils.php');
    session_start();

    $star = $_POST['rating'];
    $Query = $dbh->query(" UPDATE work
                        SET star = '$star'
                        WHERE id =".$_POST['id']);

    $Query->closeCursor();