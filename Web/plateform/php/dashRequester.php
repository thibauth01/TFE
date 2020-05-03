<?php 
    
    require_once('inc/db_connect.php');
    require_once('php/utils.php');
    
    
    //SELECT INFOS ACCOUNT
    $requesterQuery = $dbh->prepare( "SELECT `first_name`, `last_name`, `email`, `username`, `street`,`postcode`,`city`,`country` FROM `account` WHERE `id` = ?" );
    $requesterQuery->bindValue( 1, $_SESSION['idAccount']);
    $requesterQuery->execute();

    $infos = $requesterQuery->fetch(PDO::FETCH_ASSOC);
    $requesterQuery->closeCursor();
 
    //SELECT TYPE WORK
    $typeWorkQuery = $dbh->query('SELECT * FROM type_work');
    $typesWork = $typeWorkQuery->fetchAll(PDO::FETCH_ASSOC);
    $typeWorkQuery->closeCursor();


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Dashboard - Youngr</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
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
                            <a class="navbar-brand" href="#pablo">Dashboard</a>
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
                    <canvas id="bigDashboardChart"></canvas>
                </div>

                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-category">Besoin d'aide ?</h5>
                                    <h4 class="card-title">Ajoute un travail !</h4>
                                </div>
                                <div class="card-body">
                                    <div class="stats">
                                        <form id="addJobForm" method="post">
                                            <div class="row">
                                                <div class="col-md-6 pr-1">
                                                    <div class="form-group">
                                                        <label>Title (Short description)</label>
                                                        <input type="text" class="form-control" maxlength="40" value="" name="title">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 px-1">
                                                    <label>Type</label>
                                                    <select class="form-control" name="type" id="selectType">
                                                        <?php
                                                            foreach($typesWork as $row){
                                                                echo "<option id='".$row['id']."'>".$row['name']."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 px-1">
                                                    <label>Age min worker</label>
                                                    <input type="number" class="form-control" min="15" max="25" value="" name="ageMin">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 pr-1">
                                                    <div class="form-group">
                                                        <label>Date</label>
                                                        <input type="date" class="form-control" value="" name="date">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pl-1">
                                                    <div class="form-group">
                                                        <label>Time Start</label>
                                                        <input type="time" class="form-control" value=""  name="timeStart">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pl-1">
                                                    <div class="form-group">
                                                        <label>Time End</label>
                                                        <input type="time" class="form-control" value="" name="timeEnd">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pl-1">
                                                    <div class="form-group">
                                                        <label>Rémunération / h</label>
                                                        <input type="number" class="form-control" min="8" max="25" value="" name="price">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label>Street</label>
                                                        <input type="text" class="form-control" value="<?= $infos['street']?>" name="street">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 px-1">
                                                    <div class="form-group">
                                                        <label>Postal Code</label>
                                                        <input type="text" class="form-control" value="<?= $infos['postcode']?>" name="postal">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-7 pr-1">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" class="form-control" value="<?= $infos['city']?>" name="city">
                                                    </div>
                                                </div>
                                                <div class="col-md-5 pl-1">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <input type="text" class="form-control disable"  value="<?= $infos['country']?>" name="country">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea rows="1" maxlength="200" cols="4" class="form-control" name="description" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 pr-3 d-flex justify-content-end">
                                                    <input type="submit" class="btn btn-outline-primary ml-3" value="Add job">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $id_requester = $_SESSION['idTypeAccount'];
                    $nextWorkQuery = $dbh->query("  SELECT title, name, description,date_start,time_start,time_end,place,price,account.city as city,account.first_name as first_name,account.last_name as last_name,account.profile_path as profile_path
                                                    FROM work 
                                                    JOIN type_work on type_work.id = work.id_type
                                                    JOIN worker on  worker.id = work.id_worker
                                                    JOIN account on account.id = worker.id_account
                                                    WHERE id_worker IS NOT NULL AND finish = 0 AND cancelled = 0 AND id_requester = '$id_requester' order by date_start");
                                          
                    $nextWorks = $nextWorkQuery->fetchAll(PDO::FETCH_ASSOC);
                    $nextWorkQuery->closeCursor();

                    //Prendre si la date n'est pas passée
                    $nextWork;
                    foreach($nextWorks as $work){
                        $tmstp =  strtotime($work['date_start']);
                        $date =  date("Ymd", $tmstp);
                        $now = date("Ymd");
                        
                        if($date >= $now){
                            $nextWork=$work;
                            break;
                        }
                    }
                    if($nextWork){
                        $tmstp =  strtotime($nextWork['date_start']);
                        $nextWork['date_start'] = date("d-m-Y", $tmstp);
                        $timeStart = date("G:i", strtotime($nextWork['time_start']));
                        $timeEnd = date("G:i", strtotime($nextWork['time_end']));
                        $minutesWork = timeSpace($nextWork['time_start'],$nextWork['time_end']);
                        $price = $minutesWork * ($nextWork['price']/60);
                        if($nextWork['profile_path'] == NULL){
                            $nextWork['profile_path'] = 'img/user-1.jpg';  
                        }
                        echo "<div class='row'>
                                <div class='col-md-12 d-flex'>
                                    <div class='card card-user'>
                                        <div class='card-header'>
                                            
                                        </div>
                                        <div class='card-body'>
                                            <div class='row'>
                                                <div class='col-md-3'>
                                                    <h5 class='card-category'>Next Worker</h5>
                                                    <div class='text-center'>
                                                        <a href='#'>
                                                            <img class='avatar border-gray' onerror=\"this.onerror=null; this.src='img/default-user.png'\" src='".$nextWork['profile_path']."' alt='...'>
                                                            <h5 class='title'>".$nextWork['first_name']." ".$nextWork['last_name']."</h5>
                                                        </a>
                                                        <p class='description'>
                                                        ".$nextWork['city']."
                                                        </p>
                                                    </div>
                                                    <p class='text-center'> 12 works already given</p>
                                                </div>
                                                <div class='col-md-9'>
                                                    <div class='row'>
                                                        <div class='col-md-8'>
                                                            <h5 class='card-title'>".$nextWork['title']."</h5>
                                                        </div>
                                                        <div class='col-md-4 text-right'>
                                                            <h5 class='card-title text-danger'>".$nextWork['name']."</h5>
                                                        </div>
                                                    </div>
                                                    <div class='row text-center mt-5'>
                                                        <div class='col-md-3'>
                                                            <i class='now-ui-icons ui-1_calendar-60' style='font-size:20px'></i>
                                                            <p>".$nextWork['date_start']."<p>
                                                        </div>
                                                        <div class='col-md-3'>
                                                            <i class='now-ui-icons tech_watch-time' style='font-size:20px'></i>
                                                            <p>".$timeStart." - ".$timeEnd."<p>
                                                        </div>
                                                        <div class='col-md-3'>
                                                            <i class='now-ui-icons location_pin' style='font-size:20px'></i>
                                                            <p>".$nextWork['place']."<p>
                                                        </div>
                                                        <div class='col-md-3'>
                                                            <i class='now-ui-icons shopping_credit-card' style='font-size:20px'></i>
                                                            <p>".$price."€<p>
                                                        </div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class='col-md-12 mt-4'>
                                                            <p>".$nextWork['description']."</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                    }


                    ?>
                    
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
<script src="js/dashboard.js"></script>

<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
    });
</script>

</html>