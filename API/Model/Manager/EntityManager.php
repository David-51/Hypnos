<?php
namespace API\Model\Manager;

use API\Model\Entity\Entities;
use API\Model\Manager\Database;

class Entity
{    
    public array $response;
    public string $primary_key_value;
    public string $primary_key = 'id';

    public function __construct(Entities $entity = null)    
    {                       
        if($entity){
            $this->entity = $entity;
            $this->entity_name = $entity->entity_name;                    
            $this->primary_key_value = $this->entity->id;
        }
        $this->db = Database::getConnection();                
    }
    public function getEntitiesByClassName(string $class, string $where = null, string $cond = null, array $rows = []){
        if(empty($rows)){
            $rows = "*";
        }
        else {
            $rows = implode(', ', $rows);
        }
        if(!isset($where)){
            $query = "SELECT $rows FROM $class";
        }else{
            $query = "SELECT $rows FROM $class WHERE $where=\"$cond\"";
        }                
        $fetch_name = 'API\\Model\\Entity\\'.$class;
        try{
            $sth = $this->db->prepare($query);
            $sth->setFetchMode(\PDO::FETCH_CLASS, $fetch_name);
            $sth->execute();        
            $response = $sth->fetchAll();
            return ['success', $response];
        }
        catch(\PDOException $e){
            return ['error', 'something goes wrong....'];
        }
    }
    public function getJoinEntitiesByClassName(
        string $classParent, string $class, string $where = null, string $cond = null, array $rows = []){
            if(empty($rows)){
                $rows = "*";
            }
            else {
                $rows = implode(', ', $rows);
            }
    }
    
    public function updateEntity(string $id_to_update, array $rows = []) {

    }

    /**
     * @return array 
     * if success ['succes', Entity]
     * then ['error', 'message']
     */
    public function persistEntity() :array{        
                
        $params = implode(", ", array_keys($this->entity->datas));

        $valueToBind = implode(", ", array_map(function($value){
            return ':'.$value;
        }, array_keys($this->entity->datas)));                                        

            var_dump($query = "INSERT INTO $this->entity_name($params)
            VALUES($valueToBind)");                        
        try{

            $sth = $this->db->prepare($query);

            // copy the entity to array Datas            
            
            foreach($this->entity->datas as $key => $value){                
                $sth->bindValue(':'.$key, $value);
            }
            
            if($sth->execute()){                                        
                return ['success', $this->entity];
            };
        }
        catch(\PDOException $e){                                    
            return ['error', 'something goes wrong with establishments'];
        }           
    }
    /**
     * Delete the current Entity 
     * @return array Success + entity if ok else if error
     * @param array $condition, requier 3 parameters, [string $entity, string $where, string $condition]
     */
    public function deleteEntity(array $condition = []){        
        
        if(empty($condition)){
            var_dump($where = key($this->entity));
            var_dump($condition = $this->entity->$where);
            $entity = $this->entity_name;
        }
        else{
            $entity =$condition[0];
            $where = $condition[1];
            $condition = $condition[2];
        }
        
        var_dump($query = "DELETE FROM $entity WHERE $where=\"$condition\"");
        try{
            $sth = $this->db->prepare($query);
            $sth->execute();
        }
        catch(\PDOException $e){
            return ['error', $e];
        }
       
        //delete datas froms $this->entity->datas
        $this->entity->datas= array_map(function(){
            return '';
        }, $this->entity->datas);
        
        return ['success' ,'deleted'];
        
    }

}

// INSERT INTO Suites(title, link_to_booking, description, price, establishment_id) VALUES("my awesome Romm", "https://booking.com", "my lvel description", "6000", "501089b0-aaae-11ec-8e5b-10ab28c567b1");