<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Now UI Dashboard by Creative Tim</title>
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
                <div class="panel-header panel-header-lg">
                    <canvas id="bigDashboardChart"></canvas>
                </div>

                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-category">Add a job</h5>
                                    <h4 class="card-title">Do you need help ?</h4>
                                </div>
                                <div class="card-body">
                                    <div class="stats">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-6 pr-1">
                                                    <div class="form-group">
                                                        <label>Title (Short description)</label>
                                                        <input type="text" class="form-control" maxlength="40" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 px-1">
                                                    <label>Type</label>
                                                    <select class="form-control">
                                                        <option>Bricolage</option>
                                                        <option>Bricolage</option>
                                                        <option>Bricolage</option>
                                                        <option>Bricolage</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 px-1">
                                                    <label>Age min worker</label>
                                                    <input type="number" class="form-control" min="15" max="25">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label>Date</label>
                                                        <input type="date" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 pl-1">
                                                    <div class="form-group">
                                                        <label>Time Start</label>
                                                        <input type="time" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 pl-1">
                                                    <div class="form-group">
                                                        <label>Time End</label>
                                                        <input type="time" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label>Street</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>N°</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label>Postal Code</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 pl-1">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <select class="form-control">
                                                            <option>Belgium</option>
                                                            <option>Belgium</option>
                                                            <option>Belgium</option>
                                                            <option>Belgium</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea rows="1" maxlength="200" cols="4" class="form-control" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <div class="card card-user">
                                <div class="card-header">
                                    
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5 class="card-category">Next Worker</h5>
                                            <div class="text-center">
                                                <a href="#">
                                                    <img class="avatar border-gray" src="img/user-1.jpg" alt="...">
                                                    <h5 class="title">Thibaut Hermant</h5>
                                                </a>
                                                <p class="description">
                                                    Chimay
                                                </p>
                                            </div>
                                            <p class="text-center"> 12 works already given</p>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h5 class="card-title">Sign contract for </h5>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <h5 class="card-title text-danger">Bricolage</h5>
                                                </div>
                                            </div>
                                            <div class="row text-center mt-5">
                                                <div class="col-md-3">
                                                    <i class="now-ui-icons ui-1_calendar-60" style="font-size:20px"></i>
                                                    <p>12/05/2020<p>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="now-ui-icons tech_watch-time" style="font-size:20px"></i>
                                                    <p>13h30 - 18h00<p>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="now-ui-icons location_pin" style="font-size:20px"></i>
                                                    <p>Route du longchamps 14/302, 1348 Louvain-la-Neuve<p>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="now-ui-icons shopping_credit-card" style="font-size:20px"></i>
                                                    <p>55€<p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mt-4">
                                                    <p>Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 d-flex">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="card-title">Sign contract for </h5>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <h5 class="card-title text-danger">Bricolage</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center mt-2">
                                        <div class="col-md-3">
                                            <i class="now-ui-icons ui-1_calendar-60" style="font-size:20px"></i>
                                            <p>12/05/2020<p>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="now-ui-icons tech_watch-time" style="font-size:20px"></i>
                                            <p>13h30 - 18h00<p>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="now-ui-icons location_pin" style="font-size:20px"></i>
                                            <p>Route du longchamps 14/302, 1348 Louvain-la-Neuve<p>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="now-ui-icons shopping_credit-card" style="font-size:20px"></i>
                                            <p>55€<p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 px-3">
                                            <p>Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                <h6 class="card-category">Next Work</h6>
                                    <div class="row">
                                        <div class="col-md-8"> 
                                            <h5 class="card-title">Install a printer</h5>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <h5 class="card-title text-danger">Bricolage</h5>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="row text-center mt-2">
                                        <div class="col-md-4">
                                            <i class="now-ui-icons ui-1_calendar-60" style="font-size:20px"></i>
                                            <p>12/05/2020<p>
                                        </div>
                                        <div class="col-md-4">
                                            <i class="now-ui-icons tech_watch-time" style="font-size:20px"></i>
                                            <p>13h30 - 18h00<p>
                                        </div>
                                        <div class="col-md-4">
                                            <i class="now-ui-icons shopping_credit-card" style="font-size:20px"></i>
                                            <p>55€<p>
                                        </div>
                                    </div>
                                    <div class="row  my-4">
                                        <div class="cold-md-2 ml-4">
                                            <i class="now-ui-icons location_pin" style="font-size:20px"></i>
                                        </div>
                                        <div class="col-md-10">
                                            <p>Route du longchamps 14/302, 1348 Louvain-la-Neuve<p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 px-3">
                                            <p>Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-category">Latest work</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class=" text-primary">
                                                <th>
                                                    Name
                                                </th>
                                                <th class="text-center">
                                                    Date
                                                </th>
                                                <th class="text-right">
                                                    Salary
                                                </th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Keep my son
                                                    </td>
                                                    <td class="text-center">
                                                        24/02/2020
                                                    </td>
                                                    <td class="text-right">
                                                        25€
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Math lessons
                                                    </td>
                                                    <td class="text-center">
                                                        03/01/2020
                                                    </td>
                                                    <td class="text-right">
                                                        39€
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Walk my dog
                                                    </td>
                                                    <td class="text-center">
                                                        22/12/2019
                                                    </td>
                                                    <td class="text-right">
                                                        10€
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Assemble my wardrobe
                                                    </td>
                                                    <td class="text-center">
                                                        01/10/2019
                                                    </td>
                                                    <td class="text-right">
                                                        15€
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
    });
</script>

</html>