<?php
namespace API\Model\Manager;

use API\Model\Entity\Entities;
use API\Model\Manager\Database;
use PDO;

class Entity
{    
    public array $response;
    public string $primary_key_value;
    public string $primary_key;


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
        
        $suffix = key($this->entity);

        $where = substr($this->entity_name, 0, -1).'_'. $suffix;
                
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

        $primary_key = key($this->entity);        
        if($primary_key_value === 'default'){

            // primary key for update must come from array datas because the original can change
            if($this->entity->datas[$primary_key] !== ''){
                echo 'ici';
                $primary_key_value = $this->entity->datas[$primary_key];
            }
            else{
                echo 'la';
                $primary_key_value = $this->entity->$primary_key;
            }
        }

        if(empty($rows)){
            // pb with manager
            $rows = array_keys($this->entity->datas);

            // delete the primary_key because this cant be modify
            if($rows[0] === 'id'){
                unset($rows[0]);            
            }
        } 
        // j'update avec les datas qui sont dans
        $rowsValues = [];
        foreach ($rows as $key) {
            $rowsValues[] = "$key=:$key";
        }
        $this->bindValues = implode(', ', $rowsValues);
        
        var_dump($query = "UPDATE $this->entity_name SET $this->bindValues WHERE $primary_key=\"$primary_key_value\"");
        try{
            $sth = $this->db->prepare($query);            

            foreach($rows as $value){     
                echo "---- FOREACH VALUE ----";           
                $val = $this->entity->$value;
                var_dump($val);
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
                var_dump($key);
                var_dump($value);
                $sth->bindValue(':'.$key, $value);
            }
            
            if($sth->execute()){
                // $this->response = $this->entity->datas;                          
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