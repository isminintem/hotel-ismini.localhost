<?php

require_once __DIR__.'/../../boot/boot.php';

use \Services\UserService;

if(!empty(UserService::getCurrentUser())) {
  header("Location: /public/html/index.php");
}



?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport"content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/css/register.css"/>
        <title></title>

    </head>
    <body>
        <header>
          <div class="logo"><h2>Hotels.com</h2> </div>
        </header>
        <main>
            <section id="form-group">
              <div class="login">
            <form action='../actions/register_action.php' method="POST">
                    <h2 class="headline">Register Account</h2>
                    <!-- <p class="UserCheck">The email address is already associated with another account.Please use a different email address</p> -->
                               
                    <?php
                      if(isset($_GET["userexists"])) {
                        // echo "user already exists"."\n";
                      }
                    ?>

                    

                    <p class="help">Please fill in this form to create an account.</p>
                  <div class="control-group">
                    <label class="control-label"  for="username">Username</label>
                    <div class="controls">
                      <input type="text" id="username" name="username" placeholder="Enter your username" class="input-xlarge">
                      <small id="nameHelp" class="text-danger name-error" hidden><br/>Minimum chars or digits.</small>
                      <!-- <p class="help-block">Username can contain any letters or numbers, without spaces</p> -->
                    </div>
                  </div>
               
                  <div class="control-group">
                    <label class="control-label" for="exampleInputEmail1">E-mail</label>
                    <div class="controls">
                    <input type="email" class="form-control" id="exampleInputEmail1" name="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address"><br>
                    <small id="emailHelp" class="text-danger email-error" hidden>Must be a valid email address.</small>
                      <!-- <p class="help-block">Please provide your E-mail</p> -->
                    </div>
                  </div>
               
                  <div class="control-group">
                    <label class="control-label" for="email_confirm">E-mail(Repeat)</label>
                    <div class="controls">
                    <input type="email" class="form-control" id="email_confirm" aria-describedby="emailHelp" placeholder="Repeat your email address"><br>
                    <small id="emailHelp" class="text-danger email-error" hidden>Must be a valid email address.</small>
                      <!-- <p class="help-block">Password should be at least 4 characters</p> -->
                    </div>
                  </div>
                  <div class="control-group">
                    <div class="controls">
                    <label for="exampleInputPassword">Password</label><br>
                    <input type="password" class="form-control" id="exampleInputPassword1" name ="exampleInputPassword1" placeholder="Enter your password"><br>
                    <small id="passwordHelp" class="text-danger password-error" hidden> Password must be more than 4 characters.</small>
                      <!-- <p class="help-block">Please confirm password</p> -->
                    </div>
                  </div><br>
               
                  <div class="control-group">
                    <div class="controls">
                    <button  class="btn btn-primary" id="sub-btn">Register</button>
                    <p>Already have an account? <a href="/public/html/login.php">Sign in</a>.</p>
                    </div>
                  </div>
              </form>
              </div>
            </section>
        <script src="../js/register.js"></script>
        </main>
        <footer>
            <p>(c) Copyright 2023</p>

        </footer>
    </body>
</html>



     