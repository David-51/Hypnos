<?php
namespace API\Model\Entity;

class Bookings extends Entities
{   
    // primary key
    public string $id;
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
        
        return $this;
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

        $checkin = new \DateTime($this->date_checkin);
        $checkout = new \DateTime($this->date_checkout);
        $period = date_diff($checkin, $checkout)->d;
        
        return ($this->suite->price) * $period;
    }

    /**
     * @param string $date (y - m - d)
     */
    public function setCheckin($date){
        return $this->date_checkin = $date;
    }

    public function getCheckin(){
        return $this->checkin;
    }
    
    /**
     * @param string $date (y - m - d)
     */
    public function setCheckout($date){
        return $this->date_checkout = $date;
    }
    public function getCheckout(){
        return $this->checkin;
    }
}