<?php

namespace model\Hotel;

class Review{
    private $review_id;
    private $room_id;
    private $user_id;
    private $name;
    private $rate;
    private $comment;
    private $created_time;
    private $updated_time;


    public function __construct($review_id,$room_id,$user_id,$name,$rate,$comment,$created_time,$updated_time){
        $this->review_id=$review_id;
        $this->room_id=$room_id;
        $this->user_id=$user_id;
        $this->name=$name;
        $this->rate=$rate;
        $this->comment=$comment;
        $this->created_time=$created_time;
        $this->updated_time=$updated_time;

    }
    public function getReview_ID(){
        return $this->review_id;
    }
    public function getRoom_ID(){
        return $this->room_id;
    }
    public function getUser_ID(){
        return $this->user_id;
    }
    public function getName(){
        return $this->name;
    }
    public function getRate(){
        return $this->rate;
    }
    public function getComment(){
        return $this->comment;
    }
    public function getCreated_Time(){
        return $this->created_time;
    }
    public function getUpdated_Time(){
        return $this->updated_time;
    }
    public function __toString() {   
        return $this->user_id."-".$this->rate."-".$this->comment;     
    }

    public static function createReview($row){
        return new Review($row["review_id"],$row["room_id"],$row["user_id"],
        $row["name"],
        $row["rate"],$row["comment"],$row["created_time"],$row["updated_time"]);
    }


}
 