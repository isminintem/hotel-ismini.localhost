<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// Register autoload function
spl_autoload_register(function ($class) {
	$class = str_replace("\\", "/", $class);
	//$class = str_replace("/", "\\", $class);
	//var_dump('spl_autoload_register:');
	//var_dump(sprintf(__DIR__.'/app/%s.php', $class));
    //require_once sprintf('app/%s.php', $class);
	require_once sprintf(__DIR__.'/../app/%s.php', $class);
});


use \Services\Utils\JWTUtils;
use \Services\UserService;

if(isset($_COOKIE['user_token'])) {
	$userToken = $_COOKIE['user_token'];

	if($userToken) {
		//verify user
		if(JWTUtils::verifyToken($userToken)) {
			$userInfo = JWTUtils::getTokenPayload($userToken);
			$user_id = $userInfo['user_id'];
			UserService::setCurrentUser($user_id);
		}
	}
}

