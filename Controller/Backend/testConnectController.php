<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

if(isset($_SESSION) && isset($_SESSION['nickname']) && isset($_SESSION['password']))
{
    $userExist = $userManager->userExist($_SESSION['nickname'],$_SESSION['password']);
    if($userExist == 1)
    {
        $userInfos = $userManager->getUserByNickname($_SESSION['nickname']);
        if($_SESSION['nickname'] == $userInfos['nickname'] && $_SESSION['password'] == $userInfos['password'])
        {
        require __DIR__.'/../../Controller/Backend/'. $direction .'Controller.php';
        }
    }
    else
    {   
        require __DIR__.'/../../View/Frontend/unauthorisedAccessView.php';
    }
}
else
{
    require __DIR__.'/../../View/Frontend/unauthorisedAccessView.php';
}
?>
