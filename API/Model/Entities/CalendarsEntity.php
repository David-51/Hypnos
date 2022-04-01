<?php
namespace API\Model\Entity;

class Calendars extends Entities
{   
    // primary key
    public string $id = 'undefined';    
    public string $user_id;
    public string $suite_id;
    public string $booking_id;
    public string $date;
    
    // this array is update from databse
    public array $datas;

    public function __construct()
    {                                    
            
    }
    /**
     * @param Users 
     * @param Suites
     * @param Bookings
     * @param string $date_checkin, format date (y m d)
     * @param string $date_checkout, format date (y m d) 
     */
    public function setEntity(Users $user, Suites $suite, Bookings $booking, $date){
        $this->id = $this->setUniqId();
        
        $this->user = $user;
        $this->suite = $suite;
        $this->bookings = $booking;

        $this->user_id = $user->getPrimaryKeyValue();
        $this->suite_id = $suite->getPrimaryKeyValue();
        $this->booking_id = $booking->getPrimaryKeyValue();
        
        $this->date = $date;        

        $this->datas = [
            'id' => '',
            'user_id' => '',
            'suite_id' => '',
            'booking_id' => '',                        
            'date' => '',
        ];
        
        return $this;
    }

}