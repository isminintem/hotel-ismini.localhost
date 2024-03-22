<?php
namespace model\Hotel;

class Booking{
    private $booking_id;
    private $user_id;
    private $room_id;
    private $check_in_date;
    private $check_out_date;
    private $total_price;
    private $created_time;
    private $updated_time;
    

    public function __construct($booking_id,$user_id,$room_id,$check_in_date,$check_out_date,$total_price,$created_time,$updated_time){
         $this->booking_id=$booking_id;
         $this->user_id=$user_id;
         $this->room_id=$room_id;
         $this->check_in_date=$check_in_date;
         $this->chech_out_date=$check_out_date;
         $this->total_price=$total_price;
         $this->created_time=$created_time;
         $this->updated_time=$updated_time;
        }
    
    public function getBooking_ID(){
        return $this->booking_id;
    }
    public function getUser_ID(){
        return $this->user_id;
    }
    public function getRoom_ID(){
        return $this->room_id;
    }
    public function getCheck_In_Date(){
        return $this->check_in_date;
    }
    public function getCheck_Out_Date(){
        return $this->check_out_date;
    }
    public function getTotal_Price(){
        return $this->total_price;
    }
    public function getCreated_Time(){
        return $this->created_time;
    }
    public function getUpdated_Time(){
        return $this->updated_time;
    }

    public function __isToString(){
        return $this->booking_id."-".$this->total_price;
    }

    public static function createBooking($row){
        return new Booking($row["booking_id"],$row["user_id"],$row["room_id"],$row["check_in_date"],$row["check_out_date"],$row["total_price"],$row["created_time"],$row["updated_time"]);

    }
  



}