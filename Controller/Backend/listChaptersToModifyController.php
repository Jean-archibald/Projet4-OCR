<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\ChapterManagerPDO($dao);

ob_start();

?>

<p class="messageInfo">Il y a  <?= $manager->count() ?> chapitre(s) :</p>
<table>
      <tr><th>Titre</th><th>Publier</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php

foreach ($manager->getListToModify() as $chapter)
{
    echo '<tr><td>',
    $chapter->title(), '</td><td>',
    $chapter->publish(), '</td><td>',
    $chapter->dateCreated()->format('d/m/Y à H\hi'),'</td><td>',
    ($chapter->dateCreated() == $chapter->dateModified() ? '-' : $chapter->dateModified()->format('d/m/Y à H\hi')),'</td><td>
    <a href="modification-',$chapter->id(), '">Modifier</a>
    | <a href="corbeille-', $chapter->id(), '">Corbeille</a>
    </td></tr>', "\n";
}
?>
</table>


<?php 
$contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/listChaptersToModifyView.php';
?>