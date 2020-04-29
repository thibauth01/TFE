<?php
    require_once('../inc/db_connect.php');

    $json = file_get_contents('php://input'); 	
    $obj = json_decode($json,true);
    
    $user = trim(htmlspecialchars($obj['user']));
    $password = trim(htmlspecialchars($obj['password']));

    $returnJSON = array(
        "status" => null,
        "txt" => null,
        "data" => null
    );

    $userQuery = $dbh->prepare( "SELECT id,first_name,last_name,username,password,type FROM account WHERE username = ?" );
    $userQuery->bindValue( 1, $user );
    $userQuery->execute();

    if( $userQuery->rowCount() >= 1 ) { 
        $user = $userQuery->fetch(PDO::FETCH_ASSOC);
        $userQuery->closeCursor();
        $isPasswordCorrect = password_verify($password, $user['password']);
        if($isPasswordCorrect){

            unset($user["password"]);
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
