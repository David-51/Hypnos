<?php
namespace API\Model\Entity;

class Messages extends Entities
{   
    
    public string $id;    
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $subject;
    public string $message;
    public int $done = 0;
    
    public function __construct()
    {                            
        
    }
    
    public function setEntity(string $firstname, string $lastname, string $email, string $subject, string $message, int $done = 0){
        $this->id = $this->setUniqId();        
        $this->firstname = $this->setFirstname($firstname);
        $this->lastname = $this->setLastname($lastname);
        $this->email = $this->setEmail($email);
        $this->subject = $this->setSubject($subject);
        $this->message = $this->setMessage($message);
        $this->done = $this->setDone($done);

        return $this;
    }    
    public function setFirstname($firstname) :string {
        $pattern = '/[a-zA-Z-\']{2,}\s?[a-zA-Z-\']*/';
        if(preg_match($pattern, $firstname)){
            return $this->firstname = $firstname;
        }
        else{
            return throw new \Exception("firstname pattern error");
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
            return throw new \Exception("lastname pattern error");
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
            return throw new \Exception("email pattern error");
        }        
    }
    
    public function getEmail() :string {
        return $this->email;
    }

    public function setDone($done){        
        return $this->done = $done;
    }

    public function setSubject($subject){
        $pattern = '/.+/';
        if(preg_match($pattern, $subject)){
            return $this->subject = $subject;
        }
        else{
            return throw new \Exception("subject pattern error");
        }          
    }
    
    public function setMessage($message){
        $pattern = '/.+/';
        if(preg_match($pattern, $message)){
            return $this->message = $message;
        }
        else{
            return throw new \Exception("Message pattern error");
        }          
    }
    // public function persistMessage(){                
    //     foreach(get_class_vars(__CLASS__) as $key => $value){
    //         if(!isset($this->$key)){
    //             return throw new \Exception('Error, '.$key.' must be defined');
    //         }
    //         else{       
    //             $this->setEntityManager()->persistEntity();                
    //             return [
    //                 'id' => $this->id,
    //                 'firstname' => $this->firstname,
    //                 'lastname' => $this->lastname,
    //                 'email' => $this->email,
    //                 'subject' => $this->subject,
    //                 'message' => $this->message
    //             ];
    //         }
    //     }        
    // }
}