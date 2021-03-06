<?php
namespace API\Model\Entity;

class Establishments extends Entities
{   
    // primary key
    public string $id; 
    public string $name;
    public string $city;
    public string $adress;
    public string $description;

    // public string $entity_name

    public function __construct()
    {                                       
        
    }
    
    public function setEntity(string $name, string $city, string $adress, string $description){
        $this->id = $this->setUniqId();
        $this->name = $name;
        $this->city = $city;
        $this->adress = $adress;
        $this->description = $description;

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

    public function getSuites(){        
        // récupérer les suite de l'établissement avec les pictures classé dans les suites
        $suites = $this->setEntityManager()->getChilds(new Suites);        
        foreach($suites as $key => $value){
            $value->pictures = $value->setEntityManager()->getChilds(new Pictures);
        }
        return $suites;
    }
    public function getAllSuites(){
        $suites = (new Suites)->setEntityManager()->getEntity();
        foreach($suites as $value){
            $value->pictures = $value->setEntityManager()->getChilds(new Pictures);
        }
        return $suites;
    }
}