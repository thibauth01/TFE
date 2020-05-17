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

    <!-- CSS Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/now-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

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

                    $daysWorkerQuery = $dbh->query("   SELECT day.id FROM worker
                                                        JOIN availability on worker.id = availability.id_worker
                                                        JOIN day on day.id= availability.id_day
                                                        where worker.id=".$_SESSION['idTypeAccount']);

                    $daysWorker = $daysWorkerQuery->fetchAll(PDO::FETCH_ASSOC);
                    $daysWorkerQuery->closeCursor();

                    $typesWorkerQuery = $dbh->query("   SELECT type_work.id FROM worker
                                                        JOIN woker_Typer_work on worker.id = woker_Typer_work.id_worker
                                                        JOIN type_work on type_work.id= woker_Typer_work.id_type_work
                                                        where worker.id=".$_SESSION['idTypeAccount']);

                    $typesWorker = $typesWorkerQuery->fetchAll(PDO::FETCH_ASSOC);
                    $typesWorkerQuery->closeCursor();


                    $allTypesQuery = $dbh->query("SELECT * FROM type_work");
                    $allTypes = $allTypesQuery->fetchAll(PDO::FETCH_ASSOC);
                    $allTypesQuery->closeCursor();

                    $allDayQuery = $dbh->query("SELECT * FROM day");
                    $allDay = $allDayQuery->fetchAll(PDO::FETCH_ASSOC);
                    $allDayQuery->closeCursor();

                    if($infosWorker['profile_path'] == null){
                        $pathImg = "img/add-user.png";
                    }
                    else{
                        $pathImg = $infosWorker['profile_path'];
                    }
                    
                    

                ?>

                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header text-center text-primary">
                                    <h2 class="title">Modifiez vos informations</h2>
                                </div>
                                <form id="uploadForm" method='post'>
                                    <div class="ml-4 mb-3">
                                        <div class="adduser text-center">
                                            <img style="max-width:100px;max-height:100px" id="imgAvatar" onerror="this.onerror=null; this.src='img/add-user.png'" onclick="document.getElementById('inputAvatar').click();" class="mx-2 my-2" src="<?= $pathImg?>" alt="add-user"/>
                                        </div>
                                        <input  id="inputAvatar" type="file" accept="image/*" name="imageAvatar" style="display:none"/>
                                    </div>
                                </form>
                                <div class="card-body">
                                    <div class="">
                                        <form method="post" id="updateAccountWorker">
                                            <h5 class="px-2"> Vos Informations</h5>
                                            <div class="row">
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label for="lastName">Nom</label>
                                                        <input type="text" class="form-control" placeholder="Nom" value="<?=$infosWorker['last_name']?>" name="lastName" id="lastName">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="firstName">Prénom</label>
                                                        <input type="text" class="form-control" placeholder="Prénom" value="<?=$infosWorker['first_name']?>" name="firstName" id="firstName">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" placeholder="Email" value="<?=$infosWorker['email']?>" name="email" id="email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label for="birthday">Date de naissance</label>
                                                        <input type="date" class="form-control" placeholder="Date de naissance" value="<?=$infosWorker['birth_date']?>" name="birth" id="birthday">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="address">Adresse</label>
                                                        <input type="text" class="form-control" placeholder="Adresse" value="<?=$infosWorker['street']?>" name="address" id="address">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="postal">Code Postal</label>
                                                        <input type="text" class="form-control" placeholder="Code postal" value="<?=$infosWorker['postcode']?>" name="postal" id="postal">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label for="city">Ville</label>
                                                        <input type="text" class="form-control" placeholder="Ville" value="<?=$infosWorker['city']?>" name="city" id="city">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="country">Pays</label>
                                                        <input type="text" class="form-control" placeholder="Pays" value="<?=$infosWorker['country']?>" name="country" id="country">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group ">
                                                        <label class="">Distance Maximum (km)</label>
                                                        <input type="number" class="form-control" name="distance" max="50" min="1" value="<?=$infosWorker['maximum_distance']?>">
                                                    </div>
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

                                                    <?php
                                                    $idTypesTake = array();
                                                    foreach ($typesWorker as $type) {
                                                        array_push($idTypesTake,$type['id']);
                                                    }

                                                    foreach($allTypes as $type){

                                                        if (in_array($type['id'], $idTypesTake)){
                                                            echo "  <div class='form-group ml-3 '>
                                                                        <label class='pr-3'>".$type['name']." </label>
                                                                        <input type='checkbox' data-style='ios' data-toggle='toggle' data-onstyle='success' data-size='small' data-offstyle='danger' name='type[".$type['id']."]' checked>
                                                                    </div>";
                                                        }
                                                        else{
                                                            echo "  <div class='form-group ml-3 '>
                                                                        <label class='pr-3'>".$type['name']." </label>
                                                                        <input type='checkbox' data-style='ios' data-toggle='toggle' data-onstyle='success' data-size='small' data-offstyle='danger' name='type[".$type['id']."]'>
                                                                    </div>"; 
                                                        }
                                                        
                                                    }
                                                    
                                                    ?>                             
                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-3 text-right">
                                                    <?php
                                                        $idDaysTake = array();
                                                        foreach ($daysWorker as $day) {
                                                            array_push($idDaysTake,$day['id']);
                                                        }

                                                        foreach($allDay as $day){
                                                            if (in_array($day['id'], $idDaysTake)){
                                                                echo "  <div class='form-group ml-3 '>
                                                                            <label class='pr-3'>".$day['nom']." </label>
                                                                            <input type='checkbox' data-style='ios' data-toggle='toggle' data-onstyle='success' data-size='small' data-offstyle='danger' name='day[".$day['id']."]' checked>
                                                                        </div>";
                                                            }
                                                            else{
                                                                echo "  <div class='form-group ml-3 '>
                                                                            <label class='pr-3'>".$day['nom']." </label>
                                                                            <input type='checkbox' data-style='ios' data-toggle='toggle' data-onstyle='success' data-size='small' data-offstyle='danger' name='day[".$day['id']."]'>
                                                                        </div>"; 
                                                            }
                                                            
                                                        }
                                                        
                                                        ?> 
                                                </div>
                                                <div class="col-md-4"></div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-md-12 d-flex justify-content-center">
                                                    <input type="submit" class="btn btn-primary" value="Enregistrer les modifications">
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
<script src="js/account.js"></script>
<script src="js/main.js"></script>

<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
    });
</script>

</html>