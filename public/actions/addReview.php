
<?php

// boot the application
require_once __DIR__.'/../../boot/boot.php';


use \Services\UserService;
use \Services\Utils\JWTUtils;
use \data\Hotel\ReviewDBA;




if(empty(UserService::getCurrentUser())) {
    header("Location: /public/html/homepage.php");
}
$userId=UserService::getCurrentUser();

// return to homePage if it is not a POST invocation
if(strtolower($_SERVER['REQUEST_METHOD'])!='post'){
    header('Location: /public/html/index.php');

    return;
}




// check if room_id is given
$roomId=$_REQUEST['room_id'];
if(empty($roomId)){
    header('Location: /public/html/index.php');

    return;
}


// check if room_id is given
$comment=$_REQUEST['comment'];
if(empty($comment)){
    header('Location: /public/html/index.php');

    return;
}

// check if room_id is given
$rate=$_REQUEST['rate'];
if(empty($rate)){
    header('Location: /public/html/index.php');

    return;
}



//add review
$reviewDBA=new ReviewDBA();
$reviewDBA->addReview($roomId,$userId,$rate,$comment);

//Return to room Page
// header('Location: /public/html/results.php');
// return;





?>