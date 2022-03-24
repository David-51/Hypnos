<?php
namespace API\Model\Entity;

use API\Model\Manager\Entity;

class Users extends Entities
{   
    // primary key
    public string $id;
    public string $email;
    public string $firstname;
    public string $lastname;
    public string $password;
    public string $role;

    // this array is update from databse
    public array $datas;

    public function __construct()
    {                          
        $this->setEntityName(__CLASS__);
        $this->id = $this->setUniqId();

        return $this;
    }
    
    public function setEntity(string $email, string $firstname, string $lastname, string $password, string $role = 'use'){
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->password = $password;
        $this->role = $role;        

        $this->datas = [
            'id' => '',
            'email' => '',
            'firstname' => '',
            'lastname' => '',
            'password' =>'',
            'role' => ''
        ];
        
        return $this;
    }
    public function getMessages() :array{        
        $em = new Entity($this);
        return $em->getChilds(new Messages);
    }

    public function setEmail($email) :string {
        return $this->email = $email;
    }
    public function getEmail() :string {
        return $this->email;
    }

    public function setLastname($lastname) :string {
        return $this->lastname = $lastname;
    }

    public function getLastname() :string {
        return $this->lastname;
    }
    public function setFirstname($firstname) :string {
        return $this->firstname = $firstname;
    }

    public function getFirstname() :string {
        return $this->firstname;
    }
    public function setPassword($password) :string {
        return $this->password = $password;
    }
    public function getPassword() :string {
        return $this->password;
    }
    public function setRole($role) :string {
        return $this->role = $role;
    }
    public function getRole() :string {
        return $this->role;
    }
    
}