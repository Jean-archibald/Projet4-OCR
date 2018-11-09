<!DOCTYPE html>
<html lang="fr">
    <?php
    include('Web/inc/head.php');
    ?>

  <body id="page-top">
    <!-- Navigation -->
    <?php
    include('Web/inc/menuNav.php');
    ?>

    
    <?= $contentTemplate ?>

    <!-- Contact Section -->
    <?php
    include('Web/inc/contact.php');
    ?>

    <!-- Footer -->
    <?php
    include('Web/inc/footer.php');
    ?>

    <!-- script -->
    <?php
    include('Web/inc/script.php');
    ?>
  </body>
</html>
