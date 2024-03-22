<?php

namespace model\Hotel;

class Room{
    private $room_id;
    private $type_id;
    private $name;
    private $city;
    private $area;
    private $photo_url;
    private $count_of_guests;
    private $price;
    private $address;
    private $location_lat;
    private $location_long;
    private $description_short;
    private $description_long;
    private $parking;
    private $wifi;
    private $pet_friendly;
    private $avg_reviews;
    private $count_reviews;
    private $created_time;
    private $updated_time;

   public function __construct($room_id,$type_id,$name,$city,$area,$photo_url,$count_of_guests,$price,$address,$location_lat,$location_long,$description_short,$description_long,$parking,$wifi,$pet_friendly,$avg_reviews,$count_reviews,$created_time,$updated_time){
    $this->room_id=$room_id;
    $this->type_id=$type_id;
    $this->name=$name;
    $this->city=$city;
    $this->area=$area;
    $this->photo_url=$photo_url;
    $this->count_of_guests=$count_of_guests;
    $this->price=$price;
    $this->address=$address;
    $this->location_lat=$location_lat;
    $this->location_long=$location_long;
    $this->description_short=$description_short;
    $this->description_long=$description_long;
    $this->parking=$parking;
    $this->wifi=$wifi;
    $this->pet_friendly=$pet_friendly;
    $this->avg_reviews=$avg_reviews;
    $this->count_reviews=$count_of_guests;
    $this->created_time=$created_time;
    $this->updated_time=$updated_time;

   }
   public function getRoom_id(){
    return $this->room_id;
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
   public function getPrice(){
    return $this->price;
   }
   public function getAddress(){
    return $this->address;
   }
   public function getLocation_lat(){
    return $this->location_lat;
   }
   public function getLocation_long(){
    return $this->location_long;
   }
   public function getDescription_short(){
    return $this->description_short;
   }
   public function getDescription_long(){
    return $this->description_long;
   }
   public function getParking(){
    return $this->parking;
   }
   public function getWifi(){
    return $this->wifi;
   }
   public function getPet_friendly(){
    return $this->pet_friendly;
   }
   public function getAvg_reviews(){
    return $this->avg_reviews;
   }
   public function getCount_reviews(){
    return $this->count_reviews;
   }
   public function getCreated_time(){
    return $this->created_time;
   }
   public function getUpdated_time(){
    return $this->updated_time;
   }

   public static function createRoom($row){
    return new Room($row["room_id"],$row["type_id"],$row["name"],$row["city"],$row["area"],$row["photo_url"],$row["count_of_guests"],$row["price"],$row["address"],$row["location_lat"],$row["location_long"],$row["description_short"],$row["description_long"],$row["parking"],$row["wifi"],$row["pet_friendly"],$row["avg_reviews"],$row["count_reviews"],$row["created_time"],$row["updated_time"]);

   }

}