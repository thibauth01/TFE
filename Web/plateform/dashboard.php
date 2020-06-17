<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-169400142-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-169400142-1');
</script>

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
