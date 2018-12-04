
<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$managerComment = new \Model\CommentsManagerPDO($dao);

ob_start();
$commentToUnSignal= "";
$commentToRecover =  $managerComment->get($id);
$commentToRecoverId = $commentToRecover->id();
$title = 'Êtes vous sûr de vouloir récuperer le commentaire ?';

if (isset($_POST['comment_signal']) && $_POST['comment_signal'] == 'non')
{
    $managerComment->comment_unsignal($commentToRecoverId);
    $managerComment->comment_untrash($commentToRecoverId);
    $message = '<p class="messageValidation">Le commentaire a été republié !<p/>';
}
elseif (isset($_POST['comment_signal']) && $_POST['comment_signal'] == 'oui')
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
        <p>Veuillez confirmer la récupération du commentaire : 
        <input type="radio" name="comment_signal" id="comment_signal" value="non" checked/>
        <label for="non">oui</label>
        <input type="radio" name="comment_signal" id="comment_signal" value="oui"/>
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