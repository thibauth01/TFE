<?php

$nom = trim(htmlspecialchars($_POST['nom']));
$prenom = trim(htmlspecialchars($_POST['prenom']));
$email = trim(htmlspecialchars($_POST['email']));
$messageForm = trim(htmlspecialchars($_POST['message']));



    
    ini_set( 'display_errors', 1 );

    error_reporting( E_ALL );

    $from = $email;

    $to = "help@youngr.be";

    $subject = $nom." ".$prenom." - Contact Form ";


    $message = $messageForm;

    $headers = "From:" . $from;


    if(mail($to,$subject,$message, $headers)){
        echo true;
    }
    else{
        echo false;
    }


