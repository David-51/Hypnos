<?php
namespace API\Model\Manager;

use API\Model\Entity\Entity;

class EntityManager
{    
    private bool $persisted;

    public function __construct(Entity $entity)
    {               
        $this->entity = $entity;
        $this->db = DatabaseManager::getConnection();
        $this->datas = $this->makeEntity($entity);
        $this->entityName = $this->getEntityName();
    }

    public function makeEntity($entity){
        foreach($entity as $key=> $value){
            $this->$key = $value;
        }
    }

    public function getEntityName(){
        $entity = substr(get_class($this->entity), strrpos(get_class($this->entity), '\\') + 1);        
        $pattern = '/[A-Z][a-z]+$/';                

        return preg_replace($pattern, '', $entity);        
    }    

}