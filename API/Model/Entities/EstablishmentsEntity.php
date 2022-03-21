<?php

namespace API\Model\Entity;

class Establishments extends Entities
{
    public string $primary_key = 'id';     //uuid ?
        
    public string $id = '';
    public string $name;
    public string $city;
    public string $adress;
    public string $description;
    public array $constructor = [
        'id', 'name', 'city', 'adress', 'description'
    ];

    public function __construct($name, $city, $adress, $description)
    {                   
        $this->id = $this->setUniqId();
        $this->datas = array_combine($this->constructor, [$this->id, $name, $city, $adress, $description]);
        $this->setDatas();
        $this->setEntityName(__CLASS__);
    }

    public function setName($name) :string {
        return $this->name = $name;
    }

    public function getName() :string {
        return $this->name;
    }

    public function setCity($city) :string {
        return $this->city = $city;
    }

    public function getCity() :string {
        return $this->city;
    }
    
    public function setAdress($adress) :string {
        return $this->adress = $adress;
    }

    public function getAdress() :string {
        return $this->adress;
    }
    
    public function setDescription($description) :string {
        return $this->description = $description;
    }

    public function getDescription() :string {
        return $this->description;
    }
    
    public function getAll() {        
        return $this;
    }

}