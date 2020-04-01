<?php
require_once('../inc/db_connect.php');

$removeQuery = $dbh->prepare( "DELETE FROM `work` WHERE id = ?");
$removeQuery ->bindValue(1,$_POST['id']);
$removeQuery->execute();
