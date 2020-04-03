<?php
require_once('../inc/db_connect.php');
require_once('utils.php');
session_start();

$return['statut'] = true;
$messages = array();

$last_name = trim(htmlspecialchars($_POST['lastName']));
$first_name = trim(htmlspecialchars($_POST['firstName']));
$email = trim(htmlspecialchars($_POST['email']));
$birth = trim(htmlspecialchars($_POST['birth']));
$street = trim(htmlspecialchars($_POST['address']));
$postcode = trim(htmlspecialchars($_POST['postal']));
$city = trim(htmlspecialchars($_POST['city']));  
$country = trim(htmlspecialchars($_POST['country']));



if($return['statut'] == false){
    print_r(json_encode($messages));
}
else{
    $addRequesterQuery = $dbh->query(" UPDATE account
                                    SET first_name = '$first_name',
                                     last_name = '$last_name',
                                     email = '$email',
                                     birth_date = '$birth',
                                     street = '$street',
                                     postcode = '$postcode',
                                     city = '$city',
                                     country = '$country',
                                     type = 'requester',
                                     profile_path = NULL
                                    WHERE id =". $_SESSION['idAccount']);

    $addRequesterQuery->closeCursor();

    $messages=null;
    print_r(json_encode($messages));
   
}

