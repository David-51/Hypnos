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
    public array $datas;

    public function __construct()
    {                   

        // Pour utiliser Fetch class il faut virer le constructor qui casse les burnes, et utiliser les setters pour construire l'object,
        // ce qui permet au passage de constuire un objet vide et de le remplir ensuite
        // $name, $city, $adress, $description <--- le constructor fait tout buggé ? utiliser des setters pour construire tout ca
        $this->id = $this->setUniqId();
        
        $this->datas = [
            'id' => $this->id,
            'name' => $this->name,
            'city' => $this->city,
            'adress' => $this->adress,
            'description' => $this->description
        ];
        
        $this->setDatas(); // à supprr
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