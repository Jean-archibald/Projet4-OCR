<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\ChapterManagerPDO($dao);

$title = 'Chapitre numéro ' . $id ; 

ob_start();

$chapter = $manager->getUnique((int) $id);

echo '<p>le ', $chapter->dateCreated()->format('d/m/Y à H\hi'), '</p>', "\n",
    '<h2>', $chapter->title(), '</h2>', "\n",
    '<p>', nl2br($chapter->content()), '</p>', "\n";

if ($chapter->dateCreated() != $chapter->dateModified())
{
echo '<p style="text-align: right;"><small><em>Modifiée le ', $chapter->dateModified()->format('d/m/Y à H\hi'), '</em></small></p>';
}
?>

<?php $contentTemplate = ob_get_clean();
 
require __DIR__.'/../../View/Frontend/showUniqueChapter.php';
?>




