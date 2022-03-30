<?php
namespace API\Model\Entity;

class Pictures extends Entities
{   
    // primary key
    public string $id;
    public string $picture_link;
    public string $suite_id;

    // this array is update from databse    

    public function __construct()
    {                          
        
    }
    
    public function setEntity(Suites $suite, string $picture_link){
        $this->id = $this->setUniqId();
        $this->picture_link = $picture_link; 
        
        $this->suite_id = $suite->id;               
        
        return $this;
    }    

    public function setLink($link){
        return $this->picture_link = $link;
    }
    
    public function getLink(){
        return $this->picture_link;
    }
    
}