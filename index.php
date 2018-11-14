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

elseif(preg_match('#chapitres#', $url , $params))
{
    $title = 'Les chapitres';
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
    require __DIR__.'/View/Frontend/connexionView.php';
}

elseif(preg_match('#admin#', $url , $params))
{
    require __DIR__.'/View/Backend/adminHomeView.php';
}



//PARTIE BACKEND EDITEUR


elseif(preg_match('#rediger#', $url , $params))
{
    $title = 'Rédiger';
    require __DIR__.'/Controller/Backend/postChapter.php';
}

elseif(preg_match('#modifier#', $url , $params))
{
    $title = 'Modifier';
    require __DIR__.'/Controller/Backend/listChaptersToModify.php';
}

elseif(preg_match('#modification-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    require __DIR__.'/Controller/Backend/modifyingChapter.php';
}

elseif(preg_match('#corbeille-([0-9]+)#', $url , $params))
{
    $title = 'Corbeille';
    $id = $params[1];
    require __DIR__.'/Controller/Backend/trash.php';
}

elseif(preg_match('#chapitre-supprimer-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    require __DIR__.'/Controller/Backend/deleteChapterCertificate.php';
}

elseif(preg_match('#commentaire-supprimer-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    require __DIR__.'/Controller/Backend/deleteCommentCertificate.php';
}


elseif(preg_match('#recuperer-commentaire-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    require __DIR__.'/Controller/Backend/recoverCommentCertificate.php';
}


//PARTIE GESTION DES ERREURS


else
{
    $title = 'Erreur 404';
    $contentTemplate = 'ERREUR DANS L\'URL';
    require __DIR__.'/View/Frontend/404.php';
}