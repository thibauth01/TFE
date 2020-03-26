<?php

try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=youngr_test','thibaut','Thib18-99');
    // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    print "Erreur !:" .$e -> getMessage()."<br/>";
    die();
}
