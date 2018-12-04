
<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\ChapterManagerPDO($dao);

ob_start();
$chapterToRecover= "";
$chapterToRecover =  $manager->getUnique($id);
$chapterToRecoverId = $chapterToRecover->id();
$title = 'Êtes vous sûr de vouloir récuperer le chapitre ?';

if (isset($_POST['chapterUntrash']) && $_POST['chapterUntrash'] == 'non')
{
    $manager->chapter_untrash($chapterToRecoverId);
    $message = '<p class="messageValidation">Le commentaire a été republié !<p/>';
}
elseif (isset($_POST['chapterUntrash']) && $_POST['chapterUntrash'] == 'oui')
{
    $message = '<p class="messageAvertissement">Le commentaire est toujours signalé !<p/>';
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
        <p>Sortir le chapitre de la corbeille ?: 
        <input type="radio" name="chapterUntrash" id="chapterUntrash" value="non" checked/>
        <label for="non">oui</label>
        <input type="radio" name="chapterUntrash" id="chapterUntrash" value="oui"/>
        <label for="oui">non</label>
        </p>
        
        <input type="submit" value="Récuperer" name="Récuperer" />
        <?php
            }
        ?>
    </p>
</form>


<?php 
$contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/deleteCertificateView.php';
?>