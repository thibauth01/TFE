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

$distance = trim(htmlspecialchars($_POST['distance']));

$types=null;
$days = null;

if(isset($_POST['type'])){
    $types = $_POST['type'];
}

if(isset($_POST['day'])){
    $days = $_POST['day'];
}



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

if(age($birth) < 15 || age($birth) > 25){
    $return['statut'] = false;
    array_push($messages,'You must be between 15 and 25 years old'); 
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

if($types == null){
    $return['statut'] = false;
    array_push($messages,'Veuillez choisir une compétence');
}

if($days == null){
    $return['statut'] = false;
    array_push($messages,'Veuillez choisir une disponibilité');
}




if($return['statut'] == false){
    print_r(json_encode($messages));
}

else{
    $accountQuery = $dbh->query( "INSERT INTO `account` (`first_name`,`last_name`,`email`,`username`,`password`,`birth_date`,`street`,`postcode`,`city`,`country`,`premium`) VALUES('$first_name','$last_name','$email','$username','$password','$birth','$street','$postcode','$city','$country',0)");
    if ($accountQuery) {
        $accountQuery->closeCursor();
    } 
    else {
        $return['statut'] = false;
        array_push($messages,'Erreur lors de la création du compte Account');
    }

    if($return['statut'] == false){
        print_r(json_encode($messages));
    }
    else{
        $idAccountQuery = $dbh->query("SELECT id FROM account ORDER BY id DESC LIMIT 1");
        if($idAccountQuery){
            $idAccount = $idAccountQuery->fetchAll(PDO::FETCH_ASSOC);
            $idAccount = $idAccount[0]['id'];
            $idAccountQuery->closeCursor();
            
        }
        else{
            $return['statut'] = false;
            array_push($messages,'Compte Account introuvable');
        }

        if($return['statut'] == false){
            print_r(json_encode($messages));
        }
        else{
            $requesterQuery = $dbh->query( "INSERT INTO `worker` (`maximum_distance`,`id_account`,`star`) VALUES('$distance','$idAccount',0)");
            if ($requesterQuery) {
                $requesterQuery->closeCursor();
            } 
            else {
                $return['statut'] = false;
                array_push($messages,'Erreur lors de la création du compte Worker');
            }

            if($return['statut'] == false){
                print_r(json_encode($messages));
            }
            else{
                $idWorkerQuery = $dbh->query("SELECT id FROM worker ORDER BY id DESC LIMIT 1");
                if($idWorkerQuery){
                    $idWorker = $idWorkerQuery->fetchAll(PDO::FETCH_ASSOC);
                    $idWorker = $idWorker[0]['id'];
                    $idWorkerQuery->closeCursor();
                }
                else{
                    $return['statut'] = false;
                    array_push($messages,'Compte worker introuvable');
                }

                if($return['statut'] == false){
                    print_r(json_encode($messages));
                }
                else{
                    
                    foreach($days as $key => $value){
                        $idDay;
                        switch($key){
                            case 'monday' : 
                                $idDay=1;
                                break;
                            case 'thuesday':
                                $idDay=2;
                                break;
                            case 'wednesday':
                                $idDay=3;
                                break;
                            case 'thursday':
                                $idDay=4;
                                break;
                            case 'friday':
                                $idDay=5;
                                break;
                            case 'saturday':
                                $idDay=6;
                                break;
                            case 'sunday':
                                $idDay=7;
                                break;

                            default:
                                $idDay=0;
                        }

                        $availabilityQuery = $dbh->query( "INSERT INTO `availability` (`id_worker`,`id_day`) VALUES('$idWorker','$idDay')");
                        if ($availabilityQuery) {
                            $availabilityQuery->closeCursor();
                        } 
                        else {
                            $return['statut'] = false;
                            array_push($messages,'Erreur lors de l ajout du jour '.$key);
                        }
                    }
                    
                    if($return['statut'] == false){
                        print_r(json_encode($messages));
                    }
                    else{
                        foreach($types as $key1 => $value1){
                            $idType;
                            switch($key1){
                                case 'babySitting' : 
                                    $idType=1;
                                    break;
                                case 'housework':
                                    $idType=2;
                                    break;
                                case 'gardening':
                                    $idType=3;
                                    break;
                                case 'petsitting':
                                    $idType=4;
                                    break;
                                case 'shopping':
                                    $idType=5;
                                    break;
                                case 'technology':
                                    $idType=6;
                                    break;
                                case 'lessons':
                                    $idType=7;
                                    break;
                                case 'technology':
                                    $idType=8;
                                    break;
                                case 'other':
                                    $idType=9;
                                    break;
    
                                default:
                                    $idType=0;
                            }
    
                            $type_workQuery = $dbh->query( "INSERT INTO `woker_Typer_work` (`id_worker`,`id_type_work`) VALUES('$idWorker','$idType')");
                            if ($type_workQuery) {
                                $type_workQuery->closeCursor();
                            } 
                            else {
                                $return['statut'] = false;
                                array_push($messages,'Erreur lors de l ajout du type '.$key1);
                            }
                        }

                        if($return['statut'] == false){
                            print_r(json_encode($messages));
                        }
                        else{
                            print_r(json_encode("win"));
                        }

                    
                    }
                    

                }
            }

        }
        

    }
    
}


