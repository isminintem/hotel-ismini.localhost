<?php

namespace data\Hotel;

use PDO;
use ArrayObject;
use \model\Hotel\RoomType;
use Services\Utils\Configuration;

class RoomTypeDBA {

    private $pdo;

    public function __construct() {
        $config = Configuration::getInstance();

        $this->pdo=new PDO(sprintf('mysql:host=%s;dbname=%s;charset=UTF8', $config->getDataBaseHost(), $config->getDataBaseName()), 
            $config->getDataBaseUser(), 
            $config->getDataBasePassword(), 
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]);
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
