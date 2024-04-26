<?php

require_once __DIR__.'/../../boot/boot.php';

use \Services\UserService; 
use \data\Hotel\RoomDBA;
use \model\Hotel\Room;
use \data\Hotel\ReviewDBA;
use \model\Hotel\Review;
use \data\Hotel\BookingDBA;
use \model\Hotel\Booking;
use \model\Hotel\User;
use \data\Hotel\UserDBA;
use \data\Hotel\FavoriteDBA;
use \model\Hotel\Favorite;

if(empty(UserService::getCurrentUser())) {
    header("Location: /public/html/homepage.php");
  }

$selectedRoomID = $_REQUEST['room_id'];

//by default, set the checkin/checkout dates to now
$selectedCheckinDate = new DateTime();
$selectedCheckoutDate = new DateTime();

//however, if the checkin/checkout dates are included in the request (i.e. we land in this page from the search.php) 
//then set these values from these parameters
if(isset($_REQUEST['check-in-date'])) {
    $selectedCheckinDate = new DateTime($_REQUEST['check-in-date']);
}
if(isset($_REQUEST['check-out-date'])) {
    $selectedCheckoutDate = new DateTime($_REQUEST['check-out-date']);
}
//Check for Booking Room
$bookings= empty ($selectedCheckinDate)||empty($selectedCheckoutDate);
if(!$bookings){
  
 //Look For Bookings
 $bookingDBA=new BookingDBA();
 $bookings=$bookingDBA->getBookingsByRoomIDByDate($selectedRoomID,$selectedCheckinDate,$selectedCheckoutDate);
}


$roomDBA=new RoomDBA();
$selectedRoom = $roomDBA->getRoomByID($selectedRoomID);


$reviewDBA=new ReviewDBA();
$reviewsOfRoom=$reviewDBA->getUserReviewByRoomId($selectedRoomID);

 

$favoriteDBA= new FavoriteDBA();
$favorite=$favoriteDBA->isFavorite($selectedRoomID,UserService::getCurrentUser());

