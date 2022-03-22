<?php
namespace API\Model\Manager;

use API\Model\Entity\Entities;
use API\Model\Manager\Database;
use PDO;

class Entity
{    
    public array $response;

    public function __construct(Entities $entity)    
    {                       
        $this->entity = $entity;
        $this->db = Database::getConnection();
        $this->entity_name = $entity->entity_name;
        $this->primary_key = key($entity);                        
    }
    /**
     * @param array $rows defined which rows to query default *, 
     * @param string $where defined the WHERE in the query statement. ! array $rows is required if $where is defined
     * @param string $cond !REQUIRED if $were param defined the condition WHERE = $cond
     */
    public function getEntity(array $rows = ['*'], string $where = null, string $cond = null):array {

        $row = implode(', ', $rows);
        
        $entity = strtolower($this->entity_name);
        if(!empty($where)){                 
            $query = "SELECT $row FROM $entity WHERE $where=\"$cond\"";                    
        }
        else{            
            $query = "SELECT $row FROM $this->entity_name ";                                    
        }
        try{                        
            $sth = $this->db->prepare($query);                     
            $sth->execute();
            $sth->setFetchMode(\PDO::FETCH_CLASS, get_class($this->entity));
            $response = $sth->fetchAll();                                                    
        }
        catch(\PDOException $e){            
            return ['error', 'Something goes wrong...'];            
        }

        return ['success', $response];
    }

    /**
     * @param string $primary_key is the primary key which can be an id or email...
     * @param array $rows the rows to update format is [$key], the value is the object value
     * 
     */
    public function updateEntity(string $primary_key_value, array $rows = []) {
        if(empty($rows)){

            $rows = array_keys($this->entity->datas);
            // delete the primary_key because this cant be modify
            unset($rows[0]);            
        } 

        $rowsValues = [];
        foreach ($rows as $key) {
            $rowsValues[] = "$key=:$key";
        }
        $this->bindValues = implode(', ', $rowsValues);
            
        try{
            $query = "UPDATE $this->entity_name SET $this->bindValues WHERE $this->primary_key = \"$primary_key_value\"";
            $sth = $this->db->prepare($query);
            var_dump($query);

            foreach($rows as $value){
                var_dump($value);
                var_dump($val = $this->entity->$value);
                echo ":$key, $val <br>";                        
                var_dump($sth->bindValue(':'.$value, $this->entity->$value));
            }
            $sth->execute();
        }
        catch(\PDOException $e){
            echo $e;
        }

    }
    /**
     * @return array 
     * if success ['succes', Entity]
     * then ['error', 'message']
     */
    public function persistEntity() :array{        
                
        $this->params = implode(", ", array_keys($this->entity->datas));        

        $this->bindValues = implode(", ", array_map(function($value){
            return ':'.$value;
        }, array_keys($this->entity->datas)));                                        

        try{
            $query = "INSERT INTO $this->entity_name($this->params)
            VALUES($this->bindValues)";                        

            $sth = $this->db->prepare($query);

            // copy the entity to array Datas
            $this->entity->setDatas();            

            foreach($this->entity->datas as $key => $value){                             
                $sth->bindValue(':'.$key, $value);
            }
            
            if($sth->execute()){
                $this->response = $this->entity->datas;                             
                return ['success', $this->entity];
            };
        }
        catch(\PDOException $e){
            // clear array data
            $this->entity->datas = [];
            echo $e;
            return ['error', 'something goes wrong with establishments'];
        }           
    }
    /**
     * Delete the current Entity 
     * @return array Success + entity if ok else if error
     */
    public function deleteEntity(){        
        $where = $this->primary_key;
        $cond = $this->entity->$where;

        $query = "DELETE FROM $this->entity_name WHERE $where=\"$cond\"";
        try{
            $sth = $this->db->prepare($query);
            
            if($sth->execute()){
                //delete datas froms $this->entity->datas
                $this->entity->datas= array_map(function(){
                    return '';
                }, $this->entity->datas);
            }

            return ['success', $this->entity];
        }
        catch(\PDOException $e){
            return ['error', $e];
        }
    }

}