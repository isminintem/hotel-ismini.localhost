<?php

require_once __DIR__.'/../../boot/boot.php';

// use \Data\Hotel\UserDBA;
// use \Data\Hotel\RoomTypeDBA;
// use \Model\Hotel\User;
// use \Model\Hotel\RoomType;
// use \data\Hotel\BookingDBA;
// use \model\Hotel\Booking;

// use \Services\Utils\JWTUtils;
use  \Services\UserService;


$result = UserService::login('email5', 'pass11');
var_dump($result);




// $userDBA=new UserDBA();
// //$CurrentUserid->addNewUser("user1", "pass2", "email3");
// //$userDBA->getUserByEmailPassword('ismini@example.com', '0000');
// $users = $userDBA->getAllUsers();
// echo "<br />\n";


// echo "<table>";
// echo "<tr><th>UserID</th><th>Name</th><th>Email</th><th>Created Time</th></tr>";
// foreach($users as $user) {
//     echo "<tr>";
//     echo "<td>".$user->getUser_ID()."</td>";
//     echo "<td>".$user->getName()."</td>";
//     echo "<td>".$user->getEmail()."</td>";
//     echo "<td>".$user->getCreated_time()."</td>";
//     echo "</tr>";
// }
// echo "</table>";
// $roomTypeDBA= new RoomTypeDBA();
// $room_types=$roomTypeDBA->getAllRoomTypes();
// var_dump($room_types);
// echo "<br/>\n";

// echo "<table>";

// echo "<tr><th>type_id</th><th>title</th></tr>";
// foreach($room_types as $room_type){
//     echo "<td>".$room_type->getType_id()."</td>";
//     echo "<td>".$room_type->getTitle()."</td>";
//     echo "</tr>";
// }

// echo "</table>";

// $reviewDBA=new ReviewDBA();
// $reviews=$reviewDBA->getAllReviews();
// var_dump($reviews);

// $bookingDBA=new BookingDBA();
// $bookings=$bookingDBA->getAllBookings();
// var_dump($bookings);


//$token = JWTUtils::generateToken("user1");
//echo $token."<br />\n";

//$result = JWTUtils::verifyToken($token);
//var_dump($result); 

// $CurrentUserid->getUserByUserName("Ismini");

// $emailpassword=new User();
// $emailpassword->getUserByEmailPassword();




//var_dump(get_class($user));

//create the data class 'User'
// $user = new User();

//$user->getAllUsers();

// $RoomType = new RoomType();
// $RoomType->getAllRoomTypes();




/*
$username = "John";
$password = "3333";
$pdo= new PDO('mysql:host=localhost;dbname=hotel',$username,$password);
$preparedStatement = $pdo->prepare("SELECT * FROM user WHERE name = ? AND password = ?");
$preparedStatement->execute([$username, $password]);
while ($row = $preparedStatement->fetch()) {
    echo $row['name']." - ".$row['email']."<br />\n";
}
*/

