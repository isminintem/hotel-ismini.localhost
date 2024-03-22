<?php

// boot the application
require_once __DIR__.'/../../boot/boot.php';


use \Services\UserService;
use \Services\Utils\JWTUtils;

// return to homePage if it is not a POST invocation
if(strtolower($_SERVER['REQUEST_METHOD'])!='post'){
    header('Location: /public/html/login.php');

    return;
}
//get the input parameters from the HTTP REQUEST that was submitted by the HTML form
$email=$_REQUEST['email'];
$password=$_REQUEST['password'];





// returns true if user exists, otherwise, return false
$user=UserService::login($email,$password);


if(empty($user)){
    header('Location:/public/html/login.php?uservalid=false');

    return;
}


//generate a token that contains the user_id
$token=JWTUtils::generateToken($user->getUser_ID());

//and now set the 'user_token' cookie, so that the user id is passed to all our pages
setcookie('user_token',$token,time()+60*60*60,'/');
header('Location: /public/html/index.php');

return; 

