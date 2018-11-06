<?php
require __DIR__.'/../../Web/Bootstrap.php';

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\ChapterManagerPDO($dao);

$title = 'Les Chapitres'; 

ob_start();
if (isset($_GET['id']))
{
  $chapter = $manager->getUnique((int) $_GET['id']);
  
  echo '<p>le ', $chapter->dateCreated()->format('d/m/Y à H\hi'), '</p>', "\n",
       '<h2>', $chapter->title(), '</h2>', "\n",
       '<p>', nl2br($chapter->content()), '</p>', "\n";
  
  if ($chapter->dateCreated() != $chapter->dateModified())
  {
    echo '<p style="text-align: right;"><small><em>Modifiée le ', $chapter->dateModified()->format('d/m/Y à H\hi'), '</em></small></p>';
  }
}

else
{
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
}
?>
<?php $contentTemplate = ob_get_clean();
 
require('../../View/Frontend/showListChapters.php');
?>




