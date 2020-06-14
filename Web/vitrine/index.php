<?php

    function timeSpace($start,$end){
      $starttimestamp = strtotime($start);
      $endtimestamp = strtotime($end);
      $difference = abs($endtimestamp - $starttimestamp)/60;
      return $difference;
      
    }
    
   try {
        $dbh = new PDO('mysql:host=185.98.131.128;dbname=young1377588','young1377588','srvq3gjnpp');
        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (Exception $e) {
        print "Erreur !:" .$e -> getMessage()."<br/>";
        die();
    }

    $Query = $dbh->query("SELECT count(id) as nbrWorker FROM worker");
    $nbrWorker = $Query->fetch(PDO::FETCH_ASSOC);
    $Query->closeCursor();

    $Query = $dbh->query("SELECT count(id) as nbrReq FROM requester");
    $nbrReq = $Query->fetch(PDO::FETCH_ASSOC);
    $Query->closeCursor();

    $Query = $dbh->query("SELECT count(id) as nbrWork FROM work WHERE finish = 1");
    $nbrWork = $Query->fetch(PDO::FETCH_ASSOC);
    $Query->closeCursor();

    $Query = $dbh->query("SELECT time_start,time_end,price
                            FROM work 
                            WHERE finish = 1");

    $worksMoney = $Query->fetchAll(PDO::FETCH_ASSOC);
    $Query->closeCursor();

    $totalPrice=0;
    foreach($worksMoney as $work){
      $minutesWork = timeSpace($work['time_start'],$work['time_end']);
      $price = $minutesWork * ($work['price']/60);
      $price= (float)round($price,2);
      $totalPrice += $price;
    }




?>
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- All CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="images/icon.png" />

    <title>Youngr</title>
  </head>
  <body>

    <!-- Header strat -->
    <header class="header abs-header">
      <div class="container">
        <nav class="navbar">
          <!-- Site logo -->
          <a href="index.php" class="logo">
            <h2 style="color:#ff7214">Youngr</h2>
          </a>
          <a href="javascript:void(0);" id="mobile-menu-toggler">
            <i class="ti-align-justify"></i>
          </a>
          <ul class="navbar-nav">    
            <li><a  style="color:#ff7214" href="index.php">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="https://dashboard.youngr.be/dashboard.php">Dashboard</a></li>

          </ul>
        </nav>
      </div>
    </header>
    <!-- Header strat -->

    <!-- Banner section start -->
    <section class="banner">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 order-1 order-md-0">
            <div class="content-box">
              <span class="tagline">Un travail à faire ?</span>
              <h2>De l'aide pour tout vos travaux</h2>
              <p>Vous avez entre 15 et 25 ans ? <br>Effectuez des petits jobs chez des particuliers!</p>
              <p>Besoin d'aide pour un travail à domicile ?<br> Un jeune travailleur viendra vous aider !</p>
              <a href="#about" class="btn btn-default">Découvrir</a>
            </div>
          </div>
          <div class="col-md-6 order-0 order-md-1">
            <figure class="ban-img">
              <img src="images/unnamed.jpg" alt="jeunes et adulte">
            </figure>
          </div>
        </div>
      </div>
    </section>
    <!-- Banner section end -->

    <!-- About section start -->
    <section class="about" id="about">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="content-box-fluid">
              <span class="tagline">Travailleur</span>
              <h2>Vous souhaitez devenir travailleur</h2>
              <h5>Vous avez entre 15 et 25 ans et vous voulez gagner de l'argent de poche ?</h5>
              <p> Vous avez des compétences en <strong>Baby-Sitting</strong>, <strong>Travaux ménagers</strong>, <strong>Garde d'animaux</strong>, <strong>Cours particuliers</strong>,<strong>Jardinage</strong>, <strong>Bricolage</strong>, <strong>Shopping</strong>, <strong>Technologie</strong>, <strong>...</strong> ?
                <br> Inscrivez-vous en indiquant vos disponibilité et vos compténces ! Nous vous proposerons des travaux adapté !</p>
              <a href="https://dashboard.youngr.be/connexion.php" class="btn btn-default">Inscription</a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="content-box-fluid">
              <span class="tagline">Demandeur</span>
              <h2>Vous souhaitez devenir Demandeur</h2>
              <h5>Besoin d'aide pour vos travaux à domicile, garder vos enfants, aller faire vos courses, ...</h5>
              <p>Faites appel à l'un de nos jeunes travailleurs ! <br>Inscrivez-vous et ajoutez votre besoin, nous vous metterons en lien avec un de nos travailleur !</p>
              <a href="https://dashboard.youngr.be/connexion.php" class="btn btn-default">Inscription</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- About section end -->

    <!-- Funfacts section start -->
    <section class="funfacts">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="single-fun">
              <img src="images/icons/funfact/person.png" alt="">
              <p><span><?php echo $nbrWorker['nbrWorker']?></span>travailleurs</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="single-fun">
              <img src="images/icons/funfact/person2.png" alt="">
              <p><span><?php echo $nbrReq['nbrReq']?></span>demandeurs</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="single-fun">
              <img src="images/icons/funfact/agreement.png" alt="">
              <p><span><?php echo $nbrWork['nbrWork']?></span>travaux terminés</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="single-fun">
              <img src="images/icons/funfact/money.png" alt="">
              <p><span><?php echo $totalPrice?>€</span>revenu généré</p>
            </div>
          </div> 
        </div>
      </div>
    </section>
    <!-- Funfacts section end -->

    <!-- Features section start -->
    <section class="features">
      <div class="container">
        <div class="row">
          <div class="col-md-7 m-auto text-center">
            <div class="sec-heading">
              <span class="tagline">Outils</span>
              <h3 class="sec-title">Une solution complète </h3>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="iconBox">
              <span class="icon" style="background-color: #ffeee2;">
                <i class="ti-desktop"></i>
              </span>
              <a href="#">Plateforme Web</a>
              <p>Plateforme en ligne pour gérer vos travaux </p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="iconBox">
              <span class="icon" style="background-color: #ebe3ff;">
                <i class="ti-mobile"></i>
              </span>
              <a href="#">Application mobile</a>
              <p>Application Android et IOS pour avoir toutes vos informations sous la main !</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="iconBox">
              <span class="icon" style="background-color: #d5f8ff;">
                <i class="ti-comments"></i>
              </span>
              <a href="#">Messages</a>
              <p>Une messagerie pour des informations complémentaires</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="iconBox">
              <span class="icon" style="background-color: #ffedf5;">
                <i class="ti-bar-chart"></i>
              </span>
              <a href="#">Statistiques</a>
              <p>Des statistiques pour vous permettre de suivre votre évolution</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Features section end -->

  

    <!-- Footer strat -->
    <footer class="footer">
      <div class="foo-btm">
        <div class="container">
          <div class="row">
            <div class="col text-center">
              <p class="copyright"> <a href="images/conditions-generales-utilisation.pdf" target="_blank">Condition générale d'utilisation</a> <br> <a href="images/politique-confidentialite.pdf" target="_blank">Politique de confidentialité</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer end -->

    <!-- JS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>