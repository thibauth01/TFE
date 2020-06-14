<?php
    require_once('../inc/db_connect.php');
    session_start();

    $user = trim(htmlspecialchars($_POST['username']));

    
    $Query = $dbh->query("SELECT email
                            FROM account 
                            WHERE username = '".$user."'");


    $isAccount = $Query->fetch(PDO::FETCH_ASSOC);
    
    $Query->closeCursor();

    if($isAccount){

        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longueurMax = strlen($caracteres);
        $chaineAleatoire = '';

        for ($i = 0; $i < 8; $i++){
            $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
        }

        $password=password_hash($chaineAleatoire, PASSWORD_DEFAULT);

        $Query = $dbh->query("UPDATE account
                            SET password = '$password'
                            WHERE username = '".$user."'");

        
        $Query->closeCursor();

        

        //sendEmail
        $from = "help@youngr.be";

        $to = $isAccount['email'];

        $subject = "Récupération de mot de passe";


        $message = "
            Vous avez demandez la récupération de mot de passe pour le compte ".$user." 
            Voici votre nouveau mot de passe : ".$chaineAleatoire."

            Pour toutes questions, l'adresse help@youngr.be est à votre disposition ! 

            L'équipe Youngr !
        ";

        $headers = "From:" . $from;


        mail($to,$subject,$message, $headers);

        echo true;

    }
    else{
        echo false;
    }