<?php
namespace Model;


use \Entity\User;

class UserManagerPDO extends UserManager
{

     /**
     * @see UserManager:userExist()
     */
    public function userExist($nickname,$password)
    {
        $request = $this->dao->prepare('SELECT * FROM user WHERE nickname = ? AND password = ?');
        $request->execute(array($nickname, $password));
        $userExist = $request->rowCount();

        return $userExist;
    }

}