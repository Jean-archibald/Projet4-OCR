
<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$managerComment = new \Model\CommentsManagerPDO($dao);

ob_start();
$commentToDelete = "";
$commentToDelete =  $managerComment->get($id);
$commentToDeleteId = $commentToDelete->id();
$title = 'Êtes vous sûr de vouloir supprimer le commentaire ?';

if (isset($_POST['delete']) && $_POST['delete'] == 'oui')
{
    $managerComment->delete($commentToDeleteId);
    $message = '<p class="messageAvertissement">Le commentaire a bien été supprimé!<p/>';
}
elseif(isset($_POST['delete']) && $_POST['delete'] == 'non')
{
    $message = '<p class="messageValidation">Le commentaire est toujours dans la corbeille!<p/>';
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
        <p>Veuillez confirmer la suppression du commentaire : 
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