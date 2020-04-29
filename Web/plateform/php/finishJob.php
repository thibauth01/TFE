<?php

require_once('../inc/db_connect.php');
require_once('utils.php');
session_start();


$Query = $dbh->query(" UPDATE work
                        SET finish = 1,
                        paid = 1
                        WHERE id =".$_POST['id']);

$Query->closeCursor();
