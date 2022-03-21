<?php

namespace API\Model\Entity;

class Entities
{
    public string $entity_name;
    public string $primary_key;
    public array $datas;

    public function getEntityName(){
        return $this->entity_name;
    }

    public function setEntityName($class){        
        return $this->entity_name = substr($class, strrpos($class, '\\') + 1);
    }

    public function getPrimaryKey(){
        return $this->primary_key;
    }

    public function getDatas(){
        return $this->datas;
    }

    public function setDatas(){
        foreach($this->datas as $key => $value){        
            $this->$key = $value;
        }               
    }    
    // UniqId is based on microsecond timestamp and the client's remote Ip, the last is random hexadecimal
    public function setUniqId(){
        
        function ipToHex(){
            $remote = $_SERVER['REMOTE_ADDR'];
            $explode_remote = explode('.', $remote);
            $map = array_map(function($value) {
                if($value<16){
                    return '0'.dechex(intval($value));
                }
                return dechex(intval($value));
            }, $explode_remote);
            return implode('', $map);
        }        
        $uniqid = uniqid(true);    
        return substr($uniqid, 0, 8). '-' . substr($uniqid, 8, 4) . '-' . substr($uniqid, 12, 2). bin2hex(random_bytes(1)) . '-' . bin2hex(random_bytes(2)) . '-' . bin2hex(random_bytes(2)) . ipToHex();
    }

}