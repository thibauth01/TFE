<?php
require_once('../inc/db_connect.php');


$Query = $dbh->query(" UPDATE work
SET cancelled = 1
WHERE id =".$_POST['id']);

$Query->closeCursor();

