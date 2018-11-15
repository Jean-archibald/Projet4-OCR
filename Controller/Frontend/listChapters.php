<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\ChapterManagerPDO($dao);

ob_start();
$chaptersPerPage = 5;
$chapterTotals = $manager->countPublish();
$totalPages = ceil($chapterTotals/$chaptersPerPage);

if(isset($id) AND !empty($id) AND $id > 0 AND $id <= $totalPages)
{
  $id = intval($id);
  $pageNow = $id;    
}
else
{
  $pageNow = 1;
}

$started = ($pageNow-1)*$chaptersPerPage;


foreach ($manager->getListPublish($started, $chaptersPerPage) as $chapter)
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
  
  echo '<h4><a href="chapitre-', $chapter->id(), '">', $chapter->title(), '</a></h4>', "\n",
        '<p>', nl2br($content), '</p>';
}

for($i=1;$i<=$totalPages ;$i++)
{
  if($i == $pageNow)
  {
    echo $i.' ';
  }
  else
  {
  echo '<a href="http://localhost:8888/Projet4-OCR/listesChapitres-' .$i.'">'.$i.'</a> ';
  }
}

$contentTemplate = ob_get_clean();

require __DIR__.'/../../View/Frontend/listChaptersView.php';





