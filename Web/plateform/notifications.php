<?php
    session_start();
    if($_SESSION['typeAccount'] == "worker"){
        require_once('php/notifWorker.php');
    }
    elseif ($_SESSION['typeAccount'] == "requester") {
        require_once('php/notifRequester.php');
    }
    else {
        header('location: connexion.php');
    }
?>