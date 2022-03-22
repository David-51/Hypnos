<?php
namespace API\Model\Manager;

use API\Model\Entity\Entities;
use API\Model\Entity\Establishment;
use API\Model\Manager\Database;

class Entity
{    
    private bool $persisted;
    public string $response;

    public function __construct(Entities $entity = null)    
    {                       
        $this->entity = $entity;
        $this->db = Database::getConnection();
        $this->entity_name = $entity->entity_name;
                        
    }
    public function getEntity() {
        $where = key($this->entity);
        $value = reset($this->entity);        
        var_dump($where);
        var_dump($value);
        
        try{

            $sth = $this->db->prepare("SELECT id,name, adress, city, description FROM $this->entity_name");
            // $this->db->setAttribute([PDO::ATTR_STATEMENT_CLASS, PDO::ATTR_ERRMODE]);
            $sth->execute();
            $sth->setFetchMode(\PDO::FETCH_CLASS, get_class($this->entity));
            $result = $sth->fetchAll();
            // array_values($this->entity->datas)            
            // $result = $sth->fetchAll();            
            var_dump($result);
        }
        catch(\PDOException $e){
            echo $e;
        }

        // return $result;
    }

    public function updateEntity(){

    }
    public function constructor(array $array=null, string $value=null){

    }

    public function persistEntity(): string{        
        
        $this->params = implode(", ", array_keys($this->entity->datas));
        $this->values = implode(", ", array_map(function($value){
            return ':'.$value;
        }, array_keys($this->entity->datas)));                        

        try{
            $sth = $this->db->prepare(
                "INSERT INTO $this->entity_name($this->params)
                VALUES($this->values)
            ");        
            
            foreach($this->entity->datas as $key => $value){                
                $sth->bindValue(':'.$key, $value);
            }
            if($sth->execute()){
                $this->response = json_encode($this->entity->datas);
                http_response_code(201);
                // return response code + response
                return $this->response;
            };
        }
        catch(\PDOException $e){
            echo $e;
            return $this->response = json_encode(['something goes wrong with establishments']);
        }           
    }

    public function deleteEntity(){

    }

}