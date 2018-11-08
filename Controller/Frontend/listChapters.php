<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\ChapterManagerPDO($dao);

$title = 'Les Chapitres'; 

ob_start();

  echo '<h2 style="text-align:center">Liste des 5 derniers chapitres</h2>';
  
  foreach ($manager->getList(0, 5) as $chapter)
  {
    if (strlen($chapter->content()) <= 200)
    {
      $content = $chapter->content();
    }
    
    else
    {
      $start = substr($chapter->content(), 0, 200);
      $start = substr($start, 0, strrpos($start, ' ')) . '...';
      
      $content = $start;
    }
    
    echo '<h4><a href="?id=', $chapter->id(), '">', $chapter->title(), '</a></h4>', "\n",
         '<p>', nl2br($content), '</p>';
  }

?>
<?php $contentTemplate = ob_get_clean();
 
require __DIR__.'/../../View/Frontend/showListChapters.php';
?>




