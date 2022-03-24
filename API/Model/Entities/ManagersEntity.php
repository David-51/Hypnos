<?php
namespace API\Model\Entity;

/**
 * Use persistAdmin() instead of persistEntity() to persist Administrator
 * persistAdmin() set user's role to 'admin', persist administrators entity and update User Entity in one function
 */
class Managers extends Entities
{   
    // primary key
    public string $id;
    public string $establishment_id;
    public string $user_id;
    private Users $user;
    
    // this array is update from databse
    public array $datas;

    public function __construct()
    {                          
        $this->setEntityName(__CLASS__);        
        $this->id = $this->setUniqId();
    }
    
    public function setEntity(Users $user, Establishments $establishment){        
        $this->user = $user;
                
        $this->user_id = $user->getPrimaryKeyValue();
        $user->setRole('man');

        $this->establishment = $establishment;

        $this->establishment_id = $establishment->getPrimaryKeyValue();

        $this->datas = [                        
            'id' => '',
            'establishment_id' => '',
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
    public function persistManager(){
        
        // set Role admin to user
        $this->user->setRole('man');
        
        // persist admin Entity
        $this->setEntityManager()->persistEntity();
        
        // update User's role
        var_dump($this->user->setEntityManager()->updateEntity($this->user->email, ['role']));
        return $this->user;
    }
    public function updateManager(){
        
        // set Role admin to user
        var_dump('set role');
        $this->user->setRole('man');
        
        var_dump('Update Manager Entity');
        // persist admin Entity
        $this->setEntityManager()->updateEntity();
        
        var_dump('Update User Role');
        // update User's role
        // var_dump($this->user->setEntityManager()->updateEntity($this->user->email, ['role']));
        return $this->user;
    }
}