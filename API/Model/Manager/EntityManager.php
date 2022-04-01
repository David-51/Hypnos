<?php
namespace API\Model\Manager;

use API\Model\Entity\Entities;
use API\Model\Manager\Database;
use Exception;

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
     */
    public function getEntity(){           
        $entity_name = $this->entity->getEntityName();
                
        if(isset($this->entity->id)){
            $entity_id = $this->entity->id;
            $query = "SELECT * FROM $entity_name WHERE id=\"$entity_id\"";
        }
        else{
            $query = "SELECT * FROM $entity_name";            
        }
        try {
            $sth = $this->db->prepare($query);
            $sth->setFetchMode(\PDO::FETCH_CLASS, get_class($this->entity));        
            $sth->execute();
             
            $response = isset($this->entity->id) ? $sth->fetch() : $sth->fetchAll();
            return $response;
        }
        catch(\PDOException $e){
            return 'error';
        }
    }
    
    /**
     * ParentEn
     */
    public function getJoinEntity (Entities $child_entity, Entities $second_child_entity = null)       
    {            
        if(!isset($this->entity)){
            throw new Exception('You must set the parent entity in EntityManager');
            die();
        }
        // defined parent variables
        $parent_entity_name = $this->entity->getEntityName();
        $parent_entity_id = $parent_entity_name.'.id';
        
        // defined child variables
        $child_entity_name = $child_entity->getEntityName();        
        $child_entity_fkid = $child_entity_name.'.'.substr($parent_entity_name, 0, -1).'_id';
        
        // get the rows from the entity
        function createRows(Entities $child_entity){
            $rows_table = array_keys(get_class_vars(get_class($child_entity)));                
            $rows_table_format = [];
            foreach($rows_table as $key => $value){
                $rows_table_format[] = $child_entity->getEntityName().'.'.$value.' AS '.strtolower($child_entity->getEntityName().'_'.$value);
            }
            return $rows_child = implode(', ', $rows_table_format);
        }

        $rows_child = createRows($child_entity);
        
        $rows_parent = $parent_entity_name.'.*';
        
        if(isset($this->entity->id)){
            $where = $child_entity_fkid;
            $cond = $this->entity->id;
        }
        if(!isset($where)){            
            $query = "SELECT $rows_parent, $rows_child FROM $parent_entity_name 
                        LEFT JOIN $child_entity_name 
                        ON $parent_entity_id=$child_entity_fkid";
        }
        else if(isset($second_child_entity)){
            $rows_second_child = createRows($second_child_entity);
            $second_child_entity_name = $second_child_entity->getEntityName();
            $second_child_entity_fkid = $second_child_entity_name.'.'.substr($child_entity_name, 0, -1).'_id';

            $query = " SELECT $rows_parent, $rows_child, $rows_second_child 
                            FROM $parent_entity_name  
                            LEFT JOIN $child_entity_name
                            ON $parent_entity_id=$child_entity_fkid
                            LEFT JOIN $second_child_entity_name
                            ON $child_entity_name.id=$second_child_entity_fkid
                            WHERE $where=\"$cond\"";
        }

        else{            
            $query = "SELECT $rows_parent, $rows_child FROM $parent_entity_name  
                        LEFT JOIN $child_entity_name
                        ON $parent_entity_id=$child_entity_fkid
                        WHERE $where=\"$cond\"";            
        }
        $fetch_name = 'API\\Model\\Entity\\'.$parent_entity_name;
        try{
            $sth = $this->db->prepare($query);
            $sth->setFetchMode(\PDO::FETCH_CLASS, $fetch_name);
            $sth->execute();        
            $response = $sth->fetchAll();
            return $response;
        }
        catch(\PDOException $e){
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
        
        $entity = $this->entity_name;

        $rows_keys = array_keys($rows);
        $set_rows_keys = implode(', ', array_map(function($value){
            return "$value=:$value";
        },$rows_keys));        

        $query = "UPDATE $entity SET $set_rows_keys WHERE $where=\"$cond\"";
        try{
            $sth = $this->db->prepare($query);
            foreach($rows as $key => $value){
                $sth->bindValue(":$key", $value);
            }
            $sth->execute();
        }
        catch(\PDOException $e){
            return ['error', 'message : '.$e];
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

        $entity_name = $this->entity->getEntityName();

        $query = "INSERT INTO $entity_name($params) VALUES($valueToBind)";
        try{

            $sth = $this->db->prepare($query);                              

            foreach($this->entity as $key => $value){
                $sth->bindValue(':'.$key, $value);
            }            
            $sth->execute();
            
        }
        catch(\PDOException $e){                                                
            return 'error'.$e;
        }           
        http_response_code(201);                                     
        return $this->entity;
    }
    /**
     * Delete the current Entity 
     * @param string $entity the entity name to delete
     * @param string $where the condition
     * @param string $condition the "where is equal to"
     * @return array [Success, deleted] if ok whereas [error + message]
     */
    public function deleteEntity(string $entity, string $where, string $condition){              
        
        $query = "DELETE FROM $entity WHERE $where=\"$condition\"";
        try{
            $sth = $this->db->prepare($query);
            $sth->execute();
        }
        catch(\PDOException $e){
            return ['error', $e];
        }        
        return ['success' ,'deleted'];
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
            $where = substr($this->entity->getEntityName() , 0, -1).'_id';                                        
            $entity_id = $this->entity->id;        
        }

        $entity_name = $child->getEntityName();
        $query = "SELECT * FROM $entity_name WHERE $where = \"$entity_id\"";
        try{
            $sth = $this->db->prepare($query);
            $sth->execute();
    
            $sth->setFetchMode(\PDO::FETCH_CLASS, get_class($child));
            $response = $sth->fetchAll();  

            return $response;
        }                      
        catch(\PDOException $e){
            return 'error';
        }
    }
}