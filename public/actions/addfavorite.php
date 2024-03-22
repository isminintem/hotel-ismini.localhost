
<?php

// boot the application
require_once __DIR__.'/../../boot/boot.php';


use \Services\UserService;
use \Services\Utils\JWTUtils;
use \data\Hotel\FavoriteDBA;





if(empty(UserService::getCurrentUser())) {
    header("Location: /public/html/homepage.php");
}
$userId=UserService::getCurrentUser();

// return to homePage if it is not a POST invocation
if(strtolower($_SERVER['REQUEST_METHOD'])!='post'){
    header('Location: /public/html/index.php');

    return;
}


// chech if room_id is given
$roomId=$_REQUEST['room_id'];
if(empty($roomId)){
    header('Location: /public/html/index.php');

    return;
}




//set room to Favorites
$favoriteDBA=new FavoriteDBA();

//add or remove room from favorites
$isFavorite=$_REQUEST['is_favorite'];


if(!$isFavorite){
    $favoriteDBA->addFavorite($roomId,$userId);
}else{
    $favoriteDBA->removeFavorite($roomId,$userId);
}




return; 






?>