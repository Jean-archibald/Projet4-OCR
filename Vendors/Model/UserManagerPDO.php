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

     /**
    * @see UserManager::confirm()
    */
    public function getUserByNickName($nickname)
    {
        $request = $this->dao->prepare('SELECT id, nickname, password
        FROM user WHERE nickname = :nickname');
        $request->bindValue(':nickname', $nickname);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');

        $user = $request->fetch();

        return $user;
    }

}