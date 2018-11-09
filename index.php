<?php

require __DIR__.'/Web/Bootstrap.php';
$url = '';
if (isset($_GET['url']))
{
    $url = $_GET['url'];
}

//Pour aller sur la page d'accueil
if($url == '')
{
    require __DIR__.'/View/Frontend/homeView.php';
}

elseif(preg_match('#chapitres#', $url , $params))
{
    require __DIR__.'/Controller/Frontend/listChapters.php';
}

elseif(preg_match('#chapitre-([0-9]+)#', $url , $params))
{
    $id = $params[1];
    require __DIR__.'/Controller/Frontend/uniqueChapter.php';
}

elseif(preg_match('#apropos#', $url , $params))
{
    require __DIR__.'/View/Frontend/aboutView.php';
}

elseif(preg_match('#connexion#', $url , $params))
{
    require __DIR__.'/View/Frontend/connexionView.php';
}

elseif(preg_match('#admin#', $url , $params))
{
    require __DIR__.'/View/Backend/adminView.php';
}

else
{
    $title = 'Erreur 404';
    $contentTemplate = 'ERREUR DANS L\'URL';
    require __DIR__.'/View/Frontend/404.php';
}