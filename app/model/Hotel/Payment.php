<?php

namespace model\Hotel;

class payment{
    private $payment_id;
    private $booking_id;
    private $created_time;
    private $amount;
    private $user_id;

    public function __construct($payment_id, $booking_id,$created_time,$amount,$user_id){
        $this->payment_id=$payment_id;
        $this->booking_id=$booking_id;
        $this->created_time=$created_time;
        $this->amount=$amount;
        $this->user_id=$user_id;
    }

    public function getPayment_ID(){
        return $this->payment_id;
    }
    public function getBooking_ID(){
        return $this->booking_id;
    }
    public function getCreated_Time(){
        return $this->created_time;
    }
    public function getAmount(){
        return $this->amount;
    }
    public function getUser_ID(){
        return $this->user_id;
    }

    public function __toString() {   
        return $this->payment_id."-".$this->booking_id."-".$this->amount;     
    }

    public static function createPayment($row){
        return new Payment($row["payment_id"],$row["booking_id"],$row["created_time"],$row["amount"],$row["user_id"]);
    }






}