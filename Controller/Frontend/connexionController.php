<?php

$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);


ob_start();

if(isset($_POST['nickname']))
{  
    $password = htmlspecialchars($_POST['password']);
    $nickname = htmlspecialchars($_POST['nickname']);
    $userExist = $userManager->userExist($nickname,$password);

    if(!empty($password) AND !empty($nickname))
    {
        if($userExist == 1)
        {
            $_SESSION['nickname'] = $userInfos['nickname'];
            $_SESSION['password'] = $userInfos['password'];
            header('Location: admin');
        }
        else
        {
            $message = '<p class="messageProbleme">L\'adresse mail n\'est pas répertorié ou le mot de passe est invalide !<p/>';
        }
    }
    else
    {
        $message = '<p class="messageProbleme">Tous les champs doivent être complétés !<p/>';
    }
}

?>

<form action="" method="post">
    <p>
        <?php
            if (isset($message))
            {
                echo $message, '<br />';
            }
        ?>
    </p>

    <table>
        <tr>
            <td align="right" class="tdAdmin">
                <label for="nickname">Pseudo</label> :   
            </td>
            <td class="tdAdmin">
                <input type="text" id="nickname" name="nickname" placeholder="Votre pseudo" />
            </td>
        </tr>
        
        <tr>
            <td align="right" class="tdAdmin">
                <label for="password">Mot de passe</label> :   
            </td>
            <td class="tdAdmin">
                <input id="text" name="password" id="password" placeholder="Votre mot de passe"/>
            </td>
        </tr>

    </table>
    <br/><br/>    
    <i class="fas fa-lock fa-2x mb-2 text-white"></i>
    <input type="submit" value="Se connecter" class="btn btn-primary mx-auto" />
        
</form>

<?php 
$userConnectContentTemplate = ob_get_clean();
require __DIR__.'/../../View/Frontend/connexionView.php';
?>
