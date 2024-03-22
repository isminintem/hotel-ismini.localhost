<?php


	// session_start(); // start the session
	// session_destroy();// destroy all session data
	

	// // exit();
	// if (!isset($_COOKIE['user_id'])) {
	// 	header('Location: homepage.php');//Redirect to another page after logout


	//remove the cookie of the user
	if (isset($_COOKIE['user_token'])) {
		unset($_COOKIE['user_token']); 
		setcookie('user_token', '', -1, '/'); 
	}

	session_start();
	if(isset($_SESSION['user_id'])){
		session_destroy();
		header('location: /public/html/homepage.php');
	}
	else{
		header('location: /public/html/homepage.php');
	}
 ?>