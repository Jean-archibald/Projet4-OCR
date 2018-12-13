<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

$isConnect = $userManager->isConnect('oui');



?>
<!-- Navigation -->
<section>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="http://localhost:8888/Projet4-OCR">Jean Forteroche</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="./">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="apropos">À propos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="listesChapitres-1">Chapitres</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="contact">Contact</a>
            </li>

            <?php
            if($isConnect ==  1)
            {
            ?>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="admin">Administration</a>
            </li>
            <?php
            }
            else
            {
            ?>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="connexion">Connexion</a
            </li>
            <?php
            }
            ?>

            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#recherche"><i class="fas fa-search"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</section>