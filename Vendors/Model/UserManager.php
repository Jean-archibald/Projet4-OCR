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
    * Method to get a user by his nickname
    * @return User
    */
    abstract public function getUserByNickname($nickname);

      /**
    * Method to connect the admin
    * @return void
    */
    abstract public function connect($nickname);

      /**
    * Method to deconnect the admin
    * @return void
    */
    abstract public function deconnect($nickname);

      /**
    * Method to check if admin is connect or not
    * @return bool
    */
    abstract public function isConnect($connected);


}