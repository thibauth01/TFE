<?php

    require_once('inc/db_connect.php');
    require_once('php/utils.php');
    
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Mes travaux -Youngr</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/now-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="demo/demo.css" rel="stylesheet" />

    <link href="css/custom.css" rel="stylesheet"/>
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
                <div class="panel-header panel-header-sm">
                </div>

                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-tasks">
                                <div class="card-header">
                                    <h4 class="card-title">Mes Travaux - <strong class="text-danger">Libres</strong></h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-full-width table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <?php
                                                    $WorkQuery = $dbh->query("  SELECT work.id,title, id_type, description, id_requester, min_age_worker, date_start, time_start, time_end, place, statut_progress, name, price
                                                                                FROM work JOIN type_work 
                                                                                ON work.id_type = type_work.id 
                                                                                WHERE id_requester = '".$_SESSION['idTypeAccount']."' AND id_worker is NULL AND finish = 0 AND cancelled =0 ");

                                                    $worksFree = $WorkQuery->fetchAll(PDO::FETCH_ASSOC);
                                                    $WorkQuery->closeCursor();

                                                    $worksFree = notPassedWorks($worksFree);
                                                
                                                    foreach($worksFree as $work){
                                                        $id=$work['id'];
                                                        $tmstp =  strtotime($work['date_start']);
                                                        $work['date_start'] = date("d-m-Y", $tmstp);
                                                        
                                                        echo "<tr id='rowfree".$id."'>
                                                                <td class='text-left'>".$work['title']."</td>
                                                                <td></td>
                                                                <td class='text-danger'>".$work['name']."</td>
                                                                <td>".$work['date_start']."</td>
                                                                <td class='td-actions text-right'>
                                                                    <button type='button' rel='tooltip' title='' class='btn btn-info btn-round btn-icon btn-icon-mini btn-neutral' data-original-title='Info Work' data-toggle='collapse' data-target='#detailFree".$work['id']."'>
                                                                        <i class='now-ui-icons travel_info'></i>
                                                                    </button>
                                                                    <button type='button' onclick='removeWorkFreeRequester(this);' rel='tooltip' title='' class='btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral' data-original-title='Remove Work' >
                                                                        <i class='now-ui-icons ui-1_simple-remove'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>";
                                                    }
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                    foreach($worksFree as $work){
                            $tmstp =  strtotime($work['date_start']);
                            $date = date("d-m-Y", $tmstp);
                            $timeStart = date("G:i", strtotime($work['time_start']));
                            $timeEnd = date("G:i", strtotime($work['time_end']));
                            $minutesWork = timeSpace($work['time_start'],$work['time_end']);
                            $price = $minutesWork * ($work['price']/60);

                        echo "<div class='row collapse'  id='detailFree".$work['id']."'>
                                    <div class='col-md-12 d-flex'>
                                        <div class='card'>
                                            <div class='card-header'>
                                                <!--<button type='button' class='close' onclick='closeDetails(this);'>
                                                    <span aria-hidden='true'>&times;</span>
                                                </button>-->
                                                <div class='row'>
                                                    <div class='col-md-8'>
                                                        <h5 class='card-title'>".$work['title']."</h5>
                                                    </div>
                                                    <div class='col-md-4 text-right'>
                                                        <h5 class='card-title text-danger'>".$work['name']."</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='card-body'>
                                                <div class='row text-center mt-2'>
                                                    <div class='col-md-3'>
                                                        <i class='now-ui-icons ui-1_calendar-60' style='font-size:20px'></i>
                                                        <p>".$date."<p>
                                                    </div>
                                                    <div class='col-md-3'>
                                                        <i class='now-ui-icons tech_watch-time' style='font-size:20px'></i>
                                                        <p>".$timeStart." - ".$timeEnd."<p>
                                                    </div>
                                                    <div class='col-md-3'>
                                                        <i class='now-ui-icons location_pin' style='font-size:20px'></i>
                                                        <p>".$work['place']."<p>
                                                    </div>
                                                    <div class='col-md-3'>
                                                        <i class='now-ui-icons shopping_credit-card' style='font-size:20px'></i>
                                                        <p>".$price."€<p>
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-md-12 px-3'>
                                                        <p>".$work['description']."</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                </div>";

                    }
                    ?>
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-tasks">
                                <div class="card-header">
                                    <h4 class="card-title">Mes travaux - <strong class="text-warning">Pris</strong></h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-full-width table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <?php
                                                        $WorkQuery = $dbh->query("SELECT work.id as id, title, description, id_worker, date_start,time_start,time_end,place, type_work.name as name_type, id_account,star,first_name,last_name,birth_date,profile_path,price,phone
                                                                                    FROM work
                                                                                    JOIN type_work on work.id_type = type_work.id
                                                                                    JOIN worker on id_worker = worker.id
                                                                                    JOIN account on worker.id_account = account.id
                                                                                    WHERE work.id_requester = ".$_SESSION['idTypeAccount']." AND id_worker is NOT NULL AND finish = 0 AND cancelled =0;");

                                                        $worksTake = $WorkQuery->fetchAll(PDO::FETCH_ASSOC);
                                                        $WorkQuery->closeCursor();
                                                    
                                                        foreach($worksTake as $work){
                                                            
                                                            $tmstp =  strtotime($work['date_start']);
                                                            $work['date_start'] = date("Ymd", $tmstp);
                                                            $now = date("Ymd");

                                                            if($work['date_start'] >= $now){
                                                                $work['date_start'] = date("d-m-Y", $tmstp);
                                                            }
                                                            else{
                                                                $work['date_start'] = "A Finir";
                                                            }

                                                            if($work['profile_path'] == NULL){
                                                                $work['profile_path'] = 'img/user-1.jpg';  
                                                            }
                                                            $id=$work['id'];
                                                            echo "<tr id='rowtake".$id."'>
                                                                    <td style='width:60px'>
                                                                        <img src='".$work['profile_path'] ."' height='50px' width='50px'>
                                                                    </td>
                
                                                                    <td class='text-left pl-3'>".$work['title']."</td>
                                                                    <td class='text-danger'>".$work['name_type']."</td>
                                                                    <td>".$work['date_start']."</td>
                                                                    <td class='td-actions text-right'>
                                                                        <button type='button' onclick='finishJob(this);' rel='tooltip' title='' class='btn btn-success btn-round btn-icon btn-icon-mini btn-neutral' data-original-title='Remove Work' >
                                                                            <i class='now-ui-icons ui-1_check'></i>
                                                                        </button>
                                                                        <button type='button' rel='tooltip' title='' class='btn btn-info btn-round btn-icon btn-icon-mini btn-neutral' data-original-title='Info Work' data-toggle='collapse' data-target='#detailTake".$work['id']."'>
                                                                            <i class='now-ui-icons travel_info'></i>
                                                                        </button>
                                                                        <button type='button' onclick='removeWorkTakeRequester(this);' rel='tooltip' title='' class='btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral' data-original-title='Remove Work' >
                                                                            <i class='now-ui-icons ui-1_simple-remove'></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>";
                                                        }
                                                    ?>
                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        
                        foreach($worksTake as $work){

                            $tmstp =  strtotime($work['date_start']);
                            $work['date_start'] = date("d-m-Y", $tmstp);
                            $timeStart = date("G:i", strtotime($work['time_start']));
                            $timeEnd = date("G:i", strtotime($work['time_end']));
                            if($work['profile_path'] == NULL){
                                $work['profile_path'] = 'img/user-1.jpg';  
                            }
                            $age = age($work['birth_date']);
                            $minutesWork = timeSpace($work['time_start'],$work['time_end']);
                            $price = $minutesWork * ($work['price']/60);

                            echo "<div class='collapse'  id='detailTake".$work['id']."'>
                                    <div class='row'>
                                            <div class='col-md-3 d-flex'>
                                                <div class='card card-user'>
                                                    <div class='card-body'>
                                                        <div class='text-center'>
                                                            <a href='#'>
                                                                <img class='avatar border-gray' src='".$work['profile_path']."' alt='Profile picture'>
                                                                <h5 class='title'>".$work['first_name']." ".$work['last_name']."</h5>
                                                            </a>
                                                            <p class='description'>
                                                                ".$age." Ans
                                                            </p>
                                                        </div>
                                                        <p class='text-center'>
                                                            ".$work['phone']."
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-9 d-flex'>
                                                <div class='card'>
                                                    <div class='card-header'>
                                                        <div class='row'>
                                                            <div class='col-md-8'>
                                                                <h5 class='card-title'>".$work['title']."</h5>
                                                            </div>
                                                            <div class='col-md-4 text-right'>
                                                                <h5 class='card-title text-danger'>".$work['name_type']."</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='card-body'>
                                                        <div class='row text-center mt-2'>
                                                            <div class='col-md-3'>
                                                                <i class='now-ui-icons ui-1_calendar-60' style='font-size:20px'></i>
                                                                <p>".$work['date_start']."<p>
                                                            </div>
                                                            <div class='col-md-3'>
                                                                <i class='now-ui-icons tech_watch-time' style='font-size:20px'></i>
                                                                <p>".$timeStart." - ".$timeEnd."<p>
                                                            </div>
                                                            <div class='col-md-3'>
                                                                <i class='now-ui-icons location_pin' style='font-size:20px'></i>
                                                                <p>".$work['place']."<p>
                                                            </div>
                                                            <div class='col-md-3'>
                                                                <i class='now-ui-icons shopping_credit-card' style='font-size:20px'></i>
                                                                <p>".$price."€<p>
                                                            </div>
                                                        </div>
                                                        <div class='row'>
                                                            <div class='col-md-12 px-3 pt-4'>
                                                                <p>".$work['description']."</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>";
                        }
                        
                    ?>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-tasks">
                                <div class="card-header">
                                    <h4 class="card-title">Mes travaux - <strong class="text-success">Fait</strong></h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-full-width table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <?php
                                                        $WorkQuery = $dbh->query("SELECT work.id as id, title, description, id_worker, date_start,time_start,time_end,place, type_work.name as name_type, id_account,star,first_name,last_name,birth_date,profile_path,price,phone
                                                                                    FROM work
                                                                                    JOIN type_work on work.id_type = type_work.id
                                                                                    JOIN worker on id_worker = worker.id
                                                                                    JOIN account on worker.id_account = account.id
                                                                                    WHERE work.id_requester = ".$_SESSION['idTypeAccount']." AND id_worker is NOT NULL AND finish = 1 AND cancelled =0;");

                                                        $worksDone = $WorkQuery->fetchAll(PDO::FETCH_ASSOC);
                                                        $WorkQuery->closeCursor();

                                                        foreach($worksDone as $work){
                                                            
                                                            $tmstp =  strtotime($work['date_start']);
                                                            $work['date_start'] = date("d-m-Y", $tmstp);
                                                            if($work['profile_path'] == NULL){
                                                                $work['profile_path'] = 'img/user-1.jpg';  
                                                            }
                                                            $id=$work['id'];
                                                            echo "<tr id='rowDone".$id."'>
                                                                    <td style='width:60px'>
                                                                        <img src='".$work['profile_path'] ."' height='50px' width='50px'>
                                                                    </td>
                
                                                                    <td class='text-left pl-3'>".$work['title']."</td>
                                                                    <td class='text-danger'>".$work['name_type']."</td>
                                                                    <td>".$work['date_start']."</td>
                                                                    <td class='td-actions text-right'>
                                                                        <button type='button' rel='tooltip' title='' class='btn btn-info btn-round btn-icon btn-icon-mini btn-neutral' data-original-title='Info Work' data-toggle='collapse' data-target='#detailDone".$work['id']."'>
                                                                            <i class='now-ui-icons travel_info'></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>";
                                                        }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        
                        foreach($worksDone as $work){

                            $tmstp =  strtotime($work['date_start']);
                            $work['date_start'] = date("d-m-Y", $tmstp);
                            $timeStart = date("G:i", strtotime($work['time_start']));
                            $timeEnd = date("G:i", strtotime($work['time_end']));
                            if($work['profile_path'] == NULL){
                                $work['profile_path'] = 'img/user-1.jpg';  
                            }
                            $age = age($work['birth_date']);
                            $minutesWork = timeSpace($work['time_start'],$work['time_end']);
                            $price = $minutesWork * ($work['price']/60);

                            echo "<div class='collapse'  id='detailDone".$work['id']."'>
                                    <div class='row'>
                                            <div class='col-md-3 d-flex'>
                                                <div class='card card-user'>
                                                    <div class='card-body'>
                                                        <div class='text-center'>
                                                            <a href='#'>
                                                                <img class='avatar border-gray' src='".$work['profile_path']."' alt='Profile picture'>
                                                                <h5 class='title'>".$work['first_name']." ".$work['last_name']."</h5>
                                                            </a>
                                                            <p class='description'>
                                                                ".$age." Ans
                                                            </p>
                                                        </div>
                                                        <p class='text-center'>
                                                            ".$work['phone']."
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-9 d-flex'>
                                                <div class='card'>
                                                    <div class='card-header'>
                                                        <div class='row'>
                                                            <div class='col-md-8'>
                                                                <h5 class='card-title'>".$work['title']."</h5>
                                                            </div>
                                                            <div class='col-md-4 text-right'>
                                                                <h5 class='card-title text-danger'>".$work['name_type']."</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='card-body'>
                                                        <div class='row text-center mt-2'>
                                                            <div class='col-md-3'>
                                                                <i class='now-ui-icons ui-1_calendar-60' style='font-size:20px'></i>
                                                                <p>".$work['date_start']."<p>
                                                            </div>
                                                            <div class='col-md-3'>
                                                                <i class='now-ui-icons tech_watch-time' style='font-size:20px'></i>
                                                                <p>".$timeStart." - ".$timeEnd."<p>
                                                            </div>
                                                            <div class='col-md-3'>
                                                                <i class='now-ui-icons location_pin' style='font-size:20px'></i>
                                                                <p>".$work['place']."<p>
                                                            </div>
                                                            <div class='col-md-3'>
                                                                <i class='now-ui-icons shopping_credit-card' style='font-size:20px'></i>
                                                                <p>".$price."€<p>
                                                            </div>
                                                        </div>
                                                        <div class='row'>
                                                            <div class='col-md-12 px-3 pt-4'>
                                                                <p>".$work['description']."</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>";
                        }
                        
                    ?>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="demo/demo.js"></script>
<script src="js/works.js"></script>
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
    });
</script>

</html>