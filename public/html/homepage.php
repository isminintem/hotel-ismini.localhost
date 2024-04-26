<?php

require_once __DIR__.'/../../boot/boot.php';

// use \Services\UserService;

// if(!empty(UserService::getCurrentUser())) {
//     header("Location: /public/html/index.php");
//   }

//use Services\Utils\Configuration;

//$config = Configuration::getInstance();
//var_dump($config->getDataBasePassword());

//die;

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport"content="width=device-width,initial-scale 1.0">
        <title>Hotels.com</title>
        <link rel="stylesheet" type="text/css"href="../css/css/homepage.css"/>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css"> 
        <script src="../js/homePage.js"></script>
        <script src="../js/jquery-3.7.1.js"></script>
        <script src="../js/jquery-ui-1.13.1.js"></script>   
    </head>
    <body>     
        <header>
            <section class="access">
                <form action="login_action.php" method="post">
                    <a class="list-menu"href="login.php"target><img src="../images/login.png">&nbsp;Login</a>         
            </form>
           </section>
           
           <section class="access">
                <form action="register_action.php"method="post"> 
                    <a class="list-menu"href="register.php"target><img src="../images/register.png">&nbsp;Register</a>
                  
                </form>          
            </section>
            <h3 class="headline">Hotels.com</h3>
            <div class="quote-container">
                <h3 class="quote">To Travel is To Live.&nbsp;&nbsp;Find Now The Ideal Hotel For You!!!</h3>
           </div>
            <section class="hero">
                <style> main {
            /* background: #fff;
            color: #000; */
            background-image: url("../images/background img.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-color:black;

            position: fixed;
            width:100%;
            height: 495px;
            left: 50%;
            right:50%;
            top: 55%;
            transform: translate(-50%, -50%);
        }
                
                </style>
            </section>
             
            
        </header>
        <main>
            
           
            
          
        </main>
        <footer>
            <p>(c) Copyright 2024</p>
        </footer>
    </body>
    

   
</html>
 