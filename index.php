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
    $direction = 'adminHome';
    require __DIR__.'/Controller/Backend/testConnectController.php';
}


elseif(preg_match('#rediger#', $url , $params))
{
    $title = 'Rédiger';
    $direction = 'postChapter';
    require __DIR__.'/Controller/Backend/testConnectController.php';
}

elseif(preg_match('#modifierChapitres#', $url , $params))
{
    $title = 'Modifier';
    $direction = 'listChaptersToModify';
    require __DIR__.'/Controller/Backend/testConnectController.php';
}

elseif(preg_match('#modifierCommentaires#', $url , $params))
{
    $title = 'Modifier';
    $direction = 'listCommentsToModify';
    require __DIR__.'/Controller/Backend/testConnectController.php';
}

elseif(preg_match('#modification-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    $direction = 'modifyingChapter';
    require __DIR__.'/Controller/Backend/testConnectController.php';
}

elseif(preg_match('#corbeille-([0-9]+)#', $url , $params))
{
    $title = 'Corbeille';
    $id = $params[1];
    $direction = 'trashChapter';
    require __DIR__.'/Controller/Backend/testConnectController.php';
}

elseif(preg_match('#envoyer-commentaire-([0-9]+)#', $url , $params))
{
    $title = 'Corbeille';
    $id = $params[1];
    $direction = 'trashComment';
    require __DIR__.'/Controller/Backend/testConnectController.php';
}

elseif(preg_match('#chapitre-supprimer-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    $direction = 'deleteChapterCertificate';
    require __DIR__.'/Controller/Backend/testConnectController.php';
}

elseif(preg_match('#republier-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    $direction = 'recoverChapterCertificate';
    require __DIR__.'/Controller/Backend/testConnectController.php';
}

elseif(preg_match('#commentaire-supprimer-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    $direction = 'deleteCommentCertificate';
    require __DIR__.'/Controller/Backend/testConnectController.php';
}


elseif(preg_match('#recuperer-commentaire-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    $direction = 'recoverCommentCertificate';
    require __DIR__.'/Controller/Backend/testConnectController.php';
}

elseif(preg_match('#sessiondestroy#', $url , $params))
{
    $nickname = 'jean';
    require __DIR__.'/Controller/Backend/deconnexionController.php';
}


elseif(preg_match('#unauthorisedAcces#', $url , $params))
{

    require __DIR__.'/View/Backend/unauthorisedAccessView.php';
}


//PARTIE GESTION DES ERREURS


else
{
    $title = 'Erreur 404';
    $contentTemplate = 'ERREUR DANS L\'URL';
    require __DIR__.'/View/Frontend/404.php';
}