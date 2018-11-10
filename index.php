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
    $title = 'Chapitre numéro ' . $id ;
    require __DIR__.'/Controller/Frontend/uniqueChapter.php';
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

elseif(preg_match('#corbeille#', $url , $params))
{
    $title = 'Supprimer';
    require __DIR__.'/View/Backend/deleteView.php';
}


//PARTIE GESTION DES ERREURS


else
{
    $title = 'Erreur 404';
    $contentTemplate = 'ERREUR DANS L\'URL';
    require __DIR__.'/View/Frontend/404.php';
}