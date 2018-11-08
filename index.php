<?php

require __DIR__.'/Web/Bootstrap.php';

$url = '';
if (isset($_GET['url']))
{
    $url = $_GET['url'];
}

if($url == '')
{
    require __DIR__.'/View/Frontend/home.php';
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

else
{
    $title = 'Erreur 404';
    $contentTemplate = 'ERREUR DANS L\'URL';
    require __DIR__.'/View/Frontend/404.php';
}