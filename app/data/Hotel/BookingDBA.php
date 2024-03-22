<?php

namespace Data\Hotel;
use PDO;
use ArrayObject;
use \model\Hotel\Booking;
use \model\Hotel\BookingRooms;
use DateTime;

class BookingDBA {
    private $pdo;
    public function __construct(){
        $this->pdo=new PDO('mysql:host=127.0.0.1;dbname=hotel;charset=UTF8','root','Filaki19!!!',[
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"

        ]);
    }
    
    protected function getPdo(){
        return $this->pdo;
    }

    function getAllBookings(){
        $result= new ArrayObject();
        $statement=$this->getPdo()->query("SELECT*FROM booking");
        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $booking=Booking::createBooking($row);
            $result->append($booking);
        }
        return $result;
    }


    function getBookingsByRoomIDByDate($room_id,$checkInDate,$checkOutDate){
        $checkinDateString = $checkInDate->format(DateTime::ATOM);
        $checkoutDateString = $checkOutDate->format(DateTime::ATOM);

        $result= new ArrayObject();
        $statement=$this->getPdo()->prepare("SELECT * 
        FROM `booking` 
        WHERE `room_id` = :room_id AND ((`check_in_date`  BETWEEN :selected_check_in_date AND  :selected_check_out_date ) OR (`check_out_date` BETWEEN :selected_check_in_date AND :selected_check_out_date))");
        $statement->bindParam(':selected_check_in_date', $checkinDateString, PDO::PARAM_STR);
        $statement->bindParam(':selected_check_out_date', $checkoutDateString, PDO::PARAM_STR);
        $statement->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $statement->execute();

        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $booking=Booking::createBooking($row);
            $result->append($booking);
        }
        return $result;
    }

    

    function getBookingsByUserID($user_id){
        $result=new ArrayObject();
        $statement=$this->getPdo()->prepare("
        SELECT 
        `room`.`room_id`, 
        `room`.`photo_url`, 
        `room`.`name`, 
        `room`.`city`, 
        `room`.`area`, 
        `room`.`description_short`, 
        `room`.`count_of_guests`,
         `room`.`type_id`, 
         `booking`.`total_price`, 
         `booking`.`check_in_date`, 
         `booking`.`check_out_date` ,
         `room_type`.`title`
          FROM `room`
          INNER JOIN `booking`ON `room`.`room_id` =`booking`.`room_id`
          INNER JOIN `room_type` ON room_type.type_id=room.type_id
          WHERE `booking`.`user_id`= :user_id");
          $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
          $statement->execute();
          while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $bookingRoom=BookingRooms::createBookingRooms($row);
            $result->append($bookingRoom);
        }
        return $result;

    }

    function addBooking($room_id, $user_id, $checkInDate, $checkOutDate){
        //start transaction
        $this->getPdo()->beginTransaction();
        //Get Room Info
        $statement=$this->getPdo()->prepare("SELECT * FROM room WHERE room_id = :room_id");
        $statement->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $statement->execute();
        if($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $price=$row['price'];
        }
        
        $selectedCheckinDate = new DateTime($checkInDate);
        $selectedCheckOutDate = new DateTime($checkOutDate);

        //Calculate Final Price 
        $daysDiff=$selectedCheckOutDate->diff( $selectedCheckinDate)->days + 1;
        $totalPrice=$price*$daysDiff;
        
        //Book Room
        $statement=$this->getPdo()->prepare("INSERT INTO booking (room_id, user_id, total_price, check_in_date, check_out_date) 
        VALUES(:room_id,:user_id,:total_price,:selected_check_in_date,:selected_check_out_date)");
        $statement->bindParam(':room_id',$room_id,PDO::PARAM_INT);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindParam(':total_price', $totalPrice, PDO::PARAM_INT);
        $statement->bindParam(':selected_check_in_date', $checkInDate, PDO::PARAM_STR);
        $statement->bindParam(':selected_check_out_date', $checkOutDate, PDO::PARAM_STR);
        $statement->execute();

    

        //Commit
        $this->getPdo()->commit();

    }





}