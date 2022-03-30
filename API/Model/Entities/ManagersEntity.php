<?php
namespace API\Model\Entity;

/**
 * Use persistAdmin() instead of persistEntity() to persist Administrator
 * persistAdmin() set user's role to 'admin', persist administrators entity and update User Entity in one function
 */
class Managers extends Entities
{   
    // primary key
    public string $id= 'undefined';
    public string $establishment_id;
    public string $user_id;
    private Users $user;
    
    // this array is update from databse
    public array $datas;

    public function __construct()
    {                          
        $this->setEntityName(__CLASS__);        
    }
    
    public function setEntity(Users $user, Establishments $establishment){        
        $this->id = $this->setUniqId();
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
        $this->user->setEmail($email);
        return $this->user->email;
    }
    public function getEmail() :string {
        return $this->user->email;        
    }
    public function persistManager(){
        
        // set Role admin to user
        $this->user->setRole('man');
        
        // persist admin Entity
        $this->setEntityManager()->persistEntity();
        
        // update User's role
        $this->user->setEntityManager()->updateEntity($this->user->id, ['role']);
        return $this->user;
    }
    public function updateManager(){
                        
        $this->user->setRole('man');        
        
        $this->user->setEntityManager()->updateEntity();        
        
        return $this->user;
    }
}