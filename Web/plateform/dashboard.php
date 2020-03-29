<?php
    session_start();
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
