<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$managerComment = new \Model\CommentsManagerPDO($dao);
$title = "Signaler";
ob_start();

$commentToSignal = $managerComment->comment_signal($id);

?>
<h2 class="messageAvertissement">Merci, Le commentaire a été signalé.</h2>

<?php $contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Frontend/signalView.php';
?>