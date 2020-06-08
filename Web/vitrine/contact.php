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



    <title>Youngr - Contact</title>
  </head>
  <body>
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

    <title>Youngr</title>
  </head>
  <body>

    <!-- Header strat -->
    <header class="header abs-header">
      <div class="container">
        <nav class="navbar">
          <!-- Site logo -->
          <a href="index.php" class="logo">
            <img src="images/logo.png" alt="">
          </a>
          <a href="javascript:void(0);" id="mobile-menu-toggler">
            <i class="ti-align-justify"></i>
          </a>
          <ul class="navbar-nav">    
            <li><a href="index.php">Home</a></li>
            <li ><a style="color:#ff7214" href="contact.php">Contact</a></li>
            <li><a href="https://dashboard.youngr.be/dashboard.php">Dashboard</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <!-- Header strat -->



    <section class="contact" style="margin-top:150px">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="sec-heading">
              <span class="tagline">contactez nous</span>
              <h3 class="sec-title">Une question, n'hesitez pas </h3>
            </div>
            <address class="contact-info">
              <span><img src="images/icons/map-marker.png" alt="">Louvain-la-Neuve, Belgique</span>
              <a href="mailto:"><img src="images/icons/email.png" alt="">help@youngr.be</a>
            </address>
          </div>  
          <div class="col-md-8">
            <form id="formContact" method="post">
              <div class="row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                </div>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="prenom" placeholder="Prénom">
                </div>
              </div>
              <input type="email" class="form-control" name="email" placeholder="Email" required>
              <textarea class="form-control" name="message" placeholder="Votre message" required></textarea>
              <button type="submit" class="btn btn-default">Envoyer</button>
            </form>
          </div>
        </div>
      </div>
    </section>
     


    <!-- JS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


    <script>
      $(document).ready(function(){
        
        $('#formContact').on('submit',function(event){
          event.preventDefault();
          var formData = new FormData(this);

          $.ajax({
            url:'contactForm.php',
            type:'post',
            async:false,
            data:formData,
            success: function(data){
              if(data){
                document.getElementById('formContact').reset();
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Message envoyé !',
                  showConfirmButton: false,
                  timer: 1500
                })

              }
              else{
                Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: "Erreur lors de l'envoi",
                  showConfirmButton: false,
                  timer: 1500
                })
              }
            },
            processData: false,
            contentType: false,
            cache: false
          });
        });
      })

    </script>
  </body>
</html>