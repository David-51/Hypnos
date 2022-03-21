<?php

namespace API\Model\Entity;

class Entities
{
    public string $entity_name;
    public string $primary_key;
    public array $datas;

    public function getEntityName(){
        return $this->entity_name;
    }

    public function setEntityName($class){        
        return $this->entity_name = substr($class, strrpos($class, '\\') + 1);
    }

    public function getPrimaryKey(){
        return $this->primary_key;
    }

    public function getDatas(){
        return $this->datas;
    }

    public function setDatas(){
        foreach($this->datas as $key => $value){        
            $this->$key = $value;
        }               
    }

}