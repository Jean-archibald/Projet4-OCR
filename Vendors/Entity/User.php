<?php
namespace Entity;

use \MyFram\Entity;

class User extends Entity
{
    protected   $id,
                $nickname,
                $password,
                $connected;

         
    public function setNickname($nickname)
    {
            $this->nickname = $nickname;
    }

    public function setPassword($password)
    {  
          $this->password = $password;
    }

    public function setConnected($connected)
    {  
          $this->connected = $connected;
    }

    // GETTERS //
    public function nickname()
    {
        return $this->nickname;
    }

    public function password()
    {
        return $this->password;
    }

    public function connected()
    {
        return $this->connected;
    }
 
}