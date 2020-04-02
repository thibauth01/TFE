<?php
    session_start();
    if($_SESSION['typeAccount'] == "worker"){
        require_once('php/accountWorker.php');
    }
    elseif ($_SESSION['typeAccount'] == "requester") {
        require_once('php/accountRequester.php');
    }
    else {
        header('location: connexion.php');
    }
?>
