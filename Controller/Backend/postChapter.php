<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$manager = new \Model\ChapterManagerPDO($dao);

ob_start();
if (isset($_POST['title']))
{
    $chapter = new \Entity\Chapter(
    [
        'title' => $_POST['title'],
        'content' => $_POST['content']
    ]
    );

    if (isset($_POST['id']))
    {
        $chapter->setId($_POST['id']);
    }

    if($chapter->isValid())
    {
        $manager->add($chapter);

        $message = $chapter->isNew() ? 'Le chapitre a bien été ajouté !' : 'Le chapitre a bien été modifié !';
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
        
        <?php if (isset($errors) && in_array(\Entity\Chapter::INVALID_TITLE, $errors))
        echo 'Le titre est invalide.<br />'; ?>
        <label for="title">Titre du chapitre</label> : 
        <input type="text" name="title" id="title"/></p>
        <br/>

        <?php if (isset($errors) && in_array(\Entity\Chapter::INVALID_CONTENT, $errors))
        echo 'Le contenu est invalide.<br />'; ?>
        <label for="content">Contenu du chapitre</label> :    
        <textarea id="mytextarea" name="content" id="content">
        </textarea>
        <br/>

        <input type="submit" value="Enregistrer"/>
    </p>
</form>

<?php 
$contentTemplate = ob_get_clean();
require __DIR__.'/../../View/Backend/writeView.php';
?>