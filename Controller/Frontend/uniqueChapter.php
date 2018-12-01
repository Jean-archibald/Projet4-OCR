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

?>

<?php
echo '<p>le ', $chapter->dateCreated()->format('d/m/Y à H\hi'), '</p>', "\n",
    '<h2 class="uniqueChapterTitle">', $chapter->title(), '</h2>', "\n",
    '<p>', nl2br($chapter->content()), '</p>', "\n";

if ($chapter->dateCreated() != $chapter->dateModified())
{
echo '<p><small><em>Modifié le ', $chapter->dateModified()->format('d/m/Y à H\hi'), '</em></small></p>';
}
?>

<br/>
<br/>

<div class="commentsStyle">
    <div>
        <h3>Liste des commentaires : </h3>
        <br/>
        <?php
        $commentsInChapter = $managerComment->countCommentChapter($chapterId);

        if($commentsInChapter == "0")
        {
            echo '<p>Il n\'existe aucun commentaire pour le moment.</p>';
        }
        foreach ($managerComment->getListOf($chapterId) as $comment)
        {
            if ($comment->trash() == 'non')
            {
            ?>
                <p><strong>Auteur : <?= htmlspecialchars($comment->author()) ?></strong><br/>
                Date : le <?= $comment->dateCreated()->format('d/m/Y à H\hi') ?><br/>
                Contenu : <?= nl2br(htmlspecialchars($comment->content())) ?><br/>
                <?php echo '<a href="signal-',$comment->id(),'">Signaler le commentaire de ' .$comment->author() .' ?</a>'?></p>
            <?php
            }
        }
            ?>
    <div>
    <br/>
    <br/>
        <form action="<?=$url?>.php" method="post">
            <p>
                <?php
                    if (isset($message))
                    {
                        echo $message, '<br />';
                    }
                ?>
                <h3>Poster un Commentaire : </h3>
                <br/>
                <table>
                    <tr>
                        <td align="right">    
                            <label for="author">Votre pseudo</label> : 
                        </td>
                        <td>
                            <input type="text" name="author" id="author"/>
                        </td>         
                    </tr>
                    <?php if (isset($errors) && in_array(\Entity\Comment::INVALID_AUTHOR, $errors))
                            echo '<p class="messageProbleme">Il manque le pseudo.<p/>'; ?>

                    <tr>
                        <td align="right">           
                            <label for="content">Votre commentaire : </label>   
                        </td>
                        <td>
                            <textarea placeholder="Souvenez vous, soyez sympa..."cols="30" rows="2" name="content" id="content" style="vertical-align:top;"></textarea>
                        </td>
                    </tr>
                    <?php if (isset($errors) && in_array(\Entity\Comment::INVALID_CONTENT, $errors))
                            echo '<p class="messageProbleme">Il manque le contenu.<p/>'; ?>

                </table>
                <br/>
                <input type="submit" value="Poster le commentaire" class="validateInput"/>
            </p>
        </form>
    </div>
</div>


<?php $contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Frontend/uniqueChapterView.php';
?>




