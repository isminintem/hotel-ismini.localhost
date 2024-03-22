<?php
namespace model\Hotel;

class BookingRooms{
    private $room_id;
    private $check_in_date;
    private $check_out_date;
    private $total_price;
    private $type_id;
    private $name;
    private $city;
    private $area;
    private $photo_url;
    private $count_of_guests;
    private $description_short;
    private $title;
 
    
    

    public function __construct($room_id,$check_in_date,$check_out_date,$total_price,$type_id,$name,$city,$area,$photo_url,$count_of_guests,$description_short,$title){
         $this->room_id=$room_id;
         $this->check_in_date=$check_in_date;
         $this->check_out_date=$check_out_date;
         $this->total_price=$total_price;
         $this->type_id=$type_id;
         $this->name=$name;
         $this->city=$city;
         $this->area=$area;
         $this->photo_url=$photo_url;
         $this->count_of_guests=$count_of_guests;
         $this->description_short=$description_short;
         $this->title=$title;        
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
    
    public function getType_id(){
        return $this->type_id;
    }
    public function getName(){
        return $this->name;
    }
    public function getCity(){
        return $this->city;
    }
    public function getArea(){
        return $this->area;
    }
    public function getPhoto_url(){
        return $this->photo_url;
    }
    public function getCount_of_guests(){
        return $this->count_of_guests;
    }  
    public function getDescription_short(){
        return $this->description_short;
    }
    public function getTitle(){
        return$this->title;
    }
    


   

    public function __isToString(){
        return $this->booking_id."-".$this->total_price;
    }


    
    public static function createBookingRooms($row){
        return new BookingRooms($row["room_id"],$row["check_in_date"],$row["check_out_date"],$row["total_price"],$row["type_id"],$row["name"],$row["city"],$row["area"],$row["photo_url"],$row["count_of_guests"],$row["description_short"],$row["title"]);

    }
  



}