
<?php

// boot the application
require_once __DIR__.'/../../boot/boot.php';


use \Services\UserService;
use \Services\Utils\JWTUtils;
use \data\Hotel\BookingDBA;
use DateTime;





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
$result = $bookingDBA->addBooking($roomId,$userId,$checkInDate,$checkOutDate);




if($result==0) {
    //Return to Room Page
    header('Location: /public/html/profile.php');
} else {
    //return to the booking page
    $checkInDatetime = new Datetime($checkInDate);
    $checkOutDateTime = new Datetime($checkOutDate);

    header('Location: /public/html/results.php?room_id='.$roomId."&check-in-date=".$checkInDatetime->format("Y-m-d")."&check-out-date=".$checkOutDateTime->format("Y-m-d"));
}




?>