<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\ChapterManagerPDO($dao);

ob_start();
?>



<?php 

  
  foreach ($manager->getList(0, 1000) as $chapter)
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