?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport"content="width=device-width,initial-scale 1.0">
        <title>
        </title>
    </head>
    <body>
            <header>
            <section class="access">
                <div class="dropdown">
                    <a class="list-menu" href="profile.php" id="profile-link" target><img src="../images/user.png">Profile</a>
                    <div class="dropdown-content">
                        <a class="list-menu" href="../actions/logout_action.php"id="logout-link" target>Logοut</a>
                    </div>
                </div>
            </section>
            <section class="access">
                <form action="index.php"method="post">
                    <a class="list-menu" href="index.php"target><img src="../images/Home.png">Home</a>
                    
                </form>
                
           </section> 

            
                <h3 class="logo">Hotels.com</h3>     
                <hr class="hr-with-shadow">
            </header><br><br>
            <main>
                <div class="grid-container1">
                    <div class="details"><?php echo $selectedRoom->getName()?>-<?php echo $selectedRoom->getCity()?>&nbsp;<?php echo $selectedRoom->getAddress()?>-<?php echo $selectedRoom->getArea()?> </div>
                    <div class="reviews">Reviews: </div>
                    <span class="title-reviews">
                        <?php $roomAvgReview = $selectedRoom->getAvg_reviews();
                        for($i=1; $i <=5; $i++) {
                            if ($roomAvgReview >$i){
                                 ?>
                                 <div class="star selected" data-rating="">&#9733;</div>
                                 <?php
                            }else{
                                ?>
                                <div class="star" data-rating="">&#9733;</div>
                                <?php      
                            }
                        }
                        ?>
                     </span>
                     <div class="favoriteHeart"id="favorite">
                     <form name="favoriteForm"class="favoriteForm" method="post" id="favoriteForm" action="../actions/addfavorite.php">
                        <input type="hidden"name="room_id"value="<?php echo $selectedRoomID; ?>">
                        <input type="hidden"name="is_favorite"value="<?php echo $favorite ? "1":"0";?>">
                        <input type="checkbox"<?php echo  $favorite ? "checked=/checked":""; ?> id="heart">
                        <label for="heart"class="heart-label">&#9829;</label>
                        
                    
                        
                        
                        <!-- <div class="search_stars">
                            <span class="fav-star">
                                <span class="star<?php echo $favorite ? 'selected':'';?>"id="fav">🤍</span>
                            </span>
                        </div> -->
                       
                    </form>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                        var form = document.getElementById('favoriteForm');
                        var heartCheckbox = document.getElementById('heart');

                        heartCheckbox.addEventListener('change', function() {
                            var formData = new FormData(form);

                            // Make an AJAX call
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '../actions/addfavorite.php', true);
                            xhr.onload = function() {
                                if (xhr.status >= 200 && xhr.status < 400) {
                                    // Redirect to the same page after successful AJAX call
                                    window.location.href = window.location.href;
                                } else {
                                    // Handle error if needed
                                    console.error('Error:', xhr.status);
                                }
                            };
                            xhr.onerror = function() {
                                // Handle error if needed
                                console.error('Error: Network request failed');
                            };
                            xhr.send(formData);
                        });
                    });
                        
                    </script>
                   
                    

                    <span class="price">Per Night:€<?php echo $selectedRoom->getPrice()?></span>
                            
                  
                </div>
             

                <div class="image-room">
                    <img src=../images/rooms/<?php echo $selectedRoom->getPhoto_url()?>> <br><br><br>
                </div>
             
              

                <div class="grid-container">
                    <table>
                        <thead class="options">
                            <tr>
                                <td class="guests"><img src="../images/person.png"><?php echo $selectedRoom->getCount_of_guests()?><br> Count of Guests</td>
                                <td class="roomtype"><img src="../images/RoomType.png"><?php echo $selectedRoom->getType_id()?><br>Type of Room</td>
                                <td> <span class="parking">
                                    <img src="../images/parking-space.png">
                                    <?php
                                        if($selectedRoom->getParking()==1){
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                    ?><br>Parking&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>

                                <td ><span class="animals">
                                    <img src="../images/pet.png">
                                    <?php
                                        if($selectedRoom->getPet_Friendly()==1) {
                                            echo "Yes";
                                        }else{
                                            echo "No"; 
                                        }
                                    
                                    ?><br>Pet Friendly</span>&nbsp;&nbsp;&nbsp;</td>                                    
                                <td ><span class="internet">
                                    <img src="../images/internet.png">
                                    <?php
                                        if($selectedRoom->getWifi()==1) {
                                            echo "Yes";
                                        } else {
                                            echo "No";
                                        }
                                    ?><br>&nbsp; WiFi</span></td>
                            </tr>
                        </thead>    
                    </table>
                </div><br>
                <hr class="roomDetails">
                <div class="caption">
                    <div class="roomReviews"><strong>Room Description </strong></div>
                    <div class="vertical-lineRoom"></div>
                    <span class="description"><?php echo $selectedRoom->getDescription_long()?></span>

                </div>
                <div class=links>
                <?php if($bookings->count()==0){
                            // echo "Book now";
                ?>
                            <form name="bookingForm" method="post" action="../actions/addbooking.php">
                                <input type="hidden" name="room_id"value="<?php echo $selectedRoomID;?>">
                                <input type="hidden" name="check_in_date"value="<?php echo $selectedCheckinDate->format(DateTime::ATOM);?>">
                                <input type="hidden" name="check_out_date"value="<?php echo $selectedCheckoutDate->format(DateTime::ATOM);?>">
                                <button class="btn-booking"type="submit">Book Now</button>
                            </form>
                <?php
                            }else{
                                $notice = "Sorry!!The room is no longer available!"; 

                                if (isset($notice) && !empty($notice)) {
                                    echo '<div style="background-color: #ffffcc;width:320px; padding: 10px; margin-bottom: 10px;">';
                                    echo '<strong>Notice:</strong> ' . $notice;
                                    echo '</div>';
                                }
                        }       
                ?> 
                </div>

                <br><br><br>        
                             
                <iframe class="googleMaps"
                src="//maps.google.com/maps?q=<?php  echo $selectedRoom->getLocation_lat() ?>,<?php  echo $selectedRoom->getLocation_long() ?>&z=15&output=embed"
                width="1080"
                height="450"
                style="border:0;"
                allowfullscreen=""
                oading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
                </iframe><br>

                <!-- <hr class="lineReview"> -->
                <div class="totalReviews">
               
                <h4 class="reviews">Reviews</h4>
                <div id="room-reviews-container">   
                <?php
                $counter=1;
                    foreach($reviewsOfRoom as $review) {                        
                    ?>
                    
                        <span><?php echo $counter?>.&nbsp;</span> 
                            <?php echo $review->getUserName()?>&nbsp;&nbsp; 
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
                      
                      
            <div class="caption caption room">
                <h3 class="newReview">Add Review</h3>
                <!-- <div id="rating_Stars"> -->
                    <!-- Create the star icons -->
                    <!-- <?php for ($i = 1; $i <= 5; $i++) { ?>
                        <span class="star1" data-rating="<?php echo $i; ?>">&#9733;</span>
                    <?php } ?> -->
                <!-- </div> -->
               
                <form name="reviewForm" class="reviewForm"method="post"action="../actions/addReview.php">
                <input type="hidden"name="room_id"value="<?php echo $selectedRoomID?>">
                        <div class="ratingStars">
                            <input type="radio" id ="star5"name="rate"rate="5" value="5">
                            <label class="full"for="star5"title="Awesome-5 stars">&#9733;</label>
                            <input type="radio" id ="star4"name="rate"rate="4" value="4">
                            <label class="full"for="star4"title="Very good-4 stars">&#9733;</label>
                            <input type="radio" id ="star3"name="rate"rate="3"  value="3">
                            <label class="full"for="star3"title="Nice-3 stars">&#9733;</label>
                            <input type="radio" id ="star2"name="rate"rate="2" value="2">
                            <label class="full"for="star2"title="Bad-2 stars">&#9733;</label>
                            <input type="radio" id ="star1"name="rate"rate="1" value="1">
                            <label class="full"for="star1"title="Very Bad-1 stars">&#9733;</label>
                            
                        </div>
                        <br><br>
                        
                    <div class="floating-label-form-group-controls">
                        <textarea name="comment"id="reviewField"class="form-control_landing review-textarea"
                        placeholder="Review" data-validation-required-message="Please enter a review here"></textarea>

                    </div>
                    <div class="form-group_landing">
                        <button class="btn_landing btn-brick"type="submit">Submit</button>

                    </div>
                </form>
                   </div>
            </div> 
                  <script>
                window.addEventListener('load', function() {
                    function updateVerticalLinePosition() {
                        var totalReviewsElement = document.querySelector('.totalReviews');
                        var lineReviewElement = document.querySelector('.lineReview');
                        
                        // Get the position of the totalReviews element relative to the viewport
                        var totalReviewsPosition = totalReviewsElement.getBoundingClientRect().top;
                        
                        // Set the top position of the vertical line relative to the totalReviews element
                        lineReviewElement.style.top = (totalReviewsPosition - 10) + 'px'; // Adjust as needed
                    }

                    // Call the function initially and whenever content changes
                    updateVerticalLinePosition();
                    
                    // You can also call updateVerticalLinePosition() when content changes to dynamically adjust the position of the line.
                    });
                    // Function to add new data
                            function addNewData() {
                            // Simulate adding new data (for demonstration purposes)
                            var newData = document.createElement('div');
                            newData.textContent = 'New Data';
                            document.querySelector('.container').appendChild(newData);
                            
                            // After adding new data, update the position of the line
                            updateLinePosition();
                            }

                            // Function to delete data
                            function deleteData() {
                            // Simulate deleting data (for demonstration purposes)
                            var container = document.querySelector('.container');
                            if (container.lastElementChild) {
                                container.removeChild(container.lastElementChild);
                                
                                // After deleting data, update the position of the line
                                updateLinePosition();
                            }
                            }

                            // Add event listener to the button to trigger adding new data
                            document.getElementById('addDataBtn').addEventListener('click', addNewData);

                            // Add event listener to the button to trigger deleting data
                            document.getElementById('deleteDataBtn').addEventListener('click', deleteData);

                            // Call the function initially to set the initial position of the line
                            updateLinePosition();
  
                  </script>




                <link rel="stylesheet"type=text/css href="../css/css/results.css">
                <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
                <script src="../js/results.js"></script>
                <script src="../js/jquery-3.7.1.js"></script>
                <script src="../js/jquery-ui-1.13.1.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
                <script src="../pages/room_Favorite.js"></script>    
                <script src="../pages/room_review.js"></script>
                <script src="../js/dropdown-links.js"></script>     
            </main>

            
            <footer>
                <p class="bg-body-tertiary text-center text-lg-start">(c) Copyright 2024</p>
            </footer> 
    </body>
</html>