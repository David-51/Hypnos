<?php
namespace API\Model\Entity;

class Suites extends Entities
{   
    // primary key
    public string $id;
    public Establishments $establishment;
    public string $title;
    public string $link_to_booking;
    public string $description;
    public int $price;
    public string $establishment_id;

    // this array is update from databse
    public array $datas;

    public function __construct()
    {                          
        $this->setEntityName(__CLASS__);        
    }
    
    public function setEntity(Establishments $establishment, string $title, string $link_to_booking, string $description, int $price){
        $this->id = $this->setUniqId();
        $this->establishment = $establishment;
        $this->title = $title;
        $this->link_to_booking = $link_to_booking;
        $this->description = $description;
        $this->price = $price;
        
        $establishment_id = key($establishment);
        $this->establishment_id = $establishment->$establishment_id;

        $this->datas = [
            'id' => '',
            'title' => '',
            'link_to_booking' => '',
            'description' => '',
            'price' => 0,
            'establishment_id' => ''            
        ];

        $establishment->addSuite($this);        
        return $this;
    }
    public function removeSuite(){
        $this->establishment->removeSuite($this);
        return $this->establishment;
    }

    public function setTitle($title){
        return $this->title = $title;
    }
    
    public function getTitle($title){
        return $this->title;
    }
    
    public function setLinkToBookink($link_to_booking){
        return $this->link_to_booking = $link_to_booking;
    }
    public function getLinkToBooking(){
        return $this->link_to_booking;
    }
    
    public function setDescription($description) :string {
        return $this->description = $description;
    }

    public function getDescription() :string {
        return $this->description;
    }

    public function setPrice($price){
        return $this->price = $price;
    }
    public function getPrice(){
        return $this->price;
    }
   
    public function getAll() {        
        return $this;
    }

}