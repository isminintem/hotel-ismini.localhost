<?php

require_once __DIR__.'/../../boot/boot.php';

use \Services\UserService; 
use \data\Hotel\RoomDBA;
use \model\Hotel\Room;
use \data\Hotel\RoomTypeDBA;
use \model\Hotel\RoomType; 

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

?>


    <aside class="hotel-search box">
                    <section class="hotel-list box" id="searchResults">

                        <div class="page-title">
                             <h2>Search Results</h2>
                       </div>   
                <?php 
                    foreach($availableRooms as $availableRoom) {
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
                            <div id="areaA"><span class="price-label">Per Night:<?php echo $availableRoom->getPrice()?>€</span></div>
                            <div id="areaB">&nbsp;&nbsp;&nbsp;
                                <span class="guests-room">Count of Guests:<?php echo $availableRoom->getCount_of_guests()?>&nbsp;&nbsp;&nbsp;&nbsp;<span class="vertical-line"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                Type of Room:
                                <?php 
                                    foreach($roomTypes as $roomType) {
                                        if($roomType->getType_id()==$availableRoom->getType_id()) {
                                            echo $roomType->getTitle();
                                            break;
                                        }       
                                    } ?>
                                </span>
                         </div>  
                      </div>
               
                
                
                         
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
 
            