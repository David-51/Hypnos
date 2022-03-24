<?php
namespace API\Model\Entity;

/**
 * The messages are owned by users
 */
class Messages extends Entities
{   
    // primary key
    public string $id;    
    public string $user_id;
    public string $message;

    // after sent a response, message is done = 1
    public int $done = 0;

    // this array is update from databse
    public array $datas;

    public function __construct()
    {                          
        $this->setEntityName(__CLASS__);        
        $this->id = $this->setUniqId();        
        
    }
    
    public function setEntity(Users $user, $message){
        $this->message = $message;        
        $this->user_id = $user->getPrimaryKeyValue();

        $this->datas = [
            'id' => '',
            'user_id' => '',
            'message' => '',
            'done' => 0
        ];
        
        return $this;
    }    

    public function setMessage($message){
        return $this->message = $message;
    }
    
    public function getMessage(){
        return $this->message;
    }

    public function messageClose(){
        return $this->done = 1;
    }
    public function messageOpen(){
        return $this->done = 0;
    }
    
}