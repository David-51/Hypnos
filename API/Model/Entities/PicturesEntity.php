<?php
namespace API\Model\Entity;

use API\Model\Manager\Entity;

class Pictures extends Entities
{   
    // primary key
    public string $id;
    public string $picture_link;
    public string $suite_id;
    public Suites $suite; 

    // this array is update from databse
    public array $datas;

    public function __construct()
    {                          
        $this->setEntityName(__CLASS__);        
        $this->id = $this->setUniqId();

        return $this;
    }
    
    public function setEntity(Suites $suite, string $picture_link){
        $this->picture_link = $picture_link; 
        
        $suite_id = key($suite);
        $this->suite_id = $suite->$suite_id;

        $this->datas = [
            'id' => '',
            'picture_link' => '',
            'suite_id' => ''            
        ];
        
        return $this;
    }    

    public function setLink($link){
        return $this->picture_link = $link;
    }
    
    public function getLink(){
        return $this->picture_link;
    }
    
}