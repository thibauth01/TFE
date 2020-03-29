<?php 

    session_start();
    if($_SESSION['typeAccount'] == "worker"){
        require_once('php/worksWorker.php');
    }
    elseif ($_SESSION['typeAccount'] == "requester") {
        require_once('php/worksRequester.php');
    }
    else {
        header('location: connexion.php');
    }
?>
