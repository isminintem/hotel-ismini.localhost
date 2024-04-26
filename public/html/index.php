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

$roomDBA = new RoomDBA();
$cities = $roomDBA->getAllCities();

$roomTypeDBA=new RoomTypeDBA();
$roomTypes= $roomTypeDBA->getAllRoomTypes();

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport"content="width=device-width,initial-scale 1.0">
        <title>Hotels.com</title>
        <link rel="stylesheet" type="text/css" href="../css/css/styles.css"/>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script> 
        <script src="../js/dropdown-links.js"></script> 
        <script src="../js/index.js"></script>

        
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
  
            
           
            <h3 class="headline">Hotels.com</h3>
            <section class="hero">
                <style> main {
                background: #fff;
                color: #000;
                background-image: url("../images/background img.jpg");
                background-repeat: no-repeat;
                background-position: top;
                background-size:cover; 
                padding: 600px;
                margin-left:-8px;
                margin-top:-22px;
            };
                </style>
            </section> 
       
          
            
        </header>
        <main>
            
            <form name="SearchForm" id="myForm" action="search.php" method="get" >
                <section id="form-group">
                    
                    <div class="search-rooms" >
                        <select name="city"class="location"id="location" data-placeholder="City">
                            <option value="">Select city</option>
                            <?php
                                foreach($cities as $city) {
                            ?>        
                                <option value="<?php echo $city['city'] ?>"><?php echo $city['city'] ?></option>
                            <?php
                                }
                            ?>
                        </select>       
                        <select name="roomType"class="rooms"id="room" data-placeholder="RoomType">
                            <option value="">Room Type</option>
                            <?php
                                foreach($roomTypes as $roomType) {
                            ?>
                                <option value="<?php echo $roomType->getType_id()?>"><?php echo $roomType->getTitle()?></option>
                            <?php            
                                }
                            ?>       
                        </select>
                
                        
                                    
                        
                        <div class="duration">
                            <input type="text" class="form-control_landing"  id="datepicker-start"autocomplete="off" value=""  name="check-in-date"  placeholder="Check-in-Date">
                            <input type="text" class="form-control_landing"  id="datepicker-end" autocomplete="off"  value=""  name="check-out-date" placeholder="Check-out-Date"><br><br>
                        
                                <p type="text" id="check-in-date error"class="text-danger"></p>
                                <p type="text"id="check-in-date error"class="text-danger"></p>  
                        </div>
                    
                            <div class="btn-search">
                                <button class="search"id="btn-sub">Search</button>
                            </div>
                            
                    </form>
                        </div>
                        
                    </div>
                    <script type="text/javascript">
                    $(document).ready(function() {
                            // Initialize the datepickers
                            $("#datepicker-start").datepicker({
                                dateFormat: "yy-mm-dd",
                                minDate:0
                            });

                            $("#datepicker-end").datepicker({
                                dateFormat: "yy-mm-dd",
                                minDate:0
                            
                            });
                        });
                        
                    </script>
                    
                    
                </section>
            </form>
            
         
            
        </main>
        <footer>
            <p>(c) Copyright 2024</p>
        </footer>
    </body>
    

   
</html>
