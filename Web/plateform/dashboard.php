<?php
    session_start();
    print_r($_SESSION);
    if($_SESSION['typeAccount'] == "worker"){
        require_once('php/dashWorker.php');
    }
    elseif ($_SESSION['typeAccount'] == "requester") {
        require_once('php/dashRequester.php');
    }
    else {
        header('location: connexion.php');
    }
    
?>
