<?php
namespace API\Model\Entity;

use DateInterval;

class Bookings extends Entities
{   
    // primary key
    public string $id;
    
    public string $user_id;
    public string $suite_id;
    public string $date_checkin;
    public string $date_checkout;    
    public int $price;    

    public function __construct()
    {                             
            
    }
    /**
     * @param string $user
     * @param string $suites
     * @param string $date_checkin, format date (y m d)
     * @param string $date_checkout, format date (y m d)
     */
    public function setEntity($users, $suites, string $date_checkin, string $date_checkout){
        $this->id = $this->setUniqId();
        
        $this->user_id = $users;
        $this->suite_id = $suites;
        
        $this->date_checkin = $date_checkin;
        $this->date_checkout = $date_checkout;

        $this->price = $this->getPrice();        
    }
    public function getPrice(){
        
        $suite = (new Suites)->setId($this->suite_id)->setEntityManager()->getEntity();
        $period = date_diff(new \DateTime($this->date_checkin), new \DateTime($this->date_checkout))->d;  
        
        return ($suite->price) * $period;
    }

    /**
     * @param string $date (y - m - d)
     */
    public function setCheckin($date){
        $this->date_checkin = $date;

        $this->price = $this->getPrice();
        return $this->date_checkin;
    }

    public function getCheckin(){        
        $this->price = $this->getPrice();
        return $this->date_checkin;
    }
    
    /**
     * @param string $date (y - m - d)
     */
    public function setCheckout($date){
        $this->date_checkout = $date;
        $this->price = $this->getPrice();
        return $this->date_checkout;
    }
    public function getCheckout(){
        return $this->date_checkin;
    }

    public function getNumbersOfNights(){
        return (date_diff(new \DateTime($this->date_checkin), new \DateTime($this->date_checkout))->days);
    }

    public function UpdateCalendar(){
        $this->setEntityManager()->deleteEntity('calendars', 'booking_id', $this->id);

        $nights = $this->getNumbersOfNights();
        // créer un objet calendar avec un doute et boucler en incrémentant la date
        
        for($i = 0; $i < $nights ; $i++){            
            $checkin = new \DateTime($this->date_checkin);
            $calendar = new Calendars;
            $calendar->setEntity($this->user_id, $this->suite_id, $this->id, date('Y-m-d', $checkin->add(new DateInterval('P'.$i.'D'))->getTimestamp()));
            try{
                $calendar->setEntityManager()->persistEntity();                
            }
            catch(\Exception $e){                
                echo json_encode('calendar :'.$e);                
            }            
            unset($calendar);
        }                           
        
    }
    public function bookingPersist(){
        $this->setEntityManager()->persistEntity();
        $this->UpdateCalendar();        
    }
    public function getBookedCalendars($suite_id = null){

        if($suite_id === null){
            $suite_id = $this->suite_id;
        }
        // tableau avec toutes les dates réserver de la chambre
        $query = "SELECT date FROM calendars WHERE suite_id=\"$suite_id\" AND date>NOW()";
        $response = $this->setEntityManager()->getWithQuery($query, false);
        $date = [];
        foreach($response as $element){
            $date[] = $element['date'];
        }
        return $date;
    } 
}