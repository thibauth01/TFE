<?php

session_start();
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif' ); // valid extensions  
$path = '../img/uploads/avatars/';

$toReturn = array(
    'statut' => false,
    'msg' => "",
    'path' => ""
);

if(!empty($_FILES['imageAvatar'])){

    if($_FILES['imageAvatar']['error'] === UPLOAD_ERR_INI_SIZE){
        $toReturn['statut'] = false;
        $toReturn['msg'] = "Image trop grande (MAX 2M)";
    }
    else{
        
        $img = $_FILES['imageAvatar']['name'];
        $tmp = $_FILES['imageAvatar']['tmp_name'];
    
        // get uploaded file's extension
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    
        $path = $path.$_SESSION['idAccount'].".".$ext; 
    
    
        // check's valid format
        if(in_array($ext, $valid_extensions)) { 
            /* $path = $path.strtolower($final_image); */ 
            if(move_uploaded_file($tmp,$path)) {
    
                //include database configuration file
                require_once('../inc/db_connect.php');
                
    
                $path = substr($path,3);
                
                //insert form data in the database
                $insert = $dbh->query("UPDATE account SET profile_path = '$path' WHERE id =".$_SESSION['idAccount']);
                if($insert){

                    $toReturn['statut'] = true;
                    $toReturn['msg'] = "Photo de profil changée !";
                    $toReturn['path'] = $path ;
    
                }
                else{
                    $toReturn['statut'] = false;
                    $toReturn['msg'] = "Erreur d'insertion";
                }
            }
            else{
                $toReturn['statut'] = false;
                $toReturn['msg'] = "Erreur d'upload";
            }
        } 
        else {
            $toReturn['statut'] = false;
            $toReturn['msg'] = "Image invalide";
        } 

    }

   echo json_encode($toReturn);

    
}