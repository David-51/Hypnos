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
        echo '<h2>key this</h2>';
        var_dump(key($this));    
        return key($this);
    }

    public function getPrimaryKeyValue(){
        $key = $this->getPrimaryKey();
        return $this->$key;
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
    private function base64($id){
        $base64 = '0123456789abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ#&@$';

        $bin = [];
        for($i = 0; $i < strlen($id) ; $i++){            
            $bin[] = base_convert($id[$i], 16,2);
        }        
        // the convert string dont add the first 0 at the start of numbre, we need to add these.
        $fourdigit = array_map(function($value){            
            $zero ='';
            $addzero = 4-strlen($value);
            for($i = 0; $i < $addzero ; $i++){
                $zero .= '0'; 
            }            
            return $zero.$value;
        },$bin);
        
        // creatina new array bin
        $inarray = implode("", $fourdigit);        

        // we have to reverse the order of the line and reverse the array to keep the order
        $inarray_reverse = strrev($inarray);
        $split_inarray_revers = str_split($inarray_reverse, 6);

        // reverse the order, so our array start with the last 6 digits 
        $inarray = array_map(function($value){
            return strrev($value);
        }, $split_inarray_revers);
        
        $result = '';
        // convert in base 64 the binary
        foreach($inarray as $value){
            $result .= $base64[bindec($value)];
        }
        return $result;
    }
    /**
     * first digit are base on the current timestamp in micro second, and the last digit are the request IP.
     * all is converted on base 64 code
     */
    public function setUniqId(){
        
        $uniqid = uniqid(true);    
        // return substr($uniqid, 0, 8). '-' . substr($uniqid, 8, 4) . '-' . substr($uniqid, 12, 2). bin2hex(random_bytes(1)) . '-' . bin2hex(random_bytes(2)) . '-' . bin2hex(random_bytes(2)) . $this->ipToHex();
        $hex = substr($uniqid, 0, 8).substr($uniqid, 8, 4) . substr($uniqid, 12, 2). bin2hex(random_bytes(1)) . bin2hex(random_bytes(2)) .  bin2hex(random_bytes(2)) . $this->ipToHex();
        return $this->base64($hex);
    }
    public function getAll() {        
        return $this;
    }
}