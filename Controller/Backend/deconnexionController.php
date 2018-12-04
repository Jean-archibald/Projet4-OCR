<?php
$dao = \MyFram\PDOFactory::getMySqlConnexion();
$userManager = new \Model\UserManagerPDO($dao);

$userManager->deconnect($nickname);


$_SESSION = array();
session_destroy();
header("Location:./");
