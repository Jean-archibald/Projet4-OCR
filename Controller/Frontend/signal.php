<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$managerComment = new \Model\CommentsManagerPDO($dao);
$title = "Signaler";
ob_start();

$commentToSignal = $managerComment->get($id);
$commentToSignal->setTrash('oui');
$managerComment->save($commentToSignal);

?>
<h2>Merci, Le commentaire a été signalé.</h2>

<?php $contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Frontend/signalView.php';
?>