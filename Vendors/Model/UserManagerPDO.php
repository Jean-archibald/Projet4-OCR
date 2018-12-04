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



         /**
     * @see UserManager::connect()
     */
    public function connect($nickname)
    {
      $q = $this->dao->prepare('UPDATE user SET connected = :connected  WHERE nickname = :nickname');

      $q->bindValue(':nickname', $nickname);

      $q->bindValue(':connected', 'oui');

      $q->execute();

    }

          /**
     * @see UserManager::deconnect()
     */
    public function deconnect($nickname)
    {
      $q = $this->dao->prepare('UPDATE user SET connected = :connected  WHERE nickname = :nickname');

      $q->bindValue(':nickname', $nickname);

      $q->bindValue(':connected', 'non');

      $q->execute();

    }

    
     /**
     * @see UserManager:userExist()
     */
    public function isConnect($connected)
    {
        $request = $this->dao->prepare('SELECT * FROM user WHERE connected = \'oui\'');
        $request->execute(array($connected));
        $isConnect = $request->rowCount();

        return $isConnect;
    }



}