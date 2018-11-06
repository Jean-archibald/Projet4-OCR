<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
    <?= isset($title) ? $title : 'Accueil : Billet Pour L\'Alaska' ?>
    </title>
    <!-- Bootstrap core CSS -->
    <link href="Web/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="Web/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="Web/css/grayscale.min.css" rel="stylesheet">
  </head>

  <body id="page-top">
    <!-- Navigation -->
    <?php
    include('Web/inc/menuNav.php');
    ?>

    <!-- Header -->
    <?php
    include('Web/inc/header.php');
    ?>

    <!-- About Section -->
    <?php
    include('Web/inc/aPropos.php');
    ?>

    <!-- Projects Section -->
    <?php
    include('Web/inc/descriptionAlaska.php');
    ?>

    <!-- Signup Section -->
    <?php
    include('Web/inc/newsLetter.php');
    ?>

    <!-- Contact Section -->
    <?php
    include('Web/inc/contact.php');
    ?>

    <!-- Footer -->
    <?php
    include('Web/inc/footer.php');
    ?>

    <!-- Bootstrap core JavaScript -->
    <script src="Web/vendor/jquery/jquery.min.js"></script>
    <script src="Web/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="Web/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for this template -->
    <script src="Web/js/grayscale.min.js"></script>
  </body>
</html>
