<?php
require_once __DIR__.'/../../boot/boot.php';

use \Services\UserService; 
use \data\Hotel\BookingDBA;
use \model\Hotel\BookingRooms;
use \data\Hotel\FavoriteDBA;
use \model\Hotel\FavoriteRoom;
use \data\Hotel\ReviewDBA;
use \model\Hotel\Review;
use \data\Hotel\RoomDBA;
use \model\Hotel\Room;

if(empty(UserService::getCurrentUser())) {
    header("Location: /public/html/homepage.php");
}

$userid=UserService::getCurrentUser();
$bookingDBA= new BookingDBA();
$bookingsRooms=$bookingDBA->getBookingsByUserID($userid);




$favoriteDBA=new FavoriteDBA();
$userFavorites=$favoriteDBA->getListByUser($userid);

$reviewDBA=new ReviewDBA();
$userReviews=$reviewDBA->getReviewByUserID($userid);





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
                <form action="homepage.html" method="get">
                    <a class="list-menu"href="index.php"target><img src="../images/Home.png">Home</a>
                </form>
                <form action="profile.php"method="get">
                    <a class="list-menu"href="profile.php"target><img src="../images/user.png">Profile</a>
                </form>  
            </section>                             
            <h2 class="headline">Hotels.com</h2>
            <section class="each-hotel">
                <hr class="hr-with-shadow">
        </header><br><br>
        <main>
            <nav class="navbar navbar-brick navbar fixed-top"role="navigation"></nav>    
            <div class="part">
                <h3 class="fav-title">FAVORITES</h3>
                <?php
                if(count($userFavorites)>0) {
                       
                ?>
                <ol class="list">
                    <?php
                        foreach($userFavorites as $userFavorite){
                    ?>            
                    <h3>
                        <li style=line-height:1;>
                            <h3>
                                <a class="favs"href="results.php?room_id=<?php echo $userFavorite->getRoom_ID();?>"><?php echo $userFavorite->getRoomName(); ?> </a>
                                <br><br><br>                     
                            </h3>
                        </li>
                    </h3>
                    <?php
                        }
                    ?>
                </ol>
                <?php
                  }
                  else{
                ?>
                 <h4 class="alert-profile">You don't have any Favorite Hotel!!!</h4>
                <?php
                  }
                ?>
                
                <h3 class="reviews-title">REVIEWS</h3>

            <?php
            if(count($userReviews)>0) {       
            ?>
            <ol class="list2">
                <?php
                    foreach($userReviews as $userReview){
                ?>           
                <h2 >
                    <li>
                        <h3>
                        <a class="review-items" href="results.php?room_id=<?php echo $userReview->getRoom_ID();?>"><?php echo $userReview->getName();?> </a>
                        <br>
                        <div class="title-reviews">
                        <?php 
                        $roomAvgReview = $userReview->getRate();
                        for($i=1; $i <=5; $i++) {
                            if ($roomAvgReview >=$i){
                                 ?>
                                 <div class="star checked" data-rating="">&#9733;</div>
                                 <?php
                            }else{
                                ?>
                                <div class="star" data-rating="">&#9733;</div>
                                <?php      
                            }
                        }
                        ?>
                      </div>
                                
                        </h3>
                    </li>
                </h2>
                <?php
                    }
                ?>
            </ol>
            
            <?php
                }
                else{
            ?>
                <h4 class="alert-profile">You don't have any Review!!!</h4>
            <?php
                }
            ?>
           
        </div>
            
    
    <aside class="hotel-search box">
        <section class="hotel-list box">
            <div class="page-title">
                <h2>My Bookings</h2>
            </div>
            
         

            
        <?php 
            foreach($bookingsRooms as $bookingRoom)
            {
                
        ?>   
        <article class="hotel">
            <img src=../images/rooms/<?php echo $bookingRoom->getPhoto_url()?>>
            <div class="brand"><?php echo $bookingRoom->getName()?></div>
            <div class="area"><?php echo $bookingRoom->getCity()?><?php echo $bookingRoom->getArea()?></div>
            <p><span class="roomdetails"><?php echo $bookingRoom->getDescription_short()?></span></p>
        
            <form action="results.html"method="post">
                <button type="submit" class="btn-room">Go to the Room Page</button><br><br><br> 
            </form>
            <div id="grid-container">
                <div id="areaA">Total Cost:<?php echo $bookingRoom->getTotal_Price()?>€</div>
                <div id="areaB">Check-in-Date:<?php echo $bookingRoom->getCheck_In_Date()?> Check-out-Date:<?php echo $bookingRoom->getCheck_Out_Date()?> Type of Room:<?php echo $bookingRoom->getTitle()?></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
            </div>
                        
        </article>
        <?php 
            } ?> 
            
            <?php
            if(count($bookingsRooms)==0) {
             ?>
             <h4 class="alert-profile">You don't have any booking!!!</h4> 
             <?php
            } 
            
         ?>           
    </section>
    </aside>

   
    
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
            <link rel="stylesheet" type="text/css"href="../css/css/profile.css"/>
            <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css">
            <script src="jquery-3.7.1.js"></script>
            <script src="jquery-ui-1.13.1.js"></script>
            <!-- <script src="../js/search.js"></script> -->
            <script>
                
            </script>
            
      
              
        </main>
        <footer>
            <p class="bg-body-tertiary text-center text-lg-start">(c) Copyright 2024</p>

        </footer> 
    </body>



</html>