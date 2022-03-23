<?php

namespace API\Model\Entity;

use API\Model\Manager\Entity;

class Entities
{
    public string $entity_name; 
    public array $datas;    

    public function __construct()
    {
        // Implement AP\Model\Manager\EntityManager to all Entity
        $this->em = new Entity($this);
    }
    public function getEntityName(){
        return $this->entity_name;
    }

    public function setEntityName($class){        
        return $this->entity_name = substr($class, strrpos($class, '\\') + 1);
    }    

    public function getDatas(){
        return $this->datas;
    }
    /**
     * ADD data to pesist in object datas
     */
    public function setDatas(){
        
        foreach($this->datas as $key => $value){
            $this->datas[$key] = $this->$key;
        }
    } 

    public function getPrimaryKey(){        
        return key($this);
    }

    public function setEntityManager(){
        $this->em = new Entity($this);
        return $this->em;
    }

    // UniqId is based on microsecond timestamp and the client's remote Ip, the last is random hexadecimal. If no Ip is detected, random Ip
    private function ipToHex(){
        $remote = $_SERVER['REMOTE_ADDR'];
        $explode_remote = explode('.', $remote);
        
        for($i = 0; $i<4 ; $i++){

            if(!isset($explode_remote[$i])){
                $explode_remote[$i] = rand(0,255);
            }
            if(intval($explode_remote[$i])<16){
                $ip[] = '0'.dechex(intval($explode_remote[$i]));
            }
            else{
                $ip[] = dechex(intval($explode_remote[$i]));
            }
        }            
        return implode('', $ip);
    }        
    public function setUniqId(){
        
        $uniqid = uniqid(true);    
        return substr($uniqid, 0, 8). '-' . substr($uniqid, 8, 4) . '-' . substr($uniqid, 12, 2). bin2hex(random_bytes(1)) . '-' . bin2hex(random_bytes(2)) . '-' . bin2hex(random_bytes(2)) . $this->ipToHex();
    }
    public function getAll() {        
        return $this;
    }

}