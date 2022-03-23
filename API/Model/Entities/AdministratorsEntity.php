<?php
namespace API\Model\Entity;

/**
 * Administrators is base on Users.
 * the best way is to create User, setEntity then persistEntity.
 * And after new Administrators(Users), setEntity and then persistEntity
 * then Update the user.
 */
class Administrators extends Entities
{   
    // primary key
    public string $user_email;
    private Users $user;
    
    // this array is update from databse
    public array $datas;

    public function __construct()
    {                          
        $this->setEntityName(__CLASS__);
        return $this;
    }
    
    public function setEntity(Users $user){        
        
        $this->user = $user;
        
        var_dump($key = $user->getPrimaryKey());
        var_dump($this->user_email = $user->$key);
        $user->setRole('adm');        

        $this->datas = [            
            'user_email' => ''            
        ];
        
        return $this;
    }  

    public function setEmail($email) :string {
        return $this->user->setEmail($email);
    }
    public function getEmail() :string {
        return $this->user->email;
    }
    public function persistAdmin(){
        echo "---- SET ROLE ---- <br>";
        $this->user->setRole('adm');
        echo "---- PERSIST ADMIN ---- <br>";
        $this->setEntityManager()->persistEntity();
        echo "---- UPDATE USER ---- <br>";
        var_dump($this->user->setEntityManager()->updateEntity($this->user->email, ['role']));
        return $this->user;
    }
}