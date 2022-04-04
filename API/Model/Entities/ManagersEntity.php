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

    // this array is update from databse

    public function __construct()
    {                                  
    }
    
    public function setEntity(string $user_id, string $establishment_id ){
        $this->id = $this->setUniqId();
        
        $this->establishment_id = $this->SetEstablishmentId($establishment_id);               
        $this->user_id = $this->setUserId($user_id);
                
    }
    public function setUserId($user_id){
        return $this->user_id = $user_id;
    }
    public function getUserId(){
        return $this->user_id;
    }
    public function setEstablishmentId($establishment_id){
        return $this->establishment_id = $establishment_id;
    }
    public function getEstablishmentId(){
        return $this->establishment_id;
    }

    public function setEmail($email) :string {
        $this->user->setEmail($email);
        return $this->user->email;
    }
    public function getEmail() :string {
        return $this->user->email;        
    }
    public function persistManager(){
        
        var_dump($this);
        // persist admin Entity
        var_dump('persist manager');
        $this->setEntityManager()->persistEntity();
        
        var_dump('persist user');
        // update User's role
        $this->user->setEntityManager()->persistEntity();
        return $this->user;
    }

    public function updateManager(){                                       
        
        $this->setEntityManager()->updateEntity('id', $this->id, ['establishment_id']);

        $this->user->setEntityManager()->updateEntity('id', $this->user_id, ['firstname', 'lastname', 'email']);        
        
        return $this->user;
    }
    public function getManagers(){        
        $query = "SELECT users.*, establishments.name 
                    FROM Users 
                    JOIN managers 
                    ON managers.user_id = users.id 
                    LEFT JOIN establishments
                    ON managers.establishment_id = establishments.id";
        $response = $this->setEntityManager()->getWithQuery($query);        
        return $response;
    }

    public function getManager(string $user_id = null){
        if(!isset($user_id)){
            $user_id = $this->user_id;
        }
        $query = "SELECT users.*, establishments.name, establishments.id as establishment 
                    FROM Users 
                    JOIN managers 
                    ON managers.user_id = users.id 
                    LEFT JOIN establishments
                    ON managers.establishment_id = establishments.id
                    WHERE users.id=\"$user_id\"";
        $response = $this->setEntityManager()->getWithQuery($query);
        return $response;
    }
}