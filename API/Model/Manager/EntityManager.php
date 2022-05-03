<?php
namespace API\Model\Manager;

use API\Model\Entity\Entities;
use API\Model\Manager\Database;

class Entity
{    
    public Entities $entity;

    public function __construct(Entities $entity = null)    
    {                       
        if(isset($entity)){
            $this->entity = $entity;            
        }
        $this->db = Database::getConnection();                
    }

    /**
     * @return objects matching with entity from database
     * if the Id of object is set, return the single Object from database
     * @param string $search, you can insert the name of the column to get the Match Entity
     */
    public function getEntity(string $search = null){           
        $entity_name = strtolower($this->entity->getEntityName());
                        
        if(isset($this->entity->id)){
            $entity_id = $this->entity->id;
            $query = "SELECT * FROM $entity_name WHERE id=\"$entity_id\"";
        }
        elseif(isset($search)){
            $where = $search;
            $entity_id = $this->entity->$where;
            $query = "SELECT * FROM $entity_name WHERE $where=\"$entity_id\"";
        }
        else{
            $query = "SELECT * FROM $entity_name";            
        }
        try {
            $sth = $this->db->prepare($query);
            $sth->setFetchMode(\PDO::FETCH_CLASS, get_class($this->entity));        
            $sth->execute();
             
            $response = isset($this->entity->id) || isset($search) ? $sth->fetch() : $sth->fetchAll();
            return $response;
        }
        catch(\PDOException $e){
            // return 'error '.$e;
            return false;
        }
    }
    
    /**
     * @param string $query, the SQL query to execute
     * @param bool true FETCH_CLASS whereas FETCH_ASSOC
     * 
     */
    public function getWithQuery(string $query, $bool = true){        
        try{
            $sth = $this->db->prepare($query);
            if($bool === true){
                $sth->setFetchMode(\PDO::FETCH_CLASS, strtolower(get_class($this->entity)));
            }else{
                $sth->setFetchMode(\PDO::FETCH_ASSOC);
            }
            $sth->execute();        
            $response = $sth->fetchAll();
            http_response_code(200);
            return $response;
        }
        catch(\PDOException $e){
            http_response_code(403);
            return 'error'.$e;
        }
    }

    
    /**
     * To update Entity, you need to create an entity and set the id
     * 
     * @param string $entity = the name of the entity
     * @param string $where = the where clause
     * @param string $cond = the condition equal to where clause
     * @param array $rows = [key => value, ....];
     */
    public function updateEntity(string $where, string $cond, array $rows) {
                
        $entity_name = strtolower($this->entity->getEntityName());

        $rows_keys = array_keys($rows);
        $set_rows_keys = implode(', ', array_map(function($value){
            return "$value=:$value";
        },$rows_keys));        

        $query = "UPDATE $entity_name SET $set_rows_keys WHERE $where=\"$cond\"";
        try{
            $sth = $this->db->prepare($query);
            foreach($rows as $key => $value){
                $sth->bindValue(":$key", $value);
            }
            $sth->execute();
            http_response_code(201);
            return true;
        }
        catch(\PDOException $e){
            error_log('update error :'.$e, 0, '/Client/error_log.log');
            return false;
        }
    }

    /**
     * @return bool true if persist is done and false if an error occured
     * 
     */
    public function persistEntity(){        
        
        $data_keys = array_keys(get_class_vars(get_class($this->entity)));
        $params = implode(", ", $data_keys);

        $valueToBind = implode(", ", array_map(function($value){
            return ':'.$value;
        }, $data_keys));                                        

        $entity_name = strtolower($this->entity->getEntityName());

        $query = "INSERT INTO $entity_name($params) VALUES($valueToBind)";        
        try{

            $sth = $this->db->prepare($query);                                          
            foreach($this->entity as $key => $value){
                $sth->bindValue(':'.$key, $value);
            }            
            $sth->execute();
            http_response_code(201);                                     
            
        }
        catch(\PDOException $e){ 
            http_response_code(400);
            // echo json_encode($e);                                                    
            return false;
        }           
        return $this->entity;
    }
    /**
     * Delete the current Entity 
     * @param string $entity the entity name to delete
     * @param string $where the condition
     * @param string $condition the "where is equal to"
     * @return array deleted if ok whereas bool false
     */
    public function deleteEntity(string $entity, string $where, string $condition){              
        
        $query = "DELETE FROM $entity WHERE $where=\"$condition\"";
        try{
            $sth = $this->db->prepare($query);
            $sth->execute();
            return true;
        }
        catch(\PDOException $e){
            return false;
        }        
    }

    /**
     * @param Entities $child Class of child you want to fetch
     * @param bool $bool, if set to true, the childs is the parent
     */
    public function getChilds(Entities $child, bool $bool = false) :array{                     
        
        if($bool){
            $where = 'id';                            
            $the_id = strtolower(substr($child->getEntityName() , 0, -1).'_id');
            $entity_id = $this->entity->$the_id;
        }
        else{
            $where = strtolower(substr($this->entity->getEntityName() , 0, -1)).'_id';                                        
            $entity_id = $this->entity->id;        
        }

        $entity_name = strtolower($child->getEntityName());
        $query = "SELECT * FROM $entity_name WHERE $where = \"$entity_id\"";
        try{
            $sth = $this->db->prepare($query);
            $sth->execute();
    
            $sth->setFetchMode(\PDO::FETCH_CLASS, strtolower(get_class($child)));
            $response = $sth->fetchAll();              
            return $response;
        }                      
        catch(\PDOException $e){
            return false;
        }
    }
}