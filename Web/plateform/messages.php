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
    <link href="css/chat.css" rel="stylesheet" />
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
                    <div class="container mt-6 px-4">
                        <div class="row rounded-lg overflow-hidden shadow">
                            <!-- Users box-->
                            <div class="col-5 px-0">
                                <div class="bg-white">

                                    <div class="bg-gray px-4 py-2 bg-light">
                                        <p class="h5 mb-0 py-1">My Messages</p>
                                    </div>

                                    <div class="messages-box">
                                        <div class="list-group rounded-0">
                                            <a class="list-group-item list-group-item-action active text-white rounded-0">
                                                <div class="media"><img src="img/user-1.jpg" alt="user" width="50" class="rounded-circle">
                                                    <div class="media-body ml-4">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="mb-0">Thibaut Hermant</h6><small class="small font-weight-bold">25 Dec</small>
                                                        </div>
                                                        <p class="font-italic mb-0 text-small">Ok for 16h30</p>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                                    <div class="media-body ml-4">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">9 Nov</small>
                                                        </div>
                                                        <p class="font-italic text-muted mb-0 text-small">consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                                    <div class="media-body ml-4">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">18 Oct</small>
                                                        </div>
                                                        <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                                    <div class="media-body ml-4">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">17 Oct</small>
                                                        </div>
                                                        <p class="font-italic text-muted mb-0 text-small">consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                                    <div class="media-body ml-4">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">2 Sep</small>
                                                        </div>
                                                        <p class="font-italic text-muted mb-0 text-small">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                                    <div class="media-body ml-4">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">30 Aug</small>
                                                        </div>
                                                        <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0">
                                                <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                                    <div class="media-body ml-4">
                                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                                            <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">21 Aug</small>
                                                        </div>
                                                        <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Chat Box-->
                            <div class="col-7 px-0">
                                <div class="px-4 py-5 chat-box bg-white">
                                    <!-- Sender Message-->
                                    <div class="media w-50 mb-3"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                        <div class="media-body ml-3">
                                            <div class="bg-light rounded py-2 px-3 mb-2">
                                                <p class="text-small mb-0 text-muted">Test which is a new approach all solutions</p>
                                            </div>
                                            <p class="small text-muted">12:00 PM | Aug 13</p>
                                        </div>
                                    </div>

                                    <!-- Reciever Message-->
                                    <div class="media w-50 ml-auto mb-3">
                                        <div class="media-body">
                                            <div class="bg-primary rounded py-2 px-3 mb-2">
                                                <p class="text-small mb-0 text-white">Test which is a new approach to have all solutions</p>
                                            </div>
                                            <p class="small text-muted">12:00 PM | Aug 13</p>
                                        </div>
                                    </div>

                                    <!-- Sender Message-->
                                    <div class="media w-50 mb-3"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                        <div class="media-body ml-3">
                                            <div class="bg-light rounded py-2 px-3 mb-2">
                                                <p class="text-small mb-0 text-muted">Test, which is a new approach to have</p>
                                            </div>
                                            <p class="small text-muted">12:00 PM | Aug 13</p>
                                        </div>
                                    </div>

                                    <!-- Reciever Message-->
                                    <div class="media w-50 ml-auto mb-3">
                                        <div class="media-body">
                                            <div class="bg-primary rounded py-2 px-3 mb-2">
                                                <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                                            </div>
                                            <p class="small text-muted">12:00 PM | Aug 13</p>
                                        </div>
                                    </div>

                                    <!-- Sender Message-->
                                    <div class="media w-50 mb-3"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                        <div class="media-body ml-3">
                                            <div class="bg-light rounded py-2 px-3 mb-2">
                                                <p class="text-small mb-0 text-muted">Test, which is a new approach</p>
                                            </div>
                                            <p class="small text-muted">12:00 PM | Aug 13</p>
                                        </div>
                                    </div>

                                    <!-- Reciever Message-->
                                    <div class="media w-50 ml-auto mb-3">
                                        <div class="media-body">
                                            <div class="bg-primary rounded py-2 px-3 mb-2">
                                                <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                                            </div>
                                            <p class="small text-muted">12:00 PM | Aug 13</p>
                                        </div>
                                    </div>

                                </div>

                                <!-- Typing area -->
                                <form action="#" class="bg-light">
                                    <div class="input-group">
                                        <input type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
                                        <div class="input-group-append">
                                            <button id="button-addon2" type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></button>
                                        </div>
                                    </div>
                                </form>

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