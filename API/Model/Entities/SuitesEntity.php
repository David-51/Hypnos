<?php
namespace API\Model\Entity;

use API\Model\Manager\Entity;

class Suites extends Entities
{   
    // primary key
    public string $id;
    public string $title;
    public string $link_to_booking;
    public string $description;
    public int $price;
    public string $establishment_id;    

    public function __construct()
    {                                
        
    }
    
    public function setEntity(Establishments $establishment, string $title, string $link_to_booking, string $description, int $price){
        $this->id = $this->setUniqId();
        $this->title = $title;
        $this->link_to_booking = $link_to_booking;
        $this->description = $description;
        $this->price = $price;
        $this->establishment_id = $establishment->id;
        
        return $this;
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

    public function getDates(){
        $calendar = new Calendars;
        $req = $this->setEntityManager()->getChilds($calendar);
        var_dump($req);

        switch ($req[0]){
            case 'success':
                $response= [];
                foreach($req[1] as $key => $value){
                    $response[] = $value->date;
                }
                return $response;
            break;
            case 'error':
                return $req;
                break;
            default :
            return $req;
            break;
        }      
    }
}