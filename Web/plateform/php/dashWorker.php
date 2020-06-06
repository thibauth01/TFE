<?php
    ini_set('display_errors', 0);
    error_reporting(E_ALL);

    require_once('inc/db_connect.php');
    require_once('php/utils.php');

    $birthQuery = $dbh->query("SELECT birth_date FROM account WHERE id=". $_SESSION['idAccount']);

    $birth = $birthQuery->fetchAll(PDO::FETCH_ASSOC);
    $birthQuery->closeCursor();
    $birth = $birth[0]['birth_date'];
    
    $_SESSION['age'] = age($birth);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Dashboard</title>
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
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-category">Propositions de travail</h5>
                                    <h4 class="card-title">Veux tu faire ce travail ?</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-full-width table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <?php
                                                require_once('php/apiDistance.php');

                                                //SELECT infos worker (adress,max distance)
                                                $infosWorkerQuery = $dbh->query("   SELECT account.id as id,street, postcode,city,country,maximum_distance 
                                                                                    FROM account 
                                                                                    JOIN worker on account.id = worker.id_account
                                                                                    WHERE account.id =".$_SESSION['idAccount']);

                                                $infosWorker = $infosWorkerQuery->fetchAll(PDO::FETCH_ASSOC);
                                                $infosWorkerQuery->closeCursor(); 
                                                $infosWorker = $infosWorker[0]; 

                                                //SELECT availability worker (id,day)
                                                $availableWorkerQuery = $dbh->query("   SELECT id_day,nom
                                                                                        FROM worker 
                                                                                        JOIN availability on worker.id = availability.id_worker
                                                                                        JOIN day on availability.id_day = day.id
                                                                                        WHERE worker.id =".$_SESSION['idTypeAccount']);

                                                $availableWorker = $availableWorkerQuery->fetchAll(PDO::FETCH_ASSOC);
                                                $availableWorkerQuery->closeCursor();

                                                //SELECT type_work worker (id,type)
                                                $typeWorkerQuery = $dbh->query("SELECT id_type_work,name
                                                                                FROM worker 
                                                                                JOIN woker_Typer_work on worker.id = woker_Typer_work.id_worker
                                                                                JOIN type_work on woker_Typer_work.id_type_work = type_work.id
                                                                                WHERE worker.id =".$_SESSION['idTypeAccount']);

                                                $typeWorker = $typeWorkerQuery->fetchAll(PDO::FETCH_ASSOC);
                                                $typeWorkerQuery->closeCursor();


                                                //SELECT all works free with age
                                                $worksFreeQuery = $dbh->query("SELECT work.id as id, title, description,id_type,type_work.name as type_name, id_requester,date_start,time_start,time_end,place,first_name,last_name,city,profile_path,price 
                                                                                FROM work
                                                                                JOIN type_work on work.id_type = type_work.id
                                                                                JOIN requester on id_requester = requester.id
                                                                                JOIN account on requester.id_account = account.id
                                                                                WHERE work.id_worker is NULL AND cancelled =0 AND finish = 0 AND min_age_worker <=".$_SESSION['age']." AND work.id 
                                                                                NOT IN (SELECT id_work from refused_worker WHERE id_worker =". $_SESSION['idTypeAccount'] .")");

                                                $worksFree = $worksFreeQuery->fetchAll(PDO::FETCH_ASSOC);
                                                $worksFreeQuery->closeCursor();
                                                
                                                $worksOk=array();
                                                

                                                foreach($worksFree as $work){
                                                    $timestamp = strtotime($work['date_start']);
                                                    $numberDayWork = date('N', $timestamp);
                                                    $now = date("Ymd");
                                                    $dateStart = date("Ymd",strtotime($work['date_start']));
                                                    

                                                    foreach ($typeWorker as $type) {
                                                        if($type['id_type_work'] == $work['id_type']){
                                                            foreach($availableWorker as $day){
                                                                if(($day['id_day'] == $numberDayWork) && ($dateStart >= $now)){
                                                                  array_push($worksOk,$work);
                                                                    break; 
                                                                } 
                                                            }
                                                            break;
                                                        }
                                                        
                                                        
                                                    }
                                                    
                                                }

                                                
                                                $worksOkDistance = array();
                                                
                                                $adressWorker = $infosWorker['street'].", ".$infosWorker['postcode']." ".$infosWorker['city']." ".$infosWorker['country'];
                                                $distanceMax = (float) $infosWorker['maximum_distance'];
                                                
                                                foreach($worksOk as $work){
                                                    try{
                                                        $distance = getDistance($adressWorker,$work['place'],'K');
                                                        if($distance < $distanceMax){
                                                            array_push($worksOkDistance,$work);
                                                        }
                                                    }
                                                    catch(exception $e){
                                                        break;
                                                    }
                                                    
                                                }

                                                if(count($worksOkDistance) < 1){
                                                    echo "Aucun travail disponible selon vos critères &nbsp; &nbsp; <a href='account.php'>Modifiez les ici !</a>";
                                                }

                                                foreach($worksOkDistance as $work){
                                                    $tmstp =  strtotime($work['date_start']);
                                                    $work['date_start'] = date("d-m-Y", $tmstp);
                                                    if($work['profile_path'] == NULL){
                                                        $work['profile_path'] = 'img/user-1.jpg';  
                                                    }
                                                    

                                                    echo "<tr id='rowFree".$work['id']."'>
                                                            <td style='width:60px'>
                                                                <img src='".$work['profile_path'] ."' onerror=\"this.onerror=null; this.src='img/default-user.png'\" height='50px' width='50px' style='min-width:50px;'>
                                                            </td>

                                                            <td class='text-left'>".$work['title'] ."</td>
                                                            <td class='text-primary'>".$work['type_name'] ."</td>
                                                            <td>".$work['date_start']."</td>
                                                            <td class='td-actions text-right'>
                                                                <button type='button' rel='tooltip' title='' class='btn btn-info btn-round btn-icon btn-icon-mini btn-neutral' data-original-title='Info Work' data-toggle='collapse' data-target='#detailsProp".$work['id']."'>
                                                                    <i class='now-ui-icons travel_info'></i>
                                                                </button>
                                                                <button type='button' onclick='acceptWork(this);' rel='tooltip' title='' class='btn btn-success btn-round btn-icon btn-icon-mini btn-neutral' data-original-title='Valid Work'>
                                                                    <i class='now-ui-icons ui-1_check'></i>
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
                                    <div class="stats">
                                        <i class="now-ui-icons objects_spaceship"></i> 
                                        <span id="nombreTravaux"><?= count($worksOkDistance);?></span>
                                        <?php 
                                            if(count($worksOkDistance) == 1){
                                                echo " travail";
                                            }
                                            else{
                                                echo " travaux";
                                            }
                                        ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        

                        foreach($worksOkDistance as $work){
                            $NumberWorkQuery = $dbh->query("SELECT COUNT(id) as nbr FROM work WHERE finish=1 AND id_requester =".$work['id_requester']);

                            $NumberWork = $NumberWorkQuery->fetchAll(PDO::FETCH_ASSOC);
                            $NumberWorkQuery->closeCursor(); 
                            $NumberWork = $NumberWork[0]['nbr'];


                            $tmstp =  strtotime($work['date_start']);
                            $work['date_start'] = date("d-m-Y", $tmstp);
                            $timeStart = date("G:i", strtotime($work['time_start']));
                            $timeEnd = date("G:i", strtotime($work['time_end']));
                            if($work['profile_path'] == NULL){
                                $work['profile_path'] = 'img/user-1.jpg';  
                            }

                            $minutesWork = timeSpace($work['time_start'],$work['time_end']);
                            $price = $minutesWork * ($work['price']/60);



                            
                            echo "<div class='collapse' id='detailsProp".$work['id']."'>
                                    <div class='row'>
                                        <div class='col-md-3 d-flex'>
                                            <div class='card card-user'>
                                                <div class='card-body'>
                                                    <div class='text-center'>
                                                        <a href='#'>
                                                            <img class='avatar border-gray' src='".$work['profile_path']."' onerror=\"this.onerror=null; this.src='img/default-user.png'\" alt='...'>
                                                            <h5 class='title'>".$work['first_name']." ".$work['last_name']."</h5>
                                                        </a>
                                                        <p class='description'>
                                                        ".$work['city']."
                                                        </p>
                                                    </div>
                                                    <p class='text-center'> ".$NumberWork." travaux déjà donné</p>
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
                                                            <h5 class='card-title text-danger'>".$work['type_name']."</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='card-body'>
                                                    <div class='row text-center mt-4'>
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
                                                    
                                                </div>
                                                <div class='card-footer'>
                                                    <div class='row'>
                                                        <div class='col-md-12 px-3 pt-3'>
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

                <?php
                    $id_worker = $_SESSION['idTypeAccount'];
                    $nextWorkQuery = $dbh->query("  SELECT id_requester, title, name, description,date_start,time_start,time_end,place,price,account.city as city,account.first_name as first_name,account.last_name as last_name,account.profile_path as profile_path
                                                    FROM work 
                                                    JOIN type_work on type_work.id = work.id_type
                                                    JOIN requester on  requester.id = work.id_requester
                                                    JOIN account on account.id = requester.id_account
                                                    WHERE finish = 0 AND cancelled = 0 AND id_worker = '$id_worker' order by date_start, time_start");
                                          
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
                        $price = number_format((float)$price, 2, ',', ''); 

                        $NumberWorkQuery = $dbh->query("SELECT COUNT(id) as nbr FROM work WHERE finish=1 AND id_requester =".$nextWork['id_requester']);

                        $NumberWork = $NumberWorkQuery->fetchAll(PDO::FETCH_ASSOC);
                        $NumberWorkQuery->closeCursor(); 
                        $NumberWork = $NumberWork[0]['nbr'];

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
                                                    <h5 class='card-category'>Mon prochain travail</h5>
                                                    <div class='text-center'>
                                                        <a href='#'>
                                                            <img class='avatar border-gray' onerror=\"this.onerror=null; this.src='img/default-user.png'\" src='".$nextWork['profile_path']."' alt='...'>
                                                            <h5 class='title'>".$nextWork['first_name']." ".$nextWork['last_name']."</h5>
                                                        </a>
                                                        <p class='description'>
                                                        ".$nextWork['city']."
                                                        </p>
                                                    </div>
                                                    <p class='text-center'> ".$NumberWork." travaux déjà donné</p>
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
<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="js/dashboard.js"></script>
<script src="js/stats.js"></script>

<script src="js/main.js"></script>

<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
    });
</script>

</html>
