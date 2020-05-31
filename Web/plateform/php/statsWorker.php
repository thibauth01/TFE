<?php
    require_once('inc/db_connect.php');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Statistiques - Youngr</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/now-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="demo/demo.css" rel="stylesheet" />
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
                            <a class="navbar-brand" href="#pablo">Mes statistiques</a>
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
                <div class="panel-header panel-header-lg">
                    <canvas id="salary"></canvas>
                    
                </div>

                <div class="content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-chart">
                                <div class="card-header">
                                    <h5 class="card-category">Total travaux terminé</h5>
                                    <h4 class="card-title">Cette année</h4>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="totalTravauxWorker"></canvas>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="now-ui-icons tech_watch-time"></i> <?php echo date("Y"); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="card card-chart">
                                <div class="card-header">
                                    <h5 class="card-category">Total travaux terminé</h5>
                                    <h4 class="card-title">Par type</h4>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="typeTravauxWorker" width="600" height="250"></canvas>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="now-ui-icons tech_watch-time"></i> depuis le début
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-12 ">
                            <div class="card card-chart">
                                <div class="card-header">
                                    <h5 class="card-category">Total travaux terminé</h5>
                                    <h4 class="card-title">Par villes</h4>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="placesTravauxWorker" width="auto" height="40"></canvas>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="now-ui-icons tech_watch-time"></i> depuis le début
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
<script src="js/plugins/jquery.star-rating-svg.js"></script>

<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<!-- <script src="demo/demo.js"></script> -->
<script src="js/main.js"></script>
<script src="js/statsWorker.js"></script>

<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
    });
</script>

</html>