<?php

require_once __DIR__.'/../../boot/boot.php';

use \Services\UserService; 
use \data\Hotel\RoomDBA;
use \model\Hotel\Room;
use \data\Hotel\RoomTypeDBA;
use \model\Hotel\RoomType;
use \data\Hotel\BookingDBA;
use \model\Hotel\BookingRooms; 

if(empty(UserService::getCurrentUser())) {
  header("Location: /public/html/homepage.php");
}

$selectedGuests = '';
$selectedPriceMin = '';
$selectedPriceMax = '';

//check if this parameter exists from the URL REQUEST (i.e. if this page arrives from the index.php, then these variables are not presented in the URL)
//for this, we always need to check if the parameter exists, using the 'isset' function of php
if(isset($_REQUEST['guests'])) {
    $selectedGuests = $_REQUEST['guests'];
}
if(isset($_REQUEST['pricemin'])) {
    $selectedPriceMin = $_REQUEST['pricemin'];
}
if(isset($_REQUEST['pricemax'])) {
    $selectedPriceMax = $_REQUEST['pricemax'];
}

//these parameters will always have to exist, as they are included in the URL from both the index.php and the search.php page
$selectedCity = $_REQUEST['city'];
$selectedRoomType = $_REQUEST['roomType'];
$selectedCheckinDate = new DateTime($_REQUEST['check-in-date']);
$selectedCheckoutDate = new DateTime($_REQUEST['check-out-date']);



$roomTypeDBA=new RoomTypeDBA();
$roomTypes= $roomTypeDBA->getAllRoomTypes();

$roomDBA = new RoomDBA();
$count_of_guests=$roomDBA->getAllGuests();
$cities = $roomDBA->getAllCities();
$availableRooms = $roomDBA->getAvailableRooms($selectedRoomType, $selectedCity, $selectedCheckinDate, $selectedCheckoutDate, $selectedGuests, $selectedPriceMin, $selectedPriceMax);

$userid=UserService::getCurrentUser();
$bookingDBA= new BookingDBA();
$bookingsRooms=$bookingDBA->getBookingsByUserID($userid);


?>


