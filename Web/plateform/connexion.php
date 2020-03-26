<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Connexion - Youngr</title>
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
        <div class="main-panel" style="width:100%">

            <div class="panel-header panel-header-sm">

            </div>

            <div class="content" style="margin-top:-80px;">

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header text-center text-primary">
                                <h2 class="title">Sign Up</h2>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-8 pr-3 d-flex justify-content-around">
                                    <button type="button" onclick="ShowWorkerSignUp();" class="btn btn-primary">I am a Worker</button>
                                    <button type="button" onclick="ShowRequesterSignUp();" class="btn btn-outline-primary ml-3">I am a Requester</button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="requesterSignUp" style="display:none;">
                                    <form method="post" id="requesterForm">
                                        <h5 class="px-2"> Your Informations</h5>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label for="lastNameSignReq">Last Name</label>
                                                    <input type="text" class="form-control" placeholder="Last Name" value="" name="lastName" id="lastNameSignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="firstNameSignReq">First Name</label>
                                                    <input type="text" class="form-control" placeholder="First Name" value="" name="firstName" id="firstNameSignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="emailSignReq">Email address</label>
                                                    <input type="email" class="form-control" placeholder="Email" name="email" id="emailSignReq">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label for="usernameSignReq">Username</label>
                                                    <input type="text" class="form-control" placeholder="Username" value="" name="username" id="usernameSignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="passwordSignReq">Password</label>
                                                    <input type="password" class="form-control" placeholder="Password" value="" name="password" id="passwordSignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="passwordConfirmSignReq">Password Confirm</label>
                                                    <input type="password" class="form-control" placeholder="Password confirm" value="" name="Confirmpassword" id="passwordConfirmSignReq">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label for="birthdaySignReq">Birth date</label>
                                                    <input type="date" class="form-control" placeholder="Birth date" value="" name="birth" id="birthdaySignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-7 px-1">
                                                <div class="form-group">
                                                    <label for="addressSignReq">Address</label>
                                                    <input type="text" class="form-control" placeholder="Address" value="" name="address" id="addressSignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-2 px-1">
                                                <div class="form-group">
                                                    <label for="numberSignReq">N°</label>
                                                    <input type="text" class="form-control" placeholder="N°" value="" name="number" id="numberSignReq">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label for="postalSignReq">Postal code</label>
                                                    <input type="text" class="form-control" placeholder="Postal Code" value="" name="postal" id="postalSignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="citySignReq">City</label>
                                                    <input type="text" class="form-control" placeholder="City" value="" name="city" id="citySignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="countrySignReq">Country</label>
                                                    <input type="text" class="form-control" placeholder="Country" value="" name="country" id="countrySignReq">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 pr-3 d-flex justify-content-end">
                                                <input type="submit" class="btn btn-outline-primary ml-3" value="I am a Requester">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="workerSignUp" style="display:none">
                                    <form method="post" id="workerForm">
                                        <h5 class="px-2"> Your Informations</h5>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label for="lastNameSignWork">Last Name</label>
                                                    <input type="text" class="form-control" placeholder="Last Name" value="" name="lastName" id="lastNameSignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="firstNameSignWork">First Name</label>
                                                    <input type="text" class="form-control" placeholder="First Name" value="" name="firstName" id="firstNameSignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="emailSignWork">Email address</label>
                                                    <input type="email" class="form-control" placeholder="Email" name="email" id="emailSignWork">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label for="usernameSignWork">Username</label>
                                                    <input type="text" class="form-control" placeholder="Username" value="" name="username" id="usernameSignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="passwordSignWork">Password</label>
                                                    <input type="password" class="form-control" placeholder="Password" value="" name="password" id="passwordSignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="passwordConfirmSignWork">Password Confirm</label>
                                                    <input type="password" class="form-control" placeholder="Password confirm" value="" name="Confirmpassword" id="passwordConfirmSignWork">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label for="birthdaySignWork">Birth date</label>
                                                    <input type="date" class="form-control" placeholder="Birth date" value="" name="birth" id="birthdaySignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-7 px-1">
                                                <div class="form-group">
                                                    <label for="addressSignWork">Address</label>
                                                    <input type="text" class="form-control" placeholder="Address" value="" name="address" id="addressSignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-2 px-1">
                                                <div class="form-group">
                                                    <label for="numberSignWork">N°</label>
                                                    <input type="text" class="form-control" placeholder="N°" value="" name="number" id="numberSignWork">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label for="postalSignWork">Postal code</label>
                                                    <input type="text" class="form-control" placeholder="Postal Code" value="" name="postal" id="postalSignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="citySignWork">City</label>
                                                    <input type="text" class="form-control" placeholder="City" value="" name="city" id="citySignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="countrySignWork">Country</label>
                                                    <input type="text" class="form-control" placeholder="Country" value="" name="country" id="countrySignWork">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group ml-3">
                                                <label class="pr-3">Maximum distance (km)</label>
                                                <input type="number" class="form-control" name="distance" max="50" min="1" value="20">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <h5 class="px-2 mt-4">Your Skills</h5>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-4 text-right">
                                                <h5 class="px-2 mt-4"> Your Availabilities</h5>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-3 text-right ">
                                                <style>
                                                    .toggle.ios,
                                                    .toggle-on.ios,
                                                    .toggle-off.ios {
                                                        border-radius: 10px;
                                                    }
                                                    
                                                    .toggle.ios .toggle-handle {
                                                        border-radius: 10px;
                                                    }
                                                </style>
                                                <div class="form-group ml-3 ">
                                                    <label class="pr-3">Baby-Sitting </label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[babySitting]">
                                                </div>
                                                <div class="form-group ml-3">
                                                    <label class="pr-3">Housework </label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[housework]">
                                                </div>
                                                <div class="form-group ml-3 ">
                                                    <label class="pr-3">Gardening</label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[gardening]">
                                                </div>
                                                <div class="form-group ml-3">
                                                    <label class="pr-3">Pet-Sitting </label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[petsitting]">
                                                </div>
                                                <div class="form-group ml-3">
                                                    <label class="pr-3">Bricolage</label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[bricolage]">
                                                </div>
                                                <div class="form-group ml-3">
                                                    <label class="pr-3">Go Shopping</label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[shopping]">
                                                </div>
                                                <div class="form-group ml-1">
                                                    <label class="pr-3">Private Lessons</label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[lessons]">
                                                </div>
                                                <div class="form-group ml-3">
                                                    <label class="pr-3">Technology</label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[technology]">
                                                </div>
                                                <div class="form-group ml-5">
                                                    <label class="pr-3">Other</label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="type[other]">
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-3 text-right">

                                                <div class="form-group ml-3">
                                                    <label class="pr-3"> Monday</label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="day[monday]">
                                                </div>

                                                <div class="form-group ml-3">
                                                    <label class="pr-3"> Thuesday</label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="day[thuesday]">
                                                </div>

                                                <div class="form-group ml-3">
                                                    <label class="pr-3"> wednesday</label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="day[wednesday]">
                                                </div>

                                                <div class="form-group ml-3">
                                                    <label class="pr-3"> Thursday</label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="day[thursday]">
                                                </div>

                                                <div class="form-group ml-3">
                                                    <label class="pr-3"> Friday</label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="day[friday]">
                                                </div>

                                                <div class="form-group ml-3">
                                                    <label class="pr-3"> Saturday</label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="day[saturday]">
                                                </div>

                                                <div class="form-group ml-3">
                                                    <label class="pr-3"> Sunday</label>
                                                    <input type="checkbox" data-style="ios" data-toggle="toggle" data-onstyle="success" data-size="small" data-offstyle="danger" name="day[sunday]">
                                                </div>

                                            </div>
                                            <div class="col-md-4"></div>
                                            <div class="row ">
                                                <div class="col-md-12 d-flex justify-content-center">
                                                    <input type="submit" class="btn btn-primary" value="Sign up">
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header text-center text-primary">
                                <h2 class="title">Log In</h2>
                            </div>
                            <div class="card-body">
                                <form method="post">
                                    <h5 class="px-2"> Connect you !</h5>
                                    <div class="row">
                                        <div class="col-md-12 pr-3">
                                            <div class="form-group">
                                                <label for="usernameLog">Username</label>
                                                <input type="text" class="form-control" placeholder="username" value="" name="username" id="usernameLog">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 pr-3">
                                            <div class="form-group">
                                                <label for="passwordLog">Password</label>
                                                <input type="password" class="form-control" placeholder="password" value="" name="password" id="passwordLog">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-5">
                                            <input type="submit" class="btn btn-primary" value="Connexion">
                                        </div>
                                    </div>
                                </form>
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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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
<script src="js/connexion.js"></script>

</html>