<?php
require_once('../inc/db_connect.php');
session_start();

$Query = $dbh->query(" UPDATE work
                                SET id_worker = ".$_SESSION['idTypeAccount']."
                                WHERE id =".$_POST['id']);

$Query->closeCursor();


