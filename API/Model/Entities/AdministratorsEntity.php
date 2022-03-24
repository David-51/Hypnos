<?php
namespace API\Model\Entity;

/**
 * Use persistAdmin() instead of persistEntity() to persist Administrator
 * persistAdmin() set user's role to 'admin', persist administrators entity and update User Entity in one function
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
                
        $this->user_email = $user->getPrimaryKeyValue();
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
        
        // set Role admin to user
        $this->user->setRole('adm');
        
        // persist admin Entity
        $this->setEntityManager()->persistEntity();
        
        // update User's role
        var_dump($this->user->setEntityManager()->updateEntity($this->user->email, ['role']));
        return $this->user;
    }
}