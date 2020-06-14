<?php
    session_start();
    if($_SESSION['typeAccount'] == "worker"){
        require_once('php/helpWorker.php');
    }
    elseif ($_SESSION['typeAccount'] == "requester") {
        require_once('php/helpRequester.php');
    }
    else {
        header('location: connexion.php');
    }
    
?>
