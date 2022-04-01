<?php
namespace API\Model\Entity;

use Exception;

class Users extends Entities
{   
    // primary key
    public string $id;
    public string $email;
    public string $firstname;
    public string $lastname;
    public string $password;
    public string $role;

    public function __construct()
    {                          
        
    }
    
    public function setEntity(string $email, string $firstname, string $lastname, string $password, string $role = 'use'){
        try{
            $this->id = $this->setUniqId();
            // $this->id = 'àéù$123456789àéù$';
            $this->email = $this->setEmail($email);
            $this->firstname = $this->setFirstname($firstname);
            $this->lastname = $this->setLastname($lastname);
            $this->password = $this->setPassword($password);
            $this->role = $this->setRole($role);
        }
        catch(Exception $e){
            return 'error'.$e;
        }
                
        return $this;
    }    

    public function getMessages() {        
        // $em = new Entity();
        // $response = $em->getEntitiesByClassName('Messages', 'user_id', $this->id);            
        // return $response[0] === 'success' ? $response[1] : $response[0];
    }

    public function setEmail($email) :string {
        $pattern = '/[\w+-?]+@[a-zA-Z_]{2,}?\.[a-zA-Z]{2,6}/';
        if(preg_match($pattern, $email)){
            return $this->email = $email;
        }
        else{
            return throw new Exception("email pattern error");
        }
        return $this->email = $email;
    }
    public function getEmail() :string {
        return $this->email;
    }

    public function setLastname($lastname) :string {
        $pattern = '/[a-zA-Z-\']{2,}\s?[a-zA-Z-\']*/';
        if(preg_match($pattern, $lastname)){
            return $this->lastname = $lastname;
        }
        else{
            return throw new Exception("lastname pattern error");
        }
    }

    public function getLastname() :string {
        return $this->lastname;
    }
    public function setFirstname($firstname) :string {
        $pattern = '/[a-zA-Z-\']{2,}\s?[a-zA-Z-\']*/';
        if(preg_match($pattern, $firstname)){
            return $this->firstname = $firstname;
        }
        else{
            return throw new Exception("firstname pattern error");
        }        
    }

    public function getFirstname() :string {
        return $this->firstname;
    }
    public function setPassword($password) :string {
        $pattern = '/.{8,}/';
        if(preg_match($pattern, $password)){
            $this->password = $password;
        }
        else{
            return throw new Exception("password pattern error");
        } 
        $crypted_password = password_hash($password, PASSWORD_BCRYPT);
        
        return $this->password = $crypted_password;
    }
    public function getPassword() :string {
        return $this->password;
    }
    public function setRole($role = 'use') :string {
        return $this->role = $role;
    }
    public function getRole() :string {
        return $this->role;
    }
    public function persistUser(){                
        foreach(get_class_vars(__CLASS__) as $key => $value){
            if(!isset($this->$key)){
                return 'Error, '.$key.' must be defined';
            }
            else{       
                $this->setEntityManager()->persistEntity();                
                return [
                    'id' => $this->id,
                    'firstname' => $this->firstname,
                    'lastname' => $this->lastname,
                    'email' => $this->email,
                    'role' => $this->role
                ];
            }
        }        
    }
    
}