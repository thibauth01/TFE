<?php
    session_start();
    if(!$_SESSION['typeAccount']){
        header('location: connexion.php');    
    }
    
?>

<?php
    require_once('inc/db_connect.php');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
    <link rel="icon" href="img/icon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Aide - Youngr</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="demo/demo.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/now-ui-dashboard.css?v=1.0.1" rel="stylesheet" />

</head>

<body class="">
    <div class="wrapper ">

        <?php require_once ('inc/header_sidebar.inc.php'); ?>

            <div class="main-panel">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top">
                    <div class="container-fluid">
                        <div class="navbar-wrapper">
                            <div class="navbar-toggle">
                                <button type="button" class="navbar-toggler">
                                    <span class="navbar-toggler-bar bar1"></span>
                                    <span class="navbar-toggler-bar bar2"></span>
                                    <span class="navbar-toggler-bar bar3"></span>
                                </button>
                            </div>
                            <a class="navbar-brand" href="#pablo">Aide</a>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                        </button>
                        <?php require_once ('inc/header_top.inc.php'); ?>
                    </div>
                </nav>
                <!-- End Navbar -->
                <div class="panel-header panel-header-sm">
                    
                </div>

                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"></h4>
                                </div>
                                <div class="card-body">
                                    <h3>Dashboard</h3>
                                    <div class="ml-3">
                                        <h6>Propositions De Travail</h6>
                                        <p>Cette section liste les travaux disponible selon vos critères.<br>
                                        <i class='now-ui-icons ui-1_check'></i> = accepter le travail
                                                                                            <br>
                                        <i class='now-ui-icons travel_info'></i> = infos supplémentaires</p>

                                        <h6>Prochain travail</h6>
                                        <p>Cette section contient les informations de votre prochain travail a réaliser</p><br><br>
                                    </div>


                                    <h3>Travaux</h3>
                                    <div class="ml-3">
                                        <h6>A Faire </h6>
                                        <p>Cette section liste vos prochains travaux a réaliser<br>
                                        <i class='now-ui-icons travel_info'></i> = infos supplémentaires<br>
                                        <i class='now-ui-icons ui-1_simple-remove'></i> = annuler le travail</p>

                                        <h6>Fait</h6>
                                        <p>Cette section liste vos travaux réalisés<br>
                                        <i class='now-ui-icons travel_info'></i> = infos supplémentaires</p><br><br>
                                    </div>

                                    <h3>Messages</h3>
                                    <div class="ml-3">
                                        <h6>Conversations </h6>
                                        <p>Cette section liste vos conversations. Chaque conversation correspond à un travail à réalisé. Une fois le travail terminé, la conversation disparait. <br>
                                            Vous pouvez envoyer des messages lorsque vous cliquez sur une conversation </p><br><br>
                                    </div>

                                    <h3>Nofications</h3>
                                    <div class="ml-3">
                                        <h6>Nouvelles </h6>
                                        <p>Cette section liste vos notifications non lues. <br>
                                        Vous recevez des notifications lorsque l'on annule un de vos travaux, lorsque vous êtes refusé pour un travail, ...<br>
                                        <i class='now-ui-icons ui-1_simple-remove'></i> = marquer la notification comme lue</p><br>
                                        <h6>Anciennes </h6>
                                        <p>Cette section liste vos 20 dernières notifications lues. </p><br><br>
                                    </div>

                                    <h3>Satistiques</h3>
                                    <div class="ml-3">
                                        <p>Cette section contient différentes statistiques concernant votre activité sur le plateforme<p><br><br>
                                    </div>

                                    <h3>Mon compte</h3>
                                    <div class="ml-3">
                                        <p>Cette section vous permet de modifier vos informations personnelles, changer votre mot de passe, vos critères de selection et votre nombre d'étoiles.<br>
                                            Vous pouvez ajouter une photo de profil en cliquant sur l'icone<p><br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once('inc/footer.php');?>
            </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="js/core/jquery.min.js"></script>
<script src="js/core/popper.min.js"></script>
<script src="js/core/bootstrap.min.js"></script>
<script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="js/now-ui-dashboard.js?v=1.0.1"></script>
<script src="js/notifications.js"></script>


</html>