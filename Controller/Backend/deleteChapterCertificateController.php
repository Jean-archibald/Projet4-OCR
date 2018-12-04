
<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\ChapterManagerPDO($dao);
$managerComment = new \Model\CommentsManagerPDO($dao);


ob_start();
$chapterToDelete = "";
$chapterToDelete =  $manager->getUnique($id);
$chapterToDeleteId = $chapterToDelete->id();
$chapterToDeleteTitle =  $chapterToDelete->title();


$title = 'Êtes vous sûr de vouloir supprimer le chapitre ' . $chapterToDeleteTitle;

if (isset($_POST['delete']) && $_POST['delete'] == 'oui')
{
    $manager->delete($chapterToDeleteId);
    $managerComment->deleteFromChapter($chapterToDeleteId);
    $message = '<p class="messageAvertissement">Le chapitre, ainsi que ses commentaires, ont bien été supprimés!<p/>';
}
elseif(isset($_POST['delete']) && $_POST['delete'] == 'non')
{
    $message = '<p class="messageAvertissement">Le chapitre, ainsi que ses commentaires, sont toujours dans la corbeille!<p/>';
}

?>
<form action="<?=$url?>.php" method="post">
    <p>
        <?php
            if (isset($message))
            {
                echo $message, '<br />';
            }
            
            if (!isset($message))
            {
        ?>
        <p>Veuillez confirmer la suppression de  <?= $chapterToDeleteTitle ?> ? : 
        <input type="radio" name="delete" id="delete" value="oui"/>
        <label for="oui">oui</label>
        <input type="radio" name="delete" id="delete" value="non" checked/>
        <label for="non">non</label>
        </p>
        
        <input type="submit" value="Supprimer" name="Supprimer" />
        <?php
            }
        ?>
    </p>
</form>




<?php 
$contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/deleteCertificateView.php';
?>