<?php
namespace API\Model\Manager;

use API\Model\Entity\Entities;
use API\Model\Manager\Database;

class Entity
{    
    private bool $persisted;
    public string $response;

    public function __construct(Entities $entity)    
    {                       
        $this->entity = $entity;
        $this->db = Database::getConnection();
                        
    }

    public function prepareEntity(){

    }

    public function updateEntity(){

    }

    public function persistEntity(){        

        $this->entity_name = $this->entity->entity_name;
        $this->params = implode(", ", $this->entity->constructor);
        $this->values = implode(", ",array_map(function($value){
            return ':'.$value;
        }, $this->entity->constructor));                
        
        try{
            $sth = $this->db->prepare(
                "INSERT INTO $this->entity_name($this->params)
                VALUES($this->values)
            ");        
            
            foreach($this->entity->datas as $key => $value){                
                $sth->bindValue(':'.$key, $value);
            }
            if($sth->execute()){
                return $this->response = json_encode($this->entity->datas);
            };
        }
        catch(\PDOException $e){
            return $this->response = json_encode(['something goes wrong with establishments']);
        }           
    }

    public function deleteEntity(){

    }

    public function getEntity(){

    }

}