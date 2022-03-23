<?php
namespace API\Model\Manager;

use API\Model\Entity\Entities;
use API\Model\Manager\Database;
use PDO;

class Entity
{    
    public array $response;
    public string $primary_key_value;


    public function __construct(Entities $entity)    
    {                       
        $this->entity = $entity;
        $this->db = Database::getConnection();
        $this->entity_name = $entity->entity_name;

        $this->primary_key = $this->entity->getPrimaryKey();
        $this->primary_key_value = $this->entity->getPrimaryKeyValue();
                
    }

    public function getPrimaryKey(){        
        return $this->entity->getPrimaryKey();
    }
    public function getPrimaryKeyValue(){
        return $this->entity->getPrimaryKeyValue();
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
     * @param Entities $child Class of child you want to fetch
     */
    public function getChilds(Entities $child) :array{                        

        $where = substr($this->entity_name, 0, -1).'_id';
                
        $key = $this->primary_key;        
        $entity_id = $this->entity->$key;        
        
        $query = "SELECT * FROM $child->entity_name WHERE $where = \"$entity_id\"";
        try{
            $sth = $this->db->prepare($query);
            $sth->execute();
    
            $sth->setFetchMode(\PDO::FETCH_CLASS, get_class($child));
            $response = $sth->fetchAll();  

            return ['success', $response];
        }                      
        catch(\PDOException $e){
            return ['error', $e];
        }

    }

    /**
     * @param string $primary_key is the primary key which can be an id or email...
     * @param array $rows the rows to update format is [$key], the value is the object value
     * 
     */
    public function updateEntity(string $primary_key_value = 'default', array $rows = []) {
        $primary_key_value = ($primary_key_value === 'default') ? $this->primary_key_value : $primary_key_value;
        if(empty($rows)){

            $rows = array_keys($this->entity->datas);

            // delete the primary_key because this cant be modify
            if($rows[0] === 'id'){
                unset($rows[0]);            
            }
        } 

        $rowsValues = [];
        foreach ($rows as $key) {
            $rowsValues[] = "$key=:$key";
        }
        $this->bindValues = implode(', ', $rowsValues);
            
        try{
            $query = "UPDATE $this->entity_name SET $this->bindValues WHERE $this->primary_key = \"$primary_key_value\"";
            $sth = $this->db->prepare($query);            

            foreach($rows as $value){                
                $val = $this->entity->$value;                
                $sth->bindValue(':'.$value, $this->entity->$value);
            }
            $sth->execute();            
        }
        catch(\PDOException $e){
            return ['error', $e];
        }
        // Update datas array because this is the mirror of BDD;
        
        foreach($rows as $value){            
            $this->entity->datas[$value] = $this->entity->$value;
        }
        return ['success', $this->entity];
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
            
            return ['success'];
        }
        catch(\PDOException $e){
            return ['error', $e];
        }
    }

}

// INSERT INTO Suites(title, link_to_booking, description, price, establishment_id) VALUES("my awesome Romm", "https://booking.com", "my lvel description", "6000", "501089b0-aaae-11ec-8e5b-10ab28c567b1");