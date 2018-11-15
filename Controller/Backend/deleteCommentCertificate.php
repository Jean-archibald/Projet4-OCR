
<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$managerComment = new \Model\CommentsManagerPDO($dao);

ob_start();
$commentToDelete = "";
$commentToDelete =  $managerComment->get($id);
$commentToDeleteId = $commentToDelete->id();
$title = 'Êtes vous sûr de vouloir supprimer le commentaire ?';

if (isset($_POST['trash']))
{
    $managerComment->delete($commentToDeleteId);
    $message = '<p style="color:orange;font-size:2em;text-align:center;">Le commentaire a bien été supprimé!<p/>';
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
        <input type="radio" name="trash" id="trash" value="oui"/>
        <label for="oui">oui</label>
        <input type="radio" name="trash" id="trash" value="non" checked/>
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