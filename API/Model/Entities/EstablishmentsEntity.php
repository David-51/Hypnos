<?php
namespace API\Model\Entity;

class Establishments extends Entities
{   
    // primary key
    public string $id; // first must be always primary key
    
    public string $name;
    public string $city;
    public string $adress;
    public string $description;

    public array $suites;
    // this array is update from databse
    public array $datas;

    public function __construct()
    {                          
        $this->setEntityName(__CLASS__);        
    }
    
    public function setEntity(string $name, string $city, string $adress, string $description){
        $this->id = $this->setUniqId();
        $this->name = $name;
        $this->city = $city;
        $this->adress = $adress;
        $this->description = $description;

        $this->datas = [
            'id' => '',
            'name' => '',
            'city' => '',
            'adress' => '',
            'description' => ''
        ];
        return $this;
    }

    public function addSuite(Suites $suites) :Establishments{
        $key = $suites->getPrimaryKey();
        $this->suites[$suites->$key] = $suites;           
        return $this;
    }

    public function removeSuite(Suites $suites) :Establishments{
        $key = $suites->getPrimaryKey();
        unset($this->suites[$suites->$key]);
        return $this;
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