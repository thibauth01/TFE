<?php
require_once('../inc/db_connect.php');

$messages = array();

$username = trim(htmlspecialchars($_POST['username']));
$password = trim(htmlspecialchars($_POST['password']));

$usernameQuery = $dbh->prepare( "SELECT `id`,`username`,`password`,`first_name`,`last_name`, `type` FROM `account` WHERE `username` = ?" );
$usernameQuery->bindValue( 1, $username );
$usernameQuery->execute();

if( $usernameQuery->rowCount() >= 1 ) { 
    $user = $usernameQuery->fetch(PDO::FETCH_ASSOC);
    $usernameQuery->closeCursor();
    $isPasswordCorrect = password_verify($password, $user['password']);

    if($isPasswordCorrect){
        if($user['type'] == "worker"){
            $workerQuery = $dbh->prepare( "SELECT `id` FROM `worker` WHERE `id_account` = ?" );
            $workerQuery->bindValue( 1, $user['id']);
            $workerQuery->execute();

            if($workerQuery){
                $worker = $workerQuery->fetch(PDO::FETCH_ASSOC);
                $workerQuery->closeCursor();

                $messages=null;
                session_start();
                $_SESSION['user'] = $user['username'];
                $_SESSION['first_name']= $user['first_name'];
                $_SESSION['last_name']= $user['last_name'];
                $_SESSION['idAccount'] = $user['id'];
                $_SESSION['typeAccount'] = $user['type'];
                $_SESSION['idTypeAccount'] = $worker['id']; 
                print_r(json_encode($messages));
            }
            else{
                array_push($messages,'Worker introuvbale');
                print_r(json_encode($messages));
            }
        }
        else if($user['type'] == "requester"){
            $requesterQuery = $dbh->prepare( "SELECT `id` FROM `requester` WHERE `id_account` = ?" );
            $requesterQuery->bindValue( 1, $user['id']);
            $requesterQuery->execute();
            
            if($requesterQuery){
                $requester = $requesterQuery->fetch(PDO::FETCH_ASSOC);
                $requesterQuery->closeCursor();

                $messages=null;
                session_start();
                $_SESSION['user'] = $user['username'];
                $_SESSION['first_name']= $user['first_name'];
                $_SESSION['last_name']= $user['last_name'];
                $_SESSION['idAccount'] = $user['id'];
                $_SESSION['typeAccount'] = $user['type'];
                $_SESSION['idTypeAccount'] = $requester['id']; 
                print_r(json_encode($messages));
            }
            else{
                array_push($messages,'requester introuvbale');
                print_r(json_encode($messages));
            }
        }
        else{
            array_push($messages,'Type introuvable');
            print_r(json_encode($messages));
        }

    }
    else{
        array_push($messages,'Mot de passe incorrect');
        print_r(json_encode($messages));
    }
}
else{
    array_push($messages,'Utilisateur introuvbale');
    print_r(json_encode($messages));
}