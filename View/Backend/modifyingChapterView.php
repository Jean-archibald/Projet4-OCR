<!DOCTYPE html>
<html lang="fr">
    <?php
    include('Web/inc/forAllPages/head.php');
    ?>
        <body id="page-top">
            
            <!-- Navigation -->
            <?php
            include('Web/incAdmin/forAllPages/menuAdmin.php');
            ?>

            <!-- Header -->
            <?php
            include('Web/inc/forAllPages/headerPages.php');
            ?>
            
            <!-- Tiny MCE -->
            <?php
            include('Web/incAdmin/writeAdminViewInc/tinyMCE.php')
            ?>

            <!-- Footer Write  -->
             <?php
            include('Web/incAdmin//writeAdminViewInc/footerWriteAdmin.php');
            ?>

            <!-- script -->
            <?php
            include('Web/inc/forAllPages/script.php');
            ?>

            <!-- script tinyMCE -->
            <?php
            include('Web/incAdmin/writeAdminViewInc/scriptPlusTinyMCEAdmin.php');
            ?>
        </body>
</html>
