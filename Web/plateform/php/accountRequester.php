<?php
    require_once('inc/db_connect.php');
    
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
    <link rel="icon" href="img/icon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Mon compte - Youngr</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/now-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
    <link href="demo/demo.css" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
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
                    $infosRequesterQuery = $dbh->query("   SELECT * FROM account
                                                            JOIN requester on requester.id_account = account.id
                                                            where account.id=".$_SESSION['idAccount']);

                    $infosRequester = $infosRequesterQuery->fetch(PDO::FETCH_ASSOC);
                    $infosRequesterQuery->closeCursor();

                    if($infosRequester['profile_path'] == null){
                        $pathImg = "img/add-user.png";
                    }
                    else{
                        $pathImg = $infosRequester['profile_path'];
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
                                            <img style="max-width:80px;max-height:80px" onerror="this.onerror=null; this.src='img/add-user.png'" id="imgAvatar" onclick="document.getElementById('inputAvatar').click();" class="mx-2 my-2" src="<?= $pathImg?>" alt="add-user"/>
                                        </div>
                                        <input  id="inputAvatar" type="file" accept="image/*" name="imageAvatar" style="display:none"/>
                                    </div>
                                </form>
                                <div class="card-body">
                                    <div class="">
                                        <form method="post" id="updateAccountRequester">
                                            <h5 class="px-2"> Vos Informations</h5>
                                            <div class="row">
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label for="lastName">Nom</label>
                                                        <input type="text" class="form-control" placeholder="Nom" value="<?=$infosRequester['last_name']?>" name="lastName" id="lastName">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="firstName">Prénom</label>
                                                        <input type="text" class="form-control" placeholder="Prénom" value="<?=$infosRequester['first_name']?>" name="firstName" id="firstName">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" placeholder="Email" value="<?=$infosRequester['email']?>" name="email" id="email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label for="birthday">Date de naissance</label>
                                                        <input type="date" class="form-control" placeholder="Date de naissance" value="<?=$infosRequester['birth_date']?>" name="birth" id="birthday">
                                                    </div>
                                                </div>
                                                <div class="col-md-8 px-1">
                                                    <div class="form-group">
                                                        <label for="address">Adresse</label>
                                                        <input type="text" class="form-control" placeholder="Adresse" value="<?=$infosRequester['street']?>" name="address" id="address">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label for="postal">Code Postal</label>
                                                        <input type="text" class="form-control" placeholder="Code postal" value="<?=$infosRequester['postcode']?>" name="postal" id="postal">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="city">Ville</label>
                                                        <input type="text" class="form-control" placeholder="Ville" value="<?=$infosRequester['city']?>" name="city" id="city">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label for="country">Pays</label>
                                                        <input type="text" class="form-control" placeholder="Pays" value="<?=$infosRequester['country']?>" name="country" id="country">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-md-7 d-flex justify-content-end">
                                                    <input type="submit" class="btn btn-primary" value="Enregistrer les modifications">
                                                </div>
                                                <div class="col-md-5 d-flex justify-content-end">
                                                    <button type="button" onclick="deleteAccount();" class="btn btn-secondary">Supprimer mon compte</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="mt-4">
                                        <form method="post" class="changePassword" onsubmit="event.preventDefault();changePassword(this);">
                                            <h5 class="px-2"> Changement de votre mot de passe</h5>
                                            <div class="row">
                                                <div class="col-md-3 pr-1">
                                                    <div class="form-group">
                                                        <label for="oldPassword">Ancien mot de passe</label>
                                                        <input type="text" class="form-control" placeholder="Ancien mot de passe" value="" name="oldPassword" id="oldPassword" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 px-1">
                                                    <div class="form-group">
                                                        <label for="newPassword">Nouveau mot de passe</label>
                                                        <input type="text" class="form-control" placeholder="Nouveau mot de passe" value="" name="newPassword" id="newPassword" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 px-1">
                                                    <div class="form-group">
                                                        <label for="comfirmPassword">Comfirmation du nouveau mot de passe</label>
                                                        <input type="text" class="form-control" placeholder="Comfirmation du nouveau mot de passe" value="" name="comfirmPassword" id="comfirmPassword" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pt-3">
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-primary" value="Changer mon mot de passe">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="js/account.js"></script>
<script src="js/main.js"></script>


<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
    });
</script>

</html>