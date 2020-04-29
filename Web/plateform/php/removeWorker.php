<?php
require_once('../inc/db_connect.php');


$Query = $dbh->query(" UPDATE work
SET id_worker = null
WHERE id =".$_POST['id']);

$Query->closeCursor();