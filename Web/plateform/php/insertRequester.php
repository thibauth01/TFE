<?php

require_once('../inc/db_connect.php');

$return['statut'] = true;
$messages = array();

$last_name = trim(htmlspecialchars($_POST['lastName']));
$first_name = trim(htmlspecialchars($_POST['firstName']));
$email = trim(htmlspecialchars($_POST['email']));
$username = trim(htmlspecialchars($_POST['username']));
$password = trim(htmlspecialchars($_POST['password']));
$confirm_password = trim(htmlspecialchars($_POST['Confirmpassword']));
$birth = trim(htmlspecialchars($_POST['birth']));
$street = trim(htmlspecialchars($_POST['address'])) . " " .trim(htmlspecialchars($_POST['number']));
$postcode = trim(htmlspecialchars($_POST['postal']));
$city = trim(htmlspecialchars($_POST['city']));  
$country = trim(htmlspecialchars($_POST['country']));


//verifications

if($password != $confirm_password){
    $return['statut'] = false;
    array_push($messages,'Passwords do not match');   
}
if(strlen($password) < 8){
    $return['statut'] = false;
    array_push($messages,'Passwords too short');    
    
}
if (!preg_match("#[0-9]+#", $password)) {
    $return['statut'] = false;
    array_push($messages,'Passwords must contain a number');    
}
if (!preg_match("#[a-zA-Z]+#", $password)) {
    $return['statut'] = false;
    array_push($messages,'Passwords must contain a letter');    
}

if(age($birth) < 15){
    $return['statut'] = false;
    array_push($messages,'Vous devez voir au moins 15 ans'); 
}



function age($date){
    $today = date("Y-m-d");
    $diff = date_diff(date_create($date), date_create($today));
    return $diff->format('%y');
}


$usernameQuery = $dbh->prepare( "SELECT `username` FROM `account` WHERE `username` = ?" );
$usernameQuery->bindValue( 1, $username );
$usernameQuery->execute();

if( $usernameQuery->rowCount() >= 1 ) { 
    $return['statut'] = false;
    array_push($messages,'username already use');
}


if($return['statut'] == false){
    print_r(json_encode($messages));
}

else{
    $password=password_hash($password, PASSWORD_DEFAULT);
    $accountQuery = $dbh->query( "INSERT INTO `account` (`first_name`,`last_name`,`email`,`username`,`password`,`birth_date`,`street`,`postcode`,`city`,`country`,`premium`,`type`) VALUES('$first_name','$last_name','$email','$username','$password','$birth','$street','$postcode','$city','$country',0,'requester')");
    if ($accountQuery) {
        $accountQuery->closeCursor();
    } else {
        $return['statut'] = false;
        array_push($messages,'Erreur lors de la création du compte');
    }

    if($return['statut'] == false){
        print_r(json_encode($messages));
    }
    else{
        $idAccount = $dbh->query("SELECT id FROM account ORDER BY id DESC LIMIT 1");
        if($idAccount){
            $id = $idAccount->fetchAll(PDO::FETCH_ASSOC);
            $id = $id[0]['id'];
            $idAccount->closeCursor();
        }
        else{
            $return['statut'] = false;
            array_push($messages,'Compte introuvable');
        }

        if($return['statut'] == false){
            print_r(json_encode($messages));
        }
        else{
            $requesterQuery = $dbh->query( "INSERT INTO `requester` (`id_account`,`premium`) VALUES('$id',0)");
            if ($requesterQuery) {
                $requesterQuery->closeCursor();

                $requesterIdQuery = $dbh->prepare( "SELECT `id` FROM `requester` WHERE `id_account` = ?" );
                $requesterIdQuery->bindValue( 1, $id);
                $requesterIdQuery->execute();
                
                if($requesterIdQuery){
                    $requester = $requesterIdQuery->fetch(PDO::FETCH_ASSOC);
                    $requesterIdQuery->closeCursor();

                    $messages=null;
                    session_start();
                    $_SESSION['user'] = $username;
                    $_SESSION['first_name']= $first_name;
                    $_SESSION['last_name']= $last_name;
                    $_SESSION['idAccount'] = $id;
                    $_SESSION['typeAccount'] = "requester";
                    $_SESSION['idTypeAccount'] = $requester['id']; 
                    print_r(json_encode($messages));
                }
                else{
                    array_push($messages,'requester introuvbale');
                    print_r(json_encode($messages));
                }

            } else {
                $return['statut'] = false;
                array_push($messages,'Erreur lors de la création du compte Requester');
                print_r(json_encode($messages));
            }

        }
        

    }
    
}


