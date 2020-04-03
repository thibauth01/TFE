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

$distance = trim(htmlspecialchars($_POST['distance']));

$types=null;
$days = null;


//verifications


if(age($birth) < 15 || age($birth) > 25){
    $return['statut'] = false;
    array_push($messages,'Vous devez avoir entre 15 et 25 ans'); 
}


if(isset($_POST['type'])){
    $types = $_POST['type'];
}

if(isset($_POST['day'])){
    $days = $_POST['day'];
}

if($return['statut'] == false){
    print_r(json_encode($messages));
}
else{
    $addWorkerQuery = $dbh->query(" UPDATE account
                                    SET first_name = '$first_name',
                                     last_name = '$last_name',
                                     email = '$email',
                                     birth_date = '$birth',
                                     street = '$street',
                                     postcode = '$postcode',
                                     city = '$city',
                                     country = '$country',
                                     type = 'worker',
                                     profile_path = NULL
                                    WHERE id =". $_SESSION['idAccount']);

    $addWorkerQuery->closeCursor();
    
    $deleteDaysQuery = $dbh->query("DELETE FROM availability WHERE id_worker =".$_SESSION['idTypeAccount']);
    $deleteDaysQuery->closeCursor();

    $deleteTypesQuery = $dbh->query("DELETE FROM woker_Typer_work WHERE id_worker =".$_SESSION['idTypeAccount']);
    $deleteTypesQuery->closeCursor();

    $id_worker = $_SESSION['idTypeAccount'];

    foreach ($types as $key => $type) {
        $insertTypesQuery = $dbh->query("INSERT INTO woker_Typer_work (id_worker,id_type_work) VALUES ('$id_worker','$key')");
        $insertTypesQuery->closeCursor();
    }

    foreach ($days as $key => $day) {
        $insertTypesQuery = $dbh->query("INSERT INTO availability (id_worker,id_day) VALUES ('$id_worker','$key')");
        $insertTypesQuery->closeCursor();
    }

    $messages=null;
    print_r(json_encode($messages));
   
}

