<?php

//boot the application
require_once __DIR__.'/../../boot/boot.php';

use \Services\UserService;
use \Services\Utils\JWTUtils;

//return to home page if it is not a POST invocation
if(strtolower($_SERVER['REQUEST_METHOD'])!="post") {
    header('Location: /public/html/login.html');

    return;
}

//get the input parameters from the HTTP REQUEST that was submitted by the HTML form
$username = $_REQUEST['username'];
$email = $_REQUEST['exampleInputEmail1'];
$password = $_REQUEST['exampleInputPassword1'];

//get the User after registration (if user already exists, it will return the specific user)
$user = UserService::register($username, $email, $password);

if(empty($user)) { //if user is empty from the 'register' function, then the user was not created (because it was already existed) and we redirect to the same and we set a flag that the user already exists
    header('Location: /public/html/register.php?userexists=true' );
    

    return;
}

//generate a token that contains the user_id
$token = JWTUtils::generateToken($user->getUser_ID());

//and now set the 'user_token' cookie, so that the user id is passed to all our pages
setcookie('user_token', $token, time() + 60*60, '/');

header('Location: /public/html/index.php');

return; 










