<?php

namespace API\Model\Entity;

use API\Model\Manager\Entity;

class Entities
{    
    public function __construct()
    {
        // Implement AP\Model\Manager\EntityManager to all Entity
        // $this->em = new Entity($this);
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }    

    public function getEntityName(){
        $class = get_class($this);
        return substr($class, strrpos($class, '\\') + 1);
    }

    public function setEntityManager(){
        return new Entity($this);        
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
        $base64 = '0123456789abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ-_!%';
        // éàù$
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
     * first digit are based on the current timestamp in micro second, and the last digit are the request IP.
     * all is converted on base 64 code
     */
    public function setUniqId(){
        
        $uniqid = uniqid(true);    
        return substr($uniqid, 0, 8). '-' . substr($uniqid, 8, 4) . '-' . substr($uniqid, 12, 2). bin2hex(random_bytes(1)) . '-' . bin2hex(random_bytes(2)) . '-' . bin2hex(random_bytes(2)) . $this->ipToHex();
        // $hex = substr($uniqid, 0, 8).substr($uniqid, 8, 4) . substr($uniqid, 12, 2). bin2hex(random_bytes(1)) . bin2hex(random_bytes(2)) .  bin2hex(random_bytes(2)) . $this->ipToHex();
        // return $this->base64($hex);
    }
    
}