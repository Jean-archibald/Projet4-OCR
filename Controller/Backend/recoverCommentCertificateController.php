
<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$managerComment = new \Model\CommentsManagerPDO($dao);

ob_start();
$commentToRecover = "";
$commentToRecover =  $managerComment->get($id);
$commentToRecoverId = $commentToRecover->id();
$title = 'Êtes vous sûr de vouloir récuperer le commentaire ?';

if (isset($_POST['trash']))
{
    
    $commentToRecover->setTrash($_POST['trash']);

    if($commentToRecover->isValid())
    {
        $managerComment->save($commentToRecover);
        $message ='<p class="messageValidation">Le commentaire a été récupéré!<p/>';
    }
    else
    {
        $errors = $commentToRecover->errors();
    }
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
        <input type="radio" name="trash" id="trash" value="non" checked/>
        <label for="non">oui</label>
        <input type="radio" name="trash" id="trash" value="oui"/>
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