<?php

namespace data\Hotel;

use PDO;
use ArrayObject;
use \model\Hotel\Review;
use \model\Hotel\UserReview;

class ReviewDBA {
    private $pdo;
    public function __construct(){
        $this->pdo=new PDO('mysql:host=127.0.0.1;dbname=hotel;charset=UTF8','root','Filaki19!!!',[
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        ]);
    }

    protected function getPdo(){
        return $this->pdo;
    }

    function getAllReviews(){
        $result= new ArrayObject();
        $statement=$this->getPdo()->query("SELECT*FROM review");
        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $review=Review::createReview($row);
            $result->append($review);
        }
        return $result;
    }

    function getUserReviewByRoomId($room_id){
        $result= new ArrayObject();
        $statement=$this->getPdo()->prepare("SELECT review.*, room.name as 'room_name', user.name as 'user_name' 
         FROM review 
         INNER JOIN room ON review.room_id=room.room_id
         INNER JOIN user ON review.user_id=user.user_id
         WHERE room.room_id=:room_id ");
        $statement->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $statement->execute();
        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $review=UserReview::createUserReview($row);
            $result->append($review);
        }
        return $result;
    }



    function getReviewByUserID($user_id){
        $result= new ArrayObject();
        $statement=$this->getPdo()->prepare(
        "SELECT review.*,room.name 
         FROM review 
         INNER JOIN room ON review.room_id=room.room_id
         WHERE  user_id=:user_id ");
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $review=Review::createReview($row);
            $result->append($review);
        }
        return $result;
    }
    // function getReviewByUserName($user_id){
    //     $result= new ArrayObject();
    //     $statement=$this->getPdo()->prepare(
    //     "SELECT  `review`.* ,user.name
    //      FROM review
    //      JOIN user ON review.user_id=user.user_id");
    //     $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    //     $statement->execute();
    //     while($row=$statement->fetch(PDO::FETCH_ASSOC)){
    //         $review=Review::createReview($row);
    //         $result->append($review);
    //     }
    //     return $result;
    // }





    function addReview($room_id,$user_id,$rate,$comment){
        //Start Transaction
        $this->getPdo()->beginTransaction();
        
        $statement=$this->getPdo()->prepare("INSERT INTO review (room_id, user_id, rate, comment) VALUES (:room_id, :user_id, :rate, :comment)");
        $statement->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindParam(':rate', $rate, PDO::PARAM_INT);
        $statement->bindParam(':comment', $comment, PDO::PARAM_STR);
        $statement->execute();
        

        $statement = $this->getPdo()->prepare("SELECT AVG(rate) as 'avg_review', COUNT(rate) as 'count_rate' FROM review WHERE room_id=:room_id");
        $statement->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $statement->execute();
        $avg_reviews;
        $count_reviews;
        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $avg_reviews = $row["avg_review"];
            $count_reviews=$row["count_rate"];
        }
        
        
        $statement=$this->getPdo()->prepare("UPDATE room SET avg_reviews=:avg_reviews,count_reviews=:count_reviews WHERE room_id=:room_id");
        $statement->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $statement->bindParam(':avg_reviews', $avg_reviews, PDO::PARAM_STR);
        $statement->bindParam(':count_reviews', $count_reviews, PDO::PARAM_INT);
        $statement->execute();

        //Commit Transaction
         $this->getPdo()->commit();


    }
    
        
    
        
       
    
    


}


