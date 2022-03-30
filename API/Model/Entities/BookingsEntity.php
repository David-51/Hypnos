<?php
namespace API\Model\Entity;

use API\Model\Manager\Database;
use DateInterval;

class Bookings extends Entities
{   
    // primary key
    public string $id ='undefined';
    public string $booking_date;
    public string $user_id;
    public string $suite_id;
    public string $date_checkin;
    public string $date_checkout;
    public int $number_of_nights;
    public int $price;
    
    // this array is update from databse
    public array $datas;

    public function __construct()
    {                          
        $this->setEntityName(__CLASS__);        
            
    }
    /**
     * @param Users 
     * @param Suites
     * @param string $date_checkin, format date (y m d)
     * @param string $date_checkout, format date (y m d) 
     */
    public function setEntity(Users $user, Suites $suite, string $date_checkin, string $date_checkout){
        $this->id = $this->setUniqId();
        
        $this->user = $user;
        $this->suite = $suite;

        $this->user_id = $user->getPrimaryKeyValue();
        $this->suite_id = $suite->getPrimaryKeyValue();
        
        $this->date_checkin = $date_checkin;
        $this->date_checkout = $date_checkout;

        $this->price = $this->getPrice();

        $this->datas = [
            'id' => '',
            'user_id' => '',
            'suite_id' => '',
            'date_checkin' => '',
            'date_checkout' => '',
            'price' => '',
        ];
        
        return $this;
    }
    public function getPrice(){
        
        $period = date_diff(new \DateTime($this->date_checkin), new \DateTime($this->date_checkout))->d;
        
        return ($this->suite->price) * $period;
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
        return (date_diff(new \DateTime($this->date_checkin), new \DateTime($this->date_checkout))->d);
    }

    public function UpdateCalendar(){
        $this->em->deleteEntity(['calendars', 'user_id', $this->user->id]);

        $params = "user_id, suite_id, booking_id, date";
        $valueToBind = ":user_id, :suite_id, :booking_id, :date";

        $nights = $this->getNumbersOfNights();
        // créer un objet calendare avec un doute et boucler en incrémentant la date
        
            
        for($i = 0; $i < $nights ; $i++){
            $checkin = new \DateTime($this->date_checkin);

            $calendar = new Calendars;
            $calendar->setEntity($this->user, $this->suite, $this, date('Y-m-d', $checkin->add(new DateInterval('P'.$i.'D'))->getTimestamp()));
            $calendar->setEntityManager()->persistEntity();
            unset($calendar);
        }
        
        // $bind = [
        //     ':user_id' => '',
        //     ':suite_id' => '',
        //     ':booking_id' => '',
        //     ':date' => ''];

        //     $userid = [];
        //     $suiteid = [];
        //     $bookingid = [];
        //     $date = [];

        //     for($i = 0 ; $i < $nights ; $i++){
        //         $userid[] = $this->user_id;
        //         $suiteid[] = $this->suite_id;
        //         $bookingid[] = $this->booking_id;
        //         $date[] = $this->date_checkin->add(new DateInterval( $i.'d'));
        //     }
                 
        //     $query = "INSERT INTO calendars($params) VALUES($valueToBind)";
        //     $db = Database::getConnection();
            
        //     try{
        //         $sth = $db->prepare($query);                        
        //         for($i = 0 ; $i < $nights ; $i++){                
        //             $sth->bindValue(':user_id', implode(', ', $userid));
        //             $sth->bindValue(':suite_id', implode(', ', $suiteid));
        //             $sth->bindValue(':booking_id', implode(', ', $bookingid));
        //             $sth->bindValue(':date', implode(', ', $date));                
        //             $sth->execute();
        //         }
        //     }
        //     catch(\PDOException $e){
        //         return ['error', $e];
        //     }
            return ['success', 'calendar modified'];        
    }
}