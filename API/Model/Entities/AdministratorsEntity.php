<?php
namespace API\Model\Entity;

/**
 * Use persistAdmin() instead of persistEntity() to persist Administrator
 * persistAdmin() set user's role to 'admin', persist administrators entity and update User Entity in one function
 */
class Administrators extends Entities
{   
    // primary key    
    public string $id = 'undefined';
    public string $user_id;
    private Users $user;
    
    // this array is update from databse
    public array $datas;

    public function __construct()
    {                          
    
    }
    
    public function setEntity($user_id){        
        $this->id = $this->setUniqId();        
        $this->user = new Users;
        $this->user_id = $user_id;                
        $this->user->setRole('adm');        

        $this->datas = [  
            'id' => '',          
            'user_id' => ''            
        ];
        
        return $this;
    }  

    public function setEmail($email) :string {
        $this->user->setEmail($email);
        return $this->user->$email;
    }
    public function getEmail() :string {        
        return $this->user->email;
    }
    
}