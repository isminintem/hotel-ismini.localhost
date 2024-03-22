<?php

namespace Data\Hotel;

use PDO;
use ArrayObject;
use \model\Hotel\Favorite;
use \model\Hotel\FavoriteRoom;

class FavoriteDBA {
    private $pdo;

    public function __construct(){
        $this->pdo=new PDO('mysql:host=127.0.0.1;dbname=hotel;charset=UTF8','root','Filaki19!!!',[
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        ]);
    }

    protected function getPdo(){
        return $this->pdo;
    }

    function getAllFavorites(){
        $result=new ArrayObject();
        $statement=$this->getPdo()->query("SELECT*FROM favorite");
        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $favorite=Favorite::createFavorite($row);
            $result->append($favorite);
        }
        return $result;
    }
     function isFavorite($room_id,$user_id){
         $statement=$this->getPdo()->prepare("SELECT * FROM favorite WHERE room_id = :room_id AND user_id=:user_id");
         $statement->bindParam(':room_id', $room_id, PDO::PARAM_INT);
         $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
         $statement->execute();
         if($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            return Favorite::createFavorite($row);
         }         
     }


     function addFavorite($room_id,$user_id){
        $statement=$this->getPdo()->prepare("INSERT INTO favorite (room_id,user_id) VALUES(:room_id,:user_id)");
        $statement->bindParam(':room_id',$room_id,PDO::PARAM_INT);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
       
        
     }
     function removeFavorite($room_id,$user_id){
        $statement=$this->getPdo()->prepare("DELETE from favorite WHERE room_id=:room_id AND user_id=:user_id");
        $statement->bindParam(':room_id',$room_id,PDO::PARAM_INT);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();

        
     }
    function getListByUser($user_id){
        $result=new ArrayObject();
        $statement=$this->getPdo()->prepare(
        "SELECT  favorite.*,room.name 
        FROM favorite
        INNER JOIN room ON favorite.room_id=room.room_id
         WHERE  user_id=:user_id");
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $favorite=FavoriteRoom::createFavorite($row);
            $result->append($favorite);
        }

        return $result;

    }
}


