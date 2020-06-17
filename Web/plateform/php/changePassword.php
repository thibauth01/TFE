<?php
    session_start();
    require_once('../inc/db_connect.php');

    $return['statut'] = true;
    $messages = array();

    $oldPassword = trim(htmlspecialchars($_POST['oldPassword']));
    $newPassword = trim(htmlspecialchars($_POST['newPassword']));
    $comfirmPassword = trim(htmlspecialchars($_POST['comfirmPassword']));


    $Query = $dbh->query("SELECT password
                            FROM account 
                            WHERE id =".$_SESSION['idAccount']);


    $pswAccount = $Query->fetch(PDO::FETCH_ASSOC);
    $Query->closeCursor();

    $isPasswordCorrect = password_verify($oldPassword, $pswAccount['password']);

    if($isPasswordCorrect){

        if($newPassword != $comfirmPassword){
            $return['statut'] = false;
            array_push($messages,'Les mots de passes ne correspondent pas');   
        }
        if(strlen($newPassword) < 8){
            $return['statut'] = false;
            array_push($messages,'Mot de passe trop court');    
        }
        if (!preg_match("#[0-9]+#", $newPassword)) {
            $return['statut'] = false;
            array_push($messages,'Le mot de passe doit contenir un chiffre');    
        }
        if (!preg_match("#[a-zA-Z]+#", $newPassword)) {
            $return['statut'] = false;
            array_push($messages,'Le mot de passe doit contenir une lettre');    
        }
        if($newPassword == $oldPassword){
            $return['statut'] = false;
            array_push($messages,"Le nouveau mot de passe doit être différent de l'ancien"); 
        }

        if($return['statut'] == false){
            
        }

        else{

            $newPassword=password_hash($newPassword, PASSWORD_DEFAULT);
            $Query = $dbh->query("UPDATE account
                                    SET password = '$newPassword'
                                    WHERE id =".$_SESSION['idAccount']);

            if($Query){
                $Query->closeCursor();
                $return['statut'] = true;
                array_push($messages,'Mot de passe modifié'); 
            }
            else{
                $return['statut'] = false;
                array_push($messages,'impossible de modifier le mot de passe');
            }
            
        }
    }
    else{
        $return['statut'] = false;
        array_push($messages,'Ancien mot de passe incorrect'); 
    }

    $toReturn = array(
        "statut" => $return['statut'],
        "message" => $messages
    );

    print_r(json_encode($toReturn));

