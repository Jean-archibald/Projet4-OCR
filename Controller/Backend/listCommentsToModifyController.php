<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\CommentsManagerPDO($dao);

ob_start();

$signalComment = $manager->countSignalAndUntrash();
$totalComments = $manager->count();

?>

<p class="messageInfo">Il y a  <?= $signalComment ?> commentaires(s) signalé(s) :</p>
<br/>
<?php
if ( $signalComment != 0)
{
?>
<table>
      <tr><th>Chapitres</th><th>Auteur</th><th>Contenu</th><th style="background-color:red;">Signalé</th><th>Date de création</th><th>Action</th></tr>
<?php

foreach ($manager->getListSignal() as $comment)
{
    echo '<tr><td>',
    $comment->chapterId(), '</td><td >',
    $comment->author(), '</td><td>',
    $comment->content(), '</td><td style="background-color:red;">',
    $comment->comment_signal(), '</td><td>',
    $comment->dateCreated()->format('d/m/Y à H\hi'),'</td><td>
    <a href="envoyer-commentaire-', $comment->id(), '">Corbeille</a>
    | <a href="recuperer-commentaire-', $comment->id(), '">Récuperer</a>
    </td></tr>', "\n";
}
?>
</table>
<br/>

<?php
}

?>

<p class="messageInfo">Il y a  <?= $totalComments ?> commentaires(s) au total :</p>
<br/>

<?php
if ( $totalComments != 0)
{
?>
<table>
      <tr><th>Chapitres</th><th>Auteur</th><th>Contenu</th><th>Date de création</th><th>Action</th></tr>
<?php

foreach ($manager->getListComments() as $comment)
{
    echo '<tr><td>',
    $comment->chapterId(), '</td><td>',
    $comment->author(), '</td><td>',
    $comment->content(), '</td><td>',
    $comment->dateCreated()->format('d/m/Y à H\hi'),'</td><td>
    <a href="envoyer-commentaire-', $comment->id(), '">Corbeille</a>
    </td></tr>', "\n";
}
?>
</table>

<?php
}
?>


<?php 
$contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/listCommentsToModifyView.php';
?>