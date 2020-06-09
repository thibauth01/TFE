<?php
    require_once('../inc/db_connect.php');

    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);
    
    $user = trim(htmlspecialchars($obj['user']));
    $password = trim(htmlspecialchars($obj['password']));
    $username = $user;

    $returnJSON = array(
        "status" => null,
        "txt" => null,
        "data" => null
    );

    $userQuery = $dbh->prepare( "SELECT id,first_name,last_name,username,password,type,jwt FROM account WHERE username = ?" );
    $userQuery->bindValue( 1, $user );
    $userQuery->execute();

    if( $userQuery->rowCount() >= 1 ) { 
        $user = $userQuery->fetch(PDO::FETCH_ASSOC);
        $userQuery->closeCursor();
        $isPasswordCorrect = password_verify($password, $user['password']);
        if($isPasswordCorrect){

            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $longueurMax = strlen($caracteres);
            $chaineAleatoire = '';

            for ($i = 0; $i < 100; $i++){
                $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
            }

            $Query = $dbh->prepare("UPDATE account SET jwt='".$chaineAleatoire."' WHERE username = '".$username."'");
            $Query -> execute();
            $Query->closeCursor();


            if($user['type'] == "worker"){
                $Query1 = $dbh->query("SELECT worker.id FROM worker WHERE id_account = ".$user['id']);
                $idTypeAccount = $Query1->fetch(PDO::FETCH_ASSOC);
                $idTypeAccount = $idTypeAccount['id'];
            }
            else if($user['type'] == "requester"){
                $Query1 = $dbh->query("SELECT requester.id FROM requester WHERE id_account = ".$user['id']);
                $idTypeAccount = $Query1->fetch(PDO::FETCH_ASSOC);
                $idTypeAccount = $idTypeAccount['id'];
            }
            else{
                $idTypeAccount = 0;
            }

            unset($user["password"]);
            $user["idTypeAccount"] = $idTypeAccount;
            $user["jwt"]=$chaineAleatoire;
            $returnJSON["status"] = true;
            $returnJSON["data"] = $user;
            $returnJSON["txt"] = "ok";

            echo json_encode($returnJSON);
        }
        else{

            $returnJSON["status"] = false;
            $returnJSON["txt"] = "Mot de passe incorrect";

            echo json_encode($returnJSON);
        }

    }

    else{
        $returnJSON["status"] = false;
        $returnJSON["txt"] = "Nom d'utilisateur incorrect";

        echo json_encode($returnJSON);
    }
?>

