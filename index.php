<?php

require __DIR__.'/Web/Bootstrap.php';
$url = '';
if (isset($_GET['url']))
{
    $url = $_GET['url'];
}

//PARTIE FRONTEND PUBLIC

if($url == '')
{
    require __DIR__.'/View/Frontend/homeView.php';
}

elseif(preg_match('#apropos#', $url , $params))
{
    $title = 'A propos';
    require __DIR__.'/View/Frontend/aboutView.php';
}

elseif(preg_match('#listesChapitres-([0-9]+)#', $url , $params))
{
    $title = 'Les chapitres';
    $id = $params[1];
    require __DIR__.'/Controller/Frontend/listChapters.php';
}

elseif(preg_match('#chapitre-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    require __DIR__.'/Controller/Frontend/uniqueChapter.php';
}

elseif(preg_match('#signal-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    require __DIR__.'/Controller/Frontend/signal.php';
}

elseif(preg_match('#contact#', $url , $params))
{
    $title = 'Contact';
    require __DIR__.'/View/Frontend/contactView.php';
}

elseif(preg_match('#connexion#', $url , $params))
{
    $title = 'Connexion';
    require __DIR__.'/Controller/Frontend/connexionController.php';
}


//PARTIE BACKEND EDITEUR


elseif(preg_match('#admin#', $url , $params))
{
    require __DIR__.'/Controller/Backend/adminHomeController.php';
}


elseif(preg_match('#rediger#', $url , $params))
{
    $title = 'Rédiger';
    require __DIR__.'/Controller/Backend/postChapterController.php';
}

elseif(preg_match('#modifier#', $url , $params))
{
    $title = 'Modifier';
    require __DIR__.'/Controller/Backend/listChaptersToModifyController.php';
}

elseif(preg_match('#modification-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    require __DIR__.'/Controller/Backend/modifyingChapterController.php';
}

elseif(preg_match('#corbeille-([0-9]+)#', $url , $params))
{
    $title = 'Corbeille';
    $id = $params[1];
    require __DIR__.'/Controller/Backend/trashController.php';
}

elseif(preg_match('#chapitre-supprimer-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    require __DIR__.'/Controller/Backend/deleteChapterCertificateController.php';
}

elseif(preg_match('#commentaire-supprimer-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    require __DIR__.'/Controller/Backend/deleteCommentCertificateController.php';
}


elseif(preg_match('#recuperer-commentaire-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    require __DIR__.'/Controller/Backend/recoverCommentCertificateController.php';
}


//PARTIE GESTION DES ERREURS


else
{
    $title = 'Erreur 404';
    $contentTemplate = 'ERREUR DANS L\'URL';
    require __DIR__.'/View/Frontend/404.php';
}