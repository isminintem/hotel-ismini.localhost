<?php

namespace Model\Hotel;

class RoomType{
    private $type_id;
    private $title;


    public function __construct($type_id, $title) {
        $this->type_id=$type_id;
        $this->title=$title;

    }

    public function getType_id(){
        return $this->type_id;
    }

    public function getTitle(){
        return $this->title;
    }
    public function __toString() {   
        return $this->type_id."-".$this->title."-";   
    }
    public static function createRoomType($row){
        return new RoomType($row["type_id"],$row["title"]);
    }
}
