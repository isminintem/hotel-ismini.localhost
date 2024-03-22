
<?php

// boot the application
require_once __DIR__.'/../../boot/boot.php';


use \Services\UserService;
use \Services\Utils\JWTUtils;
use \data\Hotel\BookingDBA;





if(empty(UserService::getCurrentUser())) {
    header("Location: /public/html/homepage.php");
}
$userId=UserService::getCurrentUser();

// return to homePage if it is not a POST invocation
if(strtolower($_SERVER['REQUEST_METHOD'])!='post'){
    header('Location: /public/html/index.php');

    return;
}


// chech if room_id is given
$roomId=$_REQUEST['room_id'];
if(empty($roomId)){
    header('Location: /public/html/index.php');

    return;
}



//Create Booking
$bookingDBA=new BookingDBA();
$checkInDate=$_REQUEST['check_in_date'];
$checkOutDate=$_REQUEST['check_out_date'];
$bookingDBA->addBooking($roomId,$userId,$checkInDate,$checkOutDate);






//Return to Room Page





?>