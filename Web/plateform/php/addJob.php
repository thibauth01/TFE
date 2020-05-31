<?php
    session_start();
    require_once('../inc/db_connect.php');

    $return['statut'] = true;
    $messages = array();

    $title = trim(htmlspecialchars($_POST['title']));
    $type = trim(htmlspecialchars($_POST['type']));
    $ageMin = trim(htmlspecialchars($_POST['ageMin']));
    $date = trim(htmlspecialchars($_POST['date']));
    $timeStart = trim(htmlspecialchars($_POST['timeStart']));
    $timeEnd = trim(htmlspecialchars($_POST['timeEnd']));
    $street = trim(htmlspecialchars($_POST['street']));
    $city = trim(htmlspecialchars($_POST['city']));
    $postal = trim(htmlspecialchars($_POST['postal']));
    $country = trim(htmlspecialchars($_POST['country']));
    $description = trim(htmlspecialchars($_POST['description']));
    $idType = trim(htmlspecialchars($_POST['idType']));
    $price = trim(htmlspecialchars($_POST['price']));

    $id_requester = $_SESSION['idTypeAccount'];
    $place = $street." ".$postal." ".$city." ".$country;


    if($timeStart > $timeEnd){
        $return['statut'] = false;
        array_push($messages,"Erreur dans les heures");
    }

    if($ageMin <  15 || $ageMin > 25){
        $return['statut'] = false;
        array_push($messages,"L'age du travailleur doit être entre 15 et 25 ans");
    }

    $now = date("d/m/y");
    if(time() > strtotime($date)){
        $return['statut'] = false;
        array_push($messages,"La date ne peux pas etre passée !");
    }
    if($price < 8 || $price > 25){
        $return['statut'] = false;
        array_push($messages,"Le prix doit être compris entre 8 et 25€ /h");
    }
    
    
    
    if($return['statut'] == false){
        print_r(json_encode($messages));
    }

    else{
        $workQuery = $dbh->query( "INSERT INTO `work` (`title`,`id_type`,`description`,`id_requester`,`id_worker`,`min_age_worker`,`date_start`,`time_start`,`time_end`,`place`,`statut_progress`,`paid`,`cancelled`,`finish`,`price`,`star`) VALUES('$title','$idType','$description','$id_requester',NULL,'$ageMin','$date','$timeStart','$timeEnd','$place','To Do',0,0,0,'$price',null)");
        if ($workQuery) {
            
            $workQuery->closeCursor();
            $messages= null;
            print_r(json_encode($messages));

        } else {
            $return['statut'] = false;
            array_push($messages,'Erreur lors de l ajout du travail');
            print_r(json_encode($messages));
        }
        
    }



    

?>