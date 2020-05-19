<?php
    session_start();
    session_unset();
    $_SESSION = array();
?>

<!DOCTYPE html>
<html lang="fr">

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
                                <h2 class="title">Inscription</h2>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-8 pr-3 d-flex justify-content-around">
                                    <button type="button" onclick="ShowWorkerSignUp();" class="btn btn-primary">Je suis un travailleur</button>
                                    <button type="button" onclick="ShowRequesterSignUp();" class="btn btn-outline-primary ml-3">Je suis demandeur</button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="requesterSignUp" style="display:none;">
                                    <form method="post" id="requesterForm">
                                        <h5 class="px-2"> Vos Informations</h5>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label for="lastNameSignReq">Nom</label>
                                                    <input type="text" class="form-control" placeholder="Nom" value="" name="lastName" id="lastNameSignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="firstNameSignReq">Prénom</label>
                                                    <input type="text" class="form-control" placeholder="Prénom" value="" name="firstName" id="firstNameSignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="emailSignReq">Email</label>
                                                    <input type="email" class="form-control" placeholder="Email" name="email" id="emailSignReq">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label for="usernameSignReq">Nom d'utilisateur</label>
                                                    <input type="text" class="form-control" placeholder="Nom d'utilisateur" value="" name="username" id="usernameSignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="passwordSignReq">Mot de passe</label>
                                                    <input type="password" class="form-control" placeholder="Mot de passe" value="" name="password" id="passwordSignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="passwordConfirmSignReq">Confirmation du mot de passe</label>
                                                    <input type="password" class="form-control" placeholder="Confirmation du mot de passe" value="" name="Confirmpassword" id="passwordConfirmSignReq">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label for="phoneSignReq">N° Téléphone</label>
                                                    <input type="text" class="form-control" placeholder="N° Téléphone" value="" name="phone" id="phoneSignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label for="birthdaySignReq">Date de naissance</label>
                                                    <input type="date" class="form-control" placeholder="Date de naissance" value="" name="birth" id="birthdaySignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-6 px-1">
                                                <div class="form-group">
                                                    <label for="addressSignReq">Adresse</label>
                                                    <input type="text" class="form-control" placeholder="Adresse" value="" name="address" id="addressSignReq">
                                                </div>
                                            </div>
                                            

                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 pr-1">
                                                <div class="form-group">
                                                    <label for="numberSignReq">N°</label>
                                                    <input type="text" class="form-control" placeholder="N°" value="" name="number" id="numberSignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-2 pr-1">
                                                <div class="form-group">
                                                    <label for="postalSignReq">Code postal</label>
                                                    <input type="text" class="form-control" placeholder="Code postal" value="" name="postal" id="postalSignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="citySignReq">Ville</label>
                                                    <input type="text" class="form-control" placeholder="Ville" value="" name="city" id="citySignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="countrySignReq">Pays</label>
                                                    <input type="text" class="form-control" placeholder="Pays" value="" name="country" id="countrySignReq">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 pr-3 d-flex justify-content-end">
                                                <input type="submit" class="btn btn-outline-primary ml-3" value="Inscription">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="workerSignUp" style="display:none">
                                    <form method="post" id="workerForm">
                                        <h5 class="px-2"> Vos Informations</h5>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label for="lastNameSignWork">Nom</label>
                                                    <input type="text" class="form-control" placeholder="Nom" value="" name="lastName" id="lastNameSignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="firstNameSignWork">Prénom</label>
                                                    <input type="text" class="form-control" placeholder="Prénom" value="" name="firstName" id="firstNameSignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="emailSignWork">Email</label>
                                                    <input type="email" class="form-control" placeholder="Email" name="email" id="emailSignWork">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label for="usernameSignWork">Nom d'utilisateur</label>
                                                    <input type="text" class="form-control" placeholder="Nom d'utilisateur" value="" name="username" id="usernameSignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="passwordSignWork">Mot de passe</label>
                                                    <input type="password" class="form-control" placeholder="Mot de passe" value="" name="password" id="passwordSignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label for="passwordConfirmSignWork">Confirmation du mot de passe</label>
                                                    <input type="password" class="form-control" placeholder="Confirmation du mot de passe" value="" name="Confirmpassword" id="passwordConfirmSignWork">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label for="phoneSignReq">N° Téléphone</label>
                                                    <input type="text" class="form-control" placeholder="N° Téléphone" value="" name="phone" id="phoneSignReq">
                                                </div>
                                            </div>
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label for="birthdaySignWork">Date de naissance</label>
                                                    <input type="date" class="form-control" placeholder="Date de naissance" value="" name="birth" id="birthdaySignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-6 px-1">
                                                <div class="form-group">
                                                    <label for="addressSignWork">Adresse</label>
                                                    <input type="text" class="form-control" placeholder="Adresse" value="" name="address" id="addressSignWork">
                                                </div>
                                            </div>
                                            

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label for="numberSignWork">N°</label>
                                                    <input type="text" class="form-control" placeholder="N°" value="" name="number" id="numberSignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label for="postalSignWork">Code Postal</label>
                                                    <input type="text" class="form-control" placeholder="Code postal" value="" name="postal" id="postalSignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-5 px-1">
                                                <div class="form-group">
                                                    <label for="citySignWork">Ville</label>
                                                    <input type="text" class="form-control" placeholder="Ville" value="" name="city" id="citySignWork">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label for="countrySignWork">Pays</label>
                                                    <input type="text" class="form-control" placeholder="Pays" value="" name="country" id="countrySignWork">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ml-3">
                                                    <label class="pr-3">Distance Maximum (km)</label>
                                                    <input type="number" class="form-control" name="distance" max="50" min="1" value="20">
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
                                                        border-radius: 10px;
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
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header text-center text-primary">
                                <h2 class="title">Connexion</h2>
                            </div>
                            <div class="card-body">
                                <form method="post" id="formConnect">
                                    <h5 class="px-2"> Connecte toi !</h5>
                                    <div class="row">
                                        <div class="col-md-12 pr-3">
                                            <div class="form-group">
                                                <label for="usernameLog">Nom d'utilisateur</label>
                                                <input type="text" class="form-control" placeholder="Nom d'utilisateur" value="" name="username" id="usernameLog">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 pr-3">
                                            <div class="form-group">
                                                <label for="passwordLog">Mot de passe</label>
                                                <input type="password" class="form-control" placeholder="Mot de passe" value="" name="password" id="passwordLog">
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
            <?php require_once('inc/footer.php');?>
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

