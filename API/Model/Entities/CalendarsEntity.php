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
    
    public function __construct()
    {                                    
            
    }
    /**
     * @param string $user_id 
     * @param string $suite_id
     * @param string booking_id
     * @param string $date
     * 
     */
    public function setEntity(string $user_id, string $suite_id, string $booking_id, string $date){
        $this->id = $this->setUniqId();
        
        $this->user_id = $user_id;
        $this->suite_id = $suite_id;
        $this->booking_id = $booking_id;

        $this->date = $date;
        // $this->date_checkout = $date_checkout;        
        // return $this;
    }    

}