<?php

namespace model\Hotel;

class FavoriteRoom{
    private $user_id;
    private $room_id;
    private $roomName;
    private $created_time;
    private $updated_time;

    public function __construct($user_id,$room_id,$roomName,$created_time, $updated_time){
        $this->user_id=$user_id;
        $this->room_id=$room_id;
        $this->roomName=$roomName;
        $this->created_time=$created_time;
        $this->updated_time=$updated_time;
    
    }
    public function getUser_ID(){
        return $this->user_id;
    }
    public function getRoom_ID(){
        return $this->room_id;
    }
    public function getRoomName(){
        return $this->roomName;
    }
    public function getCreated_Time(){
        return $this->created_time;
    }
    public function getUpdated_Time(){
        return $this->updated_time;
    }

    public function __toString(){
        return $this->user_id."-".$this->room_id;
    }

    public static function createFavorite($row){
        return new FavoriteRoom($row["user_id"],$row["room_id"],$row["name"],$row["created_time"],$row["updated_time"]);
    }







}