<?php
namespace API\Model\Entity;

/**
 * Use persistAdmin() instead of persistEntity() to persist Administrator
 * persistAdmin() set user's role to 'admin', persist administrators entity and update User Entity in one function
 */
class Administrators extends Entities
{   
    // primary key    
    public string $id;
    public string $user_id;
    private Users $user;
    
    // this array is update from databse
    public array $datas;

    public function __construct()
    {                          
        $this->setEntityName(__CLASS__);
        
    }
    
    public function setEntity(Users $user){        
        $this->id = $this->setUniqId();
        $this->user = $user;
                
        $this->user_id = $user->getPrimaryKeyValue();
        $user->setRole('adm');        

        $this->datas = [  
            'id' => '',          
            'user_id' => ''            
        ];
        
        return $this;
    }  

    public function setEmail($email) :string {
        $this->user_email = $email;
        return $this->user->setEmail($email);
    }
    public function getEmail() :string {        
        return $this->user_email;
    }
    public function persistAdmin(){
        
        // set Role admin to user
        echo 'set role <br>';
        $this->user->setRole('adm');
        
        echo 'persist Entity <br>';
        // persist admin Entity
        var_dump($this->setEntityManager()->persistEntity());
        
        echo 'update user <br>';
        // update User's role
        var_dump($this->user->setEntityManager()->updateEntity($this->user->email, ['role']));
        return $this->user;
    }
    public function updateAdmin(){
        
        // set Role admin to user
        $this->user->setRole('adm');
        
        // persist admin Entity
        var_dump($this->setEntityManager()->updateEntity());
        
        // update User's role
        var_dump($this->user->setEntityManager()->updateEntity($this->user->email, ['role']));
        return $this->user;
    }
}