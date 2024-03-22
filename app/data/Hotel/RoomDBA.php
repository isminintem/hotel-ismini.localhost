<?php

namespace data\Hotel;

use PDO;
use DateTime;
use ArrayObject;
use \model\Hotel\Room;

class RoomDBA {
    private $pdo;
    public function __construct(){
        $this->pdo=new PDO('mysql:host=127.0.0.1;dbname=hotel;charset=UTF8','root', 'Filaki19!!!', [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        ]);
    }

    protected function getPdo(){
        return $this->pdo;
    }

    function getAllRooms(){
        $result= new ArrayObject();
        $statement=$this->getPdo()->query("SELECT * FROM room");
        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $room=Room::createRoom($row);
            $result->append($room);   
        }
        return $result;
    }

    function getAllCities(){
        $statement=$this->getPdo()->query("SELECT DISTINCT city FROM room");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    // function getAvailableRooms($roomType, $city, $checkinDate, $checkoutDate) {
    //     $result= new ArrayObject();

    //     $query = 'SELECT * FROM `room` WHERE city = :city AND `type_id` = :type_id AND `room_id` NOT IN (
    //         SELECT room_id
    //         FROM `booking` 
    //         WHERE (`check_in_date`  BETWEEN :selected_check_in_date AND  :selected_check_out_date ) OR (`check_out_date` BETWEEN :selected_check_in_date AND :selected_check_out_date)
    //     )';


    //     $checkinDateString = $checkinDate->format(DateTime::ATOM);
    //     $checkoutDateString = $checkoutDate->format(DateTime::ATOM);

    //     $statement=$this->getPdo()->prepare($query);
    //     $statement->bindParam(':type_id', $roomType, PDO::PARAM_INT);
    //     $statement->bindParam(':city', $city, PDO::PARAM_STR);
    //     $statement->bindParam(':selected_check_in_date', $checkinDateString, PDO::PARAM_STR);
    //     $statement->bindParam(':selected_check_out_date', $checkoutDateString, PDO::PARAM_STR);
    //     $statement->execute();
    //     while($row=$statement->fetch(PDO::FETCH_ASSOC)){
    //         $room=Room::createRoom($row);
    //         $result->append($room);   
    //     }
    //     return $result;
    // }

    function getAvailableRooms($roomType, $city, $checkinDate, $checkoutDate, $guests, $pricemin, $pricemax) {
        $result= new ArrayObject();

        //with this 'cheat', we don't need to always have values in the query parameters
        //i.e. if $guests has no value ("") then the left part of the OR condition will be validated (as true) so we don't have to evaluate the filter of the right part
        $query = 'SELECT * FROM `room` WHERE 
            (("" = :city) OR (`city` = :city)) AND 
            (("" = :type_id) OR (`type_id` = :type_id)) AND
            (("" = :count_of_guests) OR (`count_of_guests` = :count_of_guests)) AND 
            (("" = :pricemin) OR (`price` > :pricemin)) AND 
            (("" = :pricemax) OR (`price` < :pricemax)) AND 
            `room_id` NOT IN (
            SELECT room_id
            FROM `booking` 
            WHERE (`check_in_date`  BETWEEN :selected_check_in_date AND  :selected_check_out_date ) OR (`check_out_date` BETWEEN :selected_check_in_date AND :selected_check_out_date)
        )';

        $checkinDateString = $checkinDate->format(DateTime::ATOM);
        $checkoutDateString = $checkoutDate->format(DateTime::ATOM);

        $statement=$this->getPdo()->prepare($query);
        $statement->bindParam(':type_id', $roomType, PDO::PARAM_INT);
        $statement->bindParam(':city', $city, PDO::PARAM_STR);
        $statement->bindParam(':count_of_guests', $guests, PDO::PARAM_INT);
        $statement->bindParam(':pricemin', $pricemin, PDO::PARAM_INT);
        $statement->bindParam(':pricemax', $pricemax, PDO::PARAM_INT);
        $statement->bindParam(':selected_check_in_date', $checkinDateString, PDO::PARAM_STR);
        $statement->bindParam(':selected_check_out_date', $checkoutDateString, PDO::PARAM_STR);
        $statement->execute();
        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $room=Room::createRoom($row);
            $result->append($room);   
        }
        return $result;
    }

    



    function getAllGuests(){
        $statement=$this->getPdo()->query("SELECT DISTINCT count_of_guests FROM room");
        return $statement->fetchAll(PDO::FETCH_ASSOC); 
    }
   
    function getRoomByID($room_id){
        $result=new ArrayObject();
        $statement=$this->getPdo()->prepare("SELECT * FROM room WHERE room_id = :room_id");
        $statement->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return Room::createRoom($row);
    }


   

}
