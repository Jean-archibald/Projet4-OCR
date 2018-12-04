<!DOCTYPE html>
<html lang="fr">
    <?php
    include('Web/incPublic/forAllPages/head.php');
    ?>
        <body id="page-top">
            
            <!-- Navigation -->
            <?php
            include('Web/incAdmin/forAllPages/menuAdmin.php');
            ?>

            <!-- Header -->
            <?php
            include('Web/incPublic/forAllPages/headerPages.php');
            ?>

            <?= $contentTemplate ?>
            
            <!-- Footer Write  -->
             <?php
            include('Web/incAdmin//writeAdminViewInc/footerWriteAdmin.php');
            ?>

            <!-- script -->
            <?php
            include('Web/incPublic/forAllPages/script.php');
            ?>

            <!-- script tinyMCE -->
            <?php
            include('Web/incAdmin/writeAdminViewInc/scriptPlusTinyMCEAdmin.php');
            ?>
        </body>
</html>
