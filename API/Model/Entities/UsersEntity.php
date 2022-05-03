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
    
    public function setEntity(string $email, string $firstname, string $lastname, string $password, string $role = 'use'){        
            $this->id = $this->setUniqId();            
            $this->email = $this->setEmail($email);
            $this->firstname = $this->setFirstname($firstname);
            $this->lastname = $this->setLastname($lastname);
            $this->password = $this->setPassword($password);
            $this->role = $this->setRole($role);        
                
        return $this;
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
    public function setEmail($email) :string {
        $pattern = '/[A-Za-z0-9-?]+@[a-zA-Z_0-9]{2,}?\.[a-zA-Z]{2,6}/';
        if(preg_match($pattern, $email)){
            return $this->email = $email;
        }
        else{
            return throw new Exception("email pattern error");
        }        
    }

    public function getEmail() :string {
        return $this->email;
    }

    public function setPassword($password) :string {
        $pattern0 = '/.{8,}/';
        $pattern1 = '/[^A-z]{1,}/';
        $pattern2 = '/[a-z]{1,}/';
        $pattern3 = '/[A-Z]{1,}/';
        $pattern4 = '/[0-9]{1,}/';

        $result0 = preg_match($pattern0, $password);
        $result1 = preg_match($pattern1, $password);
        $result2 = preg_match($pattern2, $password);
        $result3 = preg_match($pattern3, $password);
        $result4 = preg_match($pattern4, $password);

        $result = $result0 && $result1 && $result2 && $result3 && $result4;
        if($result){
            $crypted_password = password_hash($password, PASSWORD_BCRYPT);
            
            return $this->password = $crypted_password;            
        }
        else{
            return throw new Exception("password pattern error");
        } 
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
                return throw new \Exception('Error, '.$key.' must be defined');                
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
    public function GetUserByEmail(){
        return $this->setEntityManager()->getEntity('email');
    }

    public function getBookingsList(){
         
        $query = "SELECT users.id as user_id, bookings.id as booking_id, 
            establishments.name, suites.title, bookings.date_checkin, bookings.date_checkout 
        FROM bookings 
        JOIN users
        ON users.id = bookings.user_id
        JOIN suites
        ON bookings.suite_id=suites.id
        JOIN establishments
        ON suites.establishment_id=establishments.id
        WHERE users.id=\"$this->id\"";

        return $this->setEntityManager()->getWithQuery($query);
        
    }
    
}