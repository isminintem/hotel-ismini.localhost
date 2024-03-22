<?php

namespace data\Hotel;

use PDO;
use ArrayObject;
use \model\Hotel\RoomType;

class RoomTypeDBA {

    private $pdo;

    public function __construct() {
        $this->pdo=new PDO('mysql:host=127.0.0.1;dbname=hotel;charset=UTF8','root', 'Filaki19!!!', [
             PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
         ]);
     }
    

    protected function getPdo() {
        return $this->pdo;
    }


   function getAllRoomTypes(){
        $result=new ArrayObject();
        $statement=$this->getPdo()->query("SELECT * FROM room_type");
        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $room_type=RoomType::createRoomType($row);
            $result->append($room_type);
        }
        return $result;
   }


  
}
