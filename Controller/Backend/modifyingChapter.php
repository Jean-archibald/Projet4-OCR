<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\ChapterManagerPDO($dao);

ob_start();
$chapterToModify = "";
$chapterToModify =  $manager->getUnique($id);
$title = 'Modification de ' . $chapterToModify->title() ;


if (isset($_POST['title']))
{
    $chapterToModify->setTitle($_POST['title']);
    $chapterToModify->setContent($_POST['content']);
    $chapterToModify->setPublish($_POST['publish']);
    $chapterToModify->setTrash($_POST['trash']);

    if($chapterToModify->isValid())
    {
        $manager->save($chapterToModify);

        $message = '<p style="color:green;font-size:2em;text-align:center;">Le chapitre a bien été modifié !<p/>';
    }
    else
    {
        $errors = $chapterToModify->errors();
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
        
        <p>
        <?php if (isset($errors) && in_array(\Entity\Chapter::INVALID_TITLE, $errors))
        echo '<p style="color:red;font-size:1.1em">Il manque le titre.<p/>'; ?>
        <label for="title">Titre du chapitre</label> : 
        <input type="text" name="title" id="title" value="<?php if (isset($chapterToModify)) echo $chapterToModify->title(); ?>"/>
        </p>
        <br/>
        
        <?php if (isset($errors) && in_array(\Entity\Chapter::INVALID_CONTENT, $errors))
        echo '<p style="color:red;font-size:1.1em">Il manque le contenu.<p/>';?>
        <label for="content"></label>     
        <textarea id="mytextarea" name="content" id="content" >
        <?php if (isset($chapterToModify)) echo $chapterToModify->content(); ?>
        </textarea>
        <br/>

        <p>Publier l'article ?: 
        <input type="radio" name="publish" id="publish" value="oui"/>
        <label for="oui">oui</label>
        <input type="radio" name="publish" id="publish" value="non" checked/>
        <label for="non">non</label>
        </p>

        <p>Placer dans la corbeille ?: 
        <input type="radio" name="trash" id="trash" value="oui"/>
        <label for="oui">oui</label>
        <input type="radio" name="trash" id="trash" value="non" checked/>
        <label for="non">non</label>
        </p>
        
        <input type="submit" value="Modifier" name="modifier" />
        </p>
</form>

<?php 
$contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/modifyingChapterView.php';
?>