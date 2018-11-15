<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\ChapterManagerPDO($dao);
$managerComment = new \Model\CommentsManagerPDO($dao);

ob_start();
?>

<?php
$chapter = $manager->getUnique((int) $id);
$title = $chapter->title();
$chapterId = $chapter->id();

if (isset($_POST['author']))
{
    $comment = new \Entity\Comment(
    [
        'author' => htmlspecialchars($_POST['author']),
        'content' => htmlspecialchars($_POST['content'])
    ]
    );

    $comment->setChapterId($chapterId);

    
    if($comment->isValid())
    {
        $managerComment->save($comment);

        $message = $comment->isNew() ? 'Le commentaire a bien été ajouté !' : '';
    }
    else
    {
        $errors = $comment->errors();
    }
}

if (isset($_POST['trash']))
    {
        $managerComment->delete($chapterToDeleteId);
        $message = 'Le chapitre a bien été supprimé!';
    }
?>


<?php
echo '<p>le ', $chapter->dateCreated()->format('d/m/Y à H\hi'), '</p>', "\n",
    '<h2>', $chapter->title(), '</h2>', "\n",
    '<p>', nl2br($chapter->content()), '</p>', "\n";

if ($chapter->dateCreated() != $chapter->dateModified())
{
echo '<p class="dateUnique"><small><em>Modifié le ', $chapter->dateModified()->format('d/m/Y à H\hi'), '</em></small></p>';
}
?>


<h2>Liste des commentaires : </h2>

<br/>

<?php
foreach ($managerComment->getListOf($chapterId) as $comment)
{
    if ($comment->trash() == 'non')
    {
?>

    <p><strong>Auteur : <?= htmlspecialchars($comment->author()) ?></strong><br/>
    Date : le <?= $comment->dateCreated()->format('d/m/Y à H\hi') ?><br/>
    Contenu : <?= nl2br(htmlspecialchars($comment->content())) ?><br/>
    <?php echo '<a href="signal-',$comment->id(), '">Signaler le commentaire ?</a>'?></p>
<?php
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
        ?>
        <h2>Poster un Commentaire : </h2>
        <p>
        <?php if (isset($errors) && in_array(\Entity\Comment::INVALID_AUTHOR, $errors))
        echo 'Indiquez votre nom.<br />'; ?>
        <label for="author">Votre pseudo</label> : 
        <input type="text" name="author" id="author"/>
        </p>
        <br/>
        
        <?php if (isset($errors) && in_array(\Entity\Comment::INVALID_CONTENT, $errors))
        echo 'Le contenu est invalide.<br />'; ?>
        <label for="content">Votre commentaire : </label> <br/>    
        <textarea name="content" id="content">
        </textarea>
        <br/>
        
        <input type="submit" value="Envoyer"/>
        </p>
</form>



<?php $contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Frontend/uniqueChapterView.php';
?>




