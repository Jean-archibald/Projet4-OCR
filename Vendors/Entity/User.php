<?php
namespace Entity;

use \MyFram\Entity;

class User extends Entity
{
    protected   $id,
                $nickname,
                $password;
               
    public function setNickname($nickname)
    {
            $this->nickname = $nickname;
    }

    public function setPassword($password)
    {  
          $this->password = $password;
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
 
}