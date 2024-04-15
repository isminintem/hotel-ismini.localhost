
<?php

// boot the application
require_once __DIR__.'/../../boot/boot.php';


use \Services\UserService;
use \Services\Utils\JWTUtils;
use \data\Hotel\FavoriteDBA;



// $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
// echo json_encode($arr);




if(empty(UserService::getCurrentUser())) {
    echo "No current user for this operation";
    die;
}
$userId=UserService::getCurrentUser();

// return to homePage if it is not a POST invocation.I can not have redirect when i have an ajax request
if(strtolower($_SERVER['REQUEST_METHOD'])!='post'){
    echo "This a post script"; 
    die;
}


// chech if room_id is given
$roomId=$_REQUEST['room_id'];
if(empty($roomId)){
    echo"No room is given for this operation";
    die;
}





//set room to Favorites
$favoriteDBA=new FavoriteDBA();

//add or remove room from favorites
$isFavorite=$_REQUEST['is_favorite'];


if(!$isFavorite){
  $status=$favoriteDBA->addFavorite($roomId,$userId);
}else{
  $status=$favoriteDBA->removeFavorite($roomId,$userId);
}


//Return operation status
echo json_encode([
    'status' => $status,
    'is_favorite' =>!$isFavorite

]);

// header('Content-type:application/json');
// echo json_encode([
//     'status'=> $status,
//     'is_favorite'=>!$isFavorite
// ]);






?>