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
    <title>Mon compte - Youngr</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <!-- CSS Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/now-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="demo/demo.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" />
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
                            <a class="navbar-brand" href="#pablo">Mon compte</a>
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

                <?php
                    $infosWorkerQuery = $dbh->query("   SELECT * FROM account
                                                        JOIN worker on worker.id_account = account.id
                                                        where account.id=".$_SESSION['idAccount']);

                    $infosWorker = $infosWorkerQuery->fetch(PDO::FETCH_ASSOC);
                    $infosWorkerQuery->closeCursor();

                    $daysWorkerQuery = $dbh->query("   SELECT * FROM worker
                                                        JOIN availability on worker.id = availability.id_worker
                                                        JOIN day on day.id= availability.id_day
                                                        where worker.id=".$_SESSION['idTypeAccount']);

                    $daysWorker = $daysWorkerQuery->fetchAll(PDO::FETCH_ASSOC);
                    $daysWorkerQuery->closeCursor();

                    $typesWorkerQuery = $dbh->query("   SELECT * FROM worker
                                                        JOIN woker_Typer_work on worker.id = woker_Typer_work.id_worker
                                                        JOIN type_work on type_work.id= woker_Typer_work.id_type_work
                                                        where worker.id=".$_SESSION['idTypeAccount']);

                    $typessWorker = $typesWorkerQuery->fetchAll(PDO::FETCH_ASSOC);
                    $typesWorkerQuery->closeCursor();

                    /*
                    ENCORE FAIRE LES COMPETENCES ET DISPO PUIS AJOUTER TOUT CA
                    */

                ?>

                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header text-center text-primary">
                                    <h2 class="title">Modifiez vos informations</h2>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <form method="post" id="workerForm">
                                            <h5 class="px-2"> Vos Informations</h5>
                                            <div class="row">
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label for="lastNameSignWork">Nom</label>
                                                        <input type="text" class="form-control" placeholder="Nom" value="<?=$infosWorker['last_name']?>" name="lastName" id="lastNameSignWork">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="firstNameSignWork">Prénom</label>
                                                        <input type="text" class="form-control" placeholder="Prénom" value="<?=$infosWorker['first_name']?>" name="firstName" id="firstNameSignWork">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="emailSignWork">Email</label>
                                                        <input type="email" class="form-control" placeholder="Email" value="<?=$infosWorker['email']?>" name="email" id="emailSignWork">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label for="usernameSignWork">Nom d'utilisateur</label>
                                                        <input type="text" class="form-control" placeholder="Nom d'utilisateur" value="<?=$infosWorker['username']?>" name="username" id="usernameSignWork">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="passwordSignWork">Nouveau mot de passe</label>
                                                        <input type="password" class="form-control" placeholder="Mot de passe" value="" name="password" id="passwordSignWork">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="passwordConfirmSignWork">Confirmation du nouveau mot de passe</label>
                                                        <input type="password" class="form-control" placeholder="Confirmation du mot de passe" value="" name="Confirmpassword" id="passwordConfirmSignWork">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label for="birthdaySignWork">Date de naissance</label>
                                                        <input type="date" class="form-control" placeholder="Date de naissance" value="" name="birth" id="birthdaySignWork">
                                                    </div>
                                                </div>
                                                <div class="col-md-8 px-1">
                                                    <div class="form-group">
                                                        <label for="addressSignWork">Adresse</label>
                                                        <input type="text" class="form-control" placeholder="Adresse" value="<?=$infosWorker['street']?>" name="address" id="addressSignWork">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label for="postalSignWork">Code Postal</label>
                                                        <input type="text" class="form-control" placeholder="Code postal" value="<?=$infosWorker['postcode']?>" name="postal" id="postalSignWork">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="citySignWork">Ville</label>
                                                        <input type="text" class="form-control" placeholder="Ville" value="<?=$infosWorker['city']?>" name="city" id="citySignWork">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="countrySignWork">Pays</label>
                                                        <input type="text" class="form-control" placeholder="Pays" value="<?=$infosWorker['country']?>" name="country" id="countrySignWork">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group ">
                                                    <label class="">Distance Maximum (km)</label>
                                                    <input type="number" class="form-control" name="distance" max="50" min="1" value="<?=$infosWorker['maximum_distance']?>">
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <h5 class="px-2 mt-4">Vos compétences</h5>
                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-4 text-right">
                                                    <h5 class="px-2 mt-4"> Vos disponibilitées</h5>
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-4 text-right ">
                                                    <style>
                                                        .toggle.ios,
                                                        .toggle-on.ios,
                                                        .toggle-off.ios {
                                                            border-radius: 10px;
                                                        }
                                                        
                                                        .toggle.ios .toggle-handle {
                                                            border-radius: 50px;
                                                        }
                                                    </style>
                                                    <div class="form-group ml-3 ">
                                                        <label class="pr-3">Baby-Sitting </label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[babySitting]">
                                                    </div>
                                                    <div class="form-group ml-3">
                                                        <label class="pr-3">Travaux ménagers </label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[housework]">
                                                    </div>
                                                    <div class="form-group ml-3 ">
                                                        <label class="pr-3">Jardinage</label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[gardening]">
                                                    </div>
                                                    <div class="form-group ml-3">
                                                        <label class="pr-3">Garde d'animaux </label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[petsitting]">
                                                    </div>
                                                    <div class="form-group ml-3">
                                                        <label class="pr-3">Bricolage</label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[bricolage]">
                                                    </div>
                                                    <div class="form-group ml-3">
                                                        <label class="pr-3">Faire des courses</label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[shopping]">
                                                    </div>
                                                    <div class="form-group ml-1">
                                                        <label class="pr-3">Cours particuliers</label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[lessons]">
                                                    </div>
                                                    <div class="form-group ml-3">
                                                        <label class="pr-3">Technologie</label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[technology]">
                                                    </div>
                                                    <div class="form-group ml-5">
                                                        <label class="pr-3">Autres</label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[other]">
                                                    </div>
                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3 text-right">

                                                    <div class="form-group ml-3">
                                                        <label class="pr-3"> Lundi</label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="day[monday]">
                                                    </div>

                                                    <div class="form-group ml-3">
                                                        <label class="pr-3"> Mardi</label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="day[thuesday]">
                                                    </div>

                                                    <div class="form-group ml-3">
                                                        <label class="pr-3"> Mercredi</label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="day[wednesday]">
                                                    </div>

                                                    <div class="form-group ml-3">
                                                        <label class="pr-3"> Jeudi</label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="day[thursday]">
                                                    </div>

                                                    <div class="form-group ml-3">
                                                        <label class="pr-3"> Vendredi</label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="day[friday]">
                                                    </div>

                                                    <div class="form-group ml-3">
                                                        <label class="pr-3"> Samedi</label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="day[saturday]">
                                                    </div>

                                                    <div class="form-group ml-3">
                                                        <label class="pr-3"> Dimanche</label>
                                                        <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="day[sunday]">
                                                    </div>

                                                </div>
                                                <div class="col-md-4"></div>
                                                <div class="row ">
                                                    <div class="col-md-12 d-flex justify-content-center">
                                                        <input type="submit" class="btn btn-primary" value="Inscription">
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="errormsgSign" class="container"></div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <nav>
                            <ul>
                                <li>
                                    <a href="https://www.creative-tim.com">
                                    Creative Tim
                                </a>
                                </li>
                                <li>
                                    <a href="http://presentation.creative-tim.com">
                                    About Us
                                </a>
                                </li>
                                <li>
                                    <a href="http://blog.creative-tim.com">
                                    Blog
                                </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="copyright">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>, Designed by
                            <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by
                            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
                        </div>
                    </div>
                </footer>
            </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="js/core/jquery.min.js"></script>
<script src="js/core/popper.min.js"></script>
<script src="js/core/bootstrap.min.js"></script>
<script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="js/now-ui-dashboard.js?v=1.0.1"></script>
<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="demo/demo.js"></script>
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
    });
</script>

</html>