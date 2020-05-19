<?php
    session_start();
    if($_SESSION['typeAccount'] == "worker"){
        require_once('php/statsWorker.php');
    }
    elseif ($_SESSION['typeAccount'] == "requester") {
        require_once('php/statsRequester.php');
    }
    else {
        header('location: connexion.php');
    }
?>