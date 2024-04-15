<?php

// boot the application
require_once __DIR__.'/../../boot/boot.php';


use \Services\UserService;
use \Services\Utils\JWTUtils;
use \data\Hotel\ReviewDBA;
// use \model\Hotel\Review;
use \data\Hotel\UserDBA;
use \model\Hotel\UserReview;




if(empty(UserService::getCurrentUser())) {
    echo "No current user for this operation";
    die;
}
$userId=UserService::getCurrentUser();

// return to homePage if it is not a POST invocation.I can not have redirect when i have an ajax request
if(strtolower($_SERVER['REQUEST_METHOD'])!='post'){
    echo "This is a post script"; 
    die;
}


// chech if room_id is given
$roomId=$_REQUEST['room_id'];
if(empty($roomId)){
    echo"No room is given for this operation";
    die;
}

$rate=$_REQUEST['rate'];
$comment=$_REQUEST['comment'];

$reviewDBA=new ReviewDBA();
$reviewsOfRoom=$reviewDBA->getUserReviewByRoomId($roomId);

//add review
$reviewDBA=new ReviewDBA();
$reviewDBA->addReview($roomId,$userId,$rate,$comment);

//Get all Reviews
$roomReviews=$reviewDBA->getReviewByUserID($roomId);
$counter=count($roomReviews);

//Load User
$user=new UserDBA();
$userInfo=$user->getUserByUserId($userId);




?>


        <div class="totalReviews">
               
                <h4 class="reviews">Reviews</h4>
                <div id="room-reviews-container">   
                <?php
                $counter=1;
                    foreach($reviewsOfRoom as $review) {                        
                    ?>
                    
                        <span><?php echo $counter?>.&nbsp;</span> 
                            <?php echo $userInfo->getName()?>&nbsp;&nbsp; 
                            <?php $rate = $review->getRate();
                            for($i=1; $i <=5; $i++) {
                                if ($rate >= $i){
                                    ?>
                                    <div class="star selected" data-rating="">&#9733;</div>
                                    <?php
                                }else{
                                    ?>
                                    <div class="star" data-rating="">&#9733;</div>
                                    <?php      
                                }
                            }
                            ?><br>&nbsp;&nbsp;&nbsp;&nbsp;
                            Comment:&nbsp;<?php echo htmlentities($review->getComment())?><br>&nbsp;&nbsp;&nbsp;&nbsp;
                            Created at:&nbsp;<?php echo $review->getCreated_Time()?><br>
                        

                            
                    
                    
                    <?php
                        $counter=$counter+1;
                        }
                ?>
                </div>
               </div>