<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    <meta name="viewport"content="width=device-width,initial scale=1.0">
    <head>
    <style>body{
    background-color: whitesmoke;
   }
   </style>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
            <link rel="stylesheet" type="text/css"href="../css/css/search.css"/>
            <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css">
            <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
            <script src="../js/jquery-3.7.1.js"></script>
            <script src="../js/jquery-ui-1.13.1.js"></script>
            <script src="../js/search.js"></script>
            <script src="../pages/search.js"></script>
    </head>
   
   
   <body>
        <div class="wrapper">

            <header>
                <section class="access">
                    <form action="homepage.html" method="get">
                        <a class="list-menu"href="homepage.php"target><img src="../images/Home.png">Home</a>    
                    </form>
                    <form action=""method="get">
                        <a class="list-menu"href="profile.php"target><img src="../images/user.png">Profile </a>
                    </form>             
                </section>
                <h2 class="logo">Hotels.com</h2>     
                <hr class="hr-with-shadow">
            </header><br><br>

                             
            <main>
                <aside class="part">
                <form name ="searchForm"class="searchForm" action="search.php" >
               
                    <p class="headline">FIND THE PERFECT<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HOTEL</p><br><br>
           
                <section class="hero">
                    <div class="content">

                   

                        <select name="guests"class="capacity" data-placeholder="Count of Guests">
                            <option value="">Count of Guests</option>
                            <?php
                                foreach($count_of_guests as $count_of_guest) {
                            ?>        
                            <option <?php if($selectedGuests==$count_of_guest['count_of_guests']){
                                echo "selected=true";
                            }
                           ?>
                            value="<?php echo $count_of_guest['count_of_guests'] ?>"> <?php echo $count_of_guest['count_of_guests'] ?> </option>
                            <?php
                        }                              
                            ?>
                        </select><br><br>
                        <select name="roomType"class="rooms" data-placeholder="RoomType">
                            <option value="">Room Type</option>
                            <?php
                                foreach($roomTypes as $roomType) {
                            ?>
                            <option <?php if($selectedRoomType==$roomType->getType_id()) {
                               echo "selected=true";
                            }
                            ?>
                            value="<?php echo $roomType->getType_id()?>"><?php echo $roomType->getTitle()?></option>
                            <?php           
                            }
                        ?>       
                        </select><br><br>


                        <select name="city"class="location" data-placeholder="City">
                            <option value="">Select city</option>
                            <?php
                                foreach($cities as $city) {
                            ?>        
                            <option <?php if($selectedCity==$city['city']) { 
                                echo "selected=true";
                            }                                
                            ?>
                            value="<?php echo $city['city'] ?>"><?php echo $city['city'] ?></option>
                            <?php
                            }
                            ?>
                        </select>  
                  </div>
              </section>

                <div class="expenses">
                    <h3>Your budget(per night) </h3>
                </div>
          
                <div class="form_control_container" id="prices">
                    <input name="pricemin"  type="number" class="sliderValue"id="fromInput" data-rangeslider data-index="0" value="0"/>
                    <input name="pricemax" type="number" class="sliderValue"id="toInput"data-rangeslider data-index="1" value="500" />
                </div> 

                
                <div class="slider-container">

                    <input type="range" min="0" max="500" value="" class="slider" id="myRange"><br>
                    <span class="slider-label">PRICE MIN.</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="slider-label">PRICE MAX.</span>
                </div><br>

                <script>
                    document.getElementById('myRange').addEventListener('input', function() {
                    var rangeValue = this.value;
                    document.getElementById('toInput').value = rangeValue;
                    });
                </script>
                
                
                <div class="duration">
               
                    <input type="text" class="form-control_landing"  id="datepicker-start" value="<?php echo $selectedCheckinDate->format("Y-m-d") ?>"  name="check-in-date"  placeholder="Check-in-Date">
                            <p type="text" id="check-in-date error"class="text-danger"></p>
                    <input type="text" class="form-control_landing"  id="datepicker-end"   value="<?php echo $selectedCheckoutDate->format("Y-m-d")?>"  name="check-out-date" placeholder="Check-out-Date">        
                            <p type="text"id="check-out-date error"class="text-danger"></p>  
                </div>

                   
                <div class="btnSearch">
                   <button onclick="">Find Hotel</button>
                </div>
                </form>
                   
            </div>

            <script type="text/javascript">

                $(function(){
                    $("#datepicker-start").datepicker({
                        dateFormat:"yy-mm-dd"
                      });
                    });
                $(function(){
                    $("#datepicker-end").datepicker({
                        dateFormat:"yy-mm-dd"
                     });
                    });          
            </script>
                </aside>
                <!-- <div class="vertical-line left"></div>  -->

                <aside class="hotel-search box">
                    <section class="hotel-list box" id="searchResults">

                        <div class="page-title">
                             <h2>Search Results</h2>
                       </div>   
                <?php 
                    foreach($availableRooms as $availableRoom) {
                   
                ?>
                 <?php 
                    foreach($bookingsRooms as $bookingRoom)
                    {
                        
                ?>  
                
                    <article class="hotel">
                        <img src=../images/rooms/<?php echo $availableRoom->getPhoto_url()?>>
                        <div class="brand"><?php echo $availableRoom->getName() ?> </div> 
                            <div class="area"><?php echo $availableRoom->getCity()?>,<?php echo $availableRoom->getArea()?></div>
                            <p><span class="roomdetails"><?php echo $availableRoom->getDescription_short()?></span></p>
                            <form action="results.php?room_id=<?php echo $availableRoom->getRoom_id() ?>&check-in-date=<?php echo $selectedCheckinDate->format("Y-m-d") ?>&check-out-date=<?php echo $selectedCheckoutDate->format("Y-m-d") ?>"  method="post">
                                <button onclick="btn btn-warning">Go to the room</button> 
                            </form>
                    </article> 
                    
                        <div id="grid-container">
                            <div id="areaA">Per Night:<?php echo $availableRoom->getPrice()?>€</div>
                            <div id="areaB">Count of Guests:<?php echo $availableRoom->getCount_of_guests()?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Type of Room:<?php echo $bookingRoom->getTitle()?></div>  
                      </div>
               
<!--                    
                <?php
                    }
                ?> -->
                
                         
                <?php
                    }
                ?>
 
                <?php if($availableRooms->count()==0) { 
                 ?>
                        <h2>No rooms available</h2>
                <?php
                    }
                ?>
                
                

                    </section>
                </aside>
              
            </main>
                
    
     </div>
     <footer>
        <div class="footer-main">
            <p class="rights">(c) Copyright 2024</p>
        </div>

    </footer> 
 
   </body>

   

</html>