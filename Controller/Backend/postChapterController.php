<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\ChapterManagerPDO($dao);


ob_start();
$valueTitle = "";
$valueContent = "";

if(isset($_POST['title']))
{
    $valueTitle = $_POST['title'];
}

if(isset($_POST['content']))
{
    $valueContent = $_POST['content'];
}

if (isset($_POST['title']))
{
    $chapter = new \Entity\Chapter(
    [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'publish' => $_POST['publish']
    ]
    );

    if (isset($_POST['id']))
    {
        $chapter->setId($_POST['id']);
    }

    if (isset($_POST['publish']))
    {
        $chapter->setPublish($_POST['publish']);
    }

    if($chapter->isValid())
    {
        $manager->save($chapter);

        $message = '<p class="messageValidation">Le chapitre a bien été ajouté !<p/>';
    }
    else
    {
        $errors = $chapter->errors();
    }
}
?>

<form action="rediger.php" method="post">
    <p>
        <?php
            if (isset($message))
            {
                echo $message, '<br />';
            }
        ?>
        
        <p>
        <?php if (isset($errors) && in_array(\Entity\Chapter::INVALID_TITLE, $errors))
        echo '<p class="messageProbleme">Il manque le titre.<p/>'; ?>
        <label for="title">Titre du chapitre</label> : 
        <input type="text" name="title" id="title" value="<?=$valueTitle?>"/>
        </p>
        <br/>
        
        <?php if (isset($errors) && in_array(\Entity\Chapter::INVALID_CONTENT, $errors))
        echo '<p class="messageProbleme">Il manque le contenu.<p/>'; ?>
        <label for="content"></label>     
        <textarea id="mytextarea" name="content" id="content"><?=$valueContent?></textarea>
        <br/>

        <p>Publier l'article ?: 
        <input type="radio" name="publish" id="publish" value="oui"/>
        <label for="oui">oui</label>
        <input type="radio" name="publish" id="publish" value="non" checked/>
        <label for="non">non</label>
        </p>
        
        <input type="submit" value="Enregistrer"/>
        </p>
</form>

<?php 
$contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/writeView.php';
?>