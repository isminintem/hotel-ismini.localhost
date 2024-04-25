<?php
session_start();  //Start the session

require_once __DIR__.'/../../boot/boot.php';

use \Services\UserService;


if(!empty(UserService::getCurrentUser())) {
  header('Location: /public/html/index.php');
}else{
  if (empty($_SESSION['user'])){
    // header('Location: /public/html/register.php');
  }

}



// if(isset($_GET["userexists"])) {
//   echo "user already exists"."\n";
// }



?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport"content="width=device-width,initial-scale 1.0">
        <title></title>
    <link rel="stylesheet" type="text/css"href="../css/css/login.css"/>
    </head>
    <body>
        <header>
        <h3 class="logo">Hotels.com</h3>
        </header>
  <main>
    <p id="demo"></p>
    
      
    <section id="form-group">
    <div class="login">
    <form action="../actions/login_action.php"method="POST">
        <form>
            <h2 class="headline">Συνδέση με τον λογαριασμό σου</h2>
            <div class="form-group1"> 
              <label for="exampleInputEmail1">Email address</label><br>
              <input type="email" class="form-control"name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address"><br>
              <small id="emailHelp" class="text-danger email-error" hidden>Must be a valid email address.</small>
            </div>
            <div class="form-group1">
              <label for="exampleInputPassword1">Password</label><br>
              <input type="password" class="form-control"name="password" id="exampleInputPassword1" placeholder="Enter your password"><br>
              <small id="passwordHelp" class="text-danger password-error" hidden> Password must be more than 4 characters.</small>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <div class="button-sub">
            <button  onclick="submit" id="btn-sub" class="btn btn-primary">Sign in</button>
            <!--<button type="submit"  class="btn btn-primary">Login</button>-->

            </div>
          </form>
    </div>
    </section>
    <script src="../js/login.js"></script>   
  </main>

    
  <footer class="bg-light fixed-bottom text-center">
            <p class="rights">(c) Copyright 2024</p>
       

    </footer> 


  </body>
