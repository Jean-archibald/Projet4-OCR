<?php
namespace Model;

use \MyFram\Manager;
use \Entity\User;

abstract class UserManager extends Manager
{
    
    /**
    * Method to tell if the mail already exist
    * @return int
    */
    abstract public function userExist($nickname,$password);

     /**
    * Method to get a user by his id
    * @return bool
    */
    abstract public function getUserByNickname($nickname);


}