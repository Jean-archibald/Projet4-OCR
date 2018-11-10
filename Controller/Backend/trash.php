<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\ChapterManagerPDO($dao);

ob_start();
$chapterToDelete = "";

if ($id != 0)
{
    $chapterToDelete = $manager->getUnique($id);
    $chapterToDelete->setTrash('oui');
    $chapterToDelete->setPublish('non');
    if($chapterToDelete->isValid())
    {
        $manager->save($chapterToDelete);

        $message = 'Le chapitre a bien été mis dans la Corbeille!';
    }
    else
    {
        $errors = $chapterToModify->errors();
    }
}

$elementsInTrash = $manager->countTrash();
?>

<?php
    if (isset($message))
    {
        echo $message, '<br />';
    }
?>
        

<p style="text-align: center">Il y a  <?= $elementsInTrash ?> chapitre(s) dans la corbeille :</p>
<table>
<?php
if ( $elementsInTrash != 0)
{
    ?>
      <tr><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
    <?php

    foreach ($manager->getListInTrash() as $chapter)
    {
        echo '<tr><td>',
        $chapter->title(), '</td><td>',
        $chapter->dateCreated()->format('d/m/Y à H\hi'),'</td><td>',
        ($chapter->dateCreated() == $chapter->dateModified() ? '-' : $chapter->dateCreated()->format('d/m/Y à H\hi')),'</td><td>
        <a href="corbeille-supprimer-', $chapter->id(), '">Supprimer</a>
        | <a href="modification-', $chapter->id(), '">Récuperer</a>
        </td></tr>', "\n";
    }

}
?>
</table>

<?php 
$contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/trashView.php';
?>