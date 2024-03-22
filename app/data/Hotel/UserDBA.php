<?php

namespace Data\Hotel;

use PDO;
use ArrayObject;
use \Model\Hotel\User;

class UserDBA {

    private $pdo;
    
    public function __construct() {
       $this->pdo=new PDO('mysql:host=127.0.0.1;dbname=hotel;charset=UTF8','root', 'Filaki19!!!', [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        ]);
    }

    protected function getPdo() {
        return $this->pdo;
    }

    function getUserByEmail($email){
        $statement=$this->getPdo()->prepare("SELECT * FROM user WHERE email=:email");
        $statement->bindParam(':email',$email,PDO::PARAM_STR);
        $statement->execute();
        while($row=$statement->fetch(PDO::FETCH_ASSOC)) {
            return User::createUser($row);
        }
    }



    function getUserByUserId($user_id){
        $statement=$this->getPdo()->prepare("SELECT * FROM user WHERE user_id=:user_id");
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            return User::createUser($row);
        }
    }
    
    

    
    function getAllUsers() {
        $result = new ArrayObject(); //create an empty array to collect the results
        $statement = $this->getPdo()->query("SELECT * FROM user"); //executes the query
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { //get each row of the result
           $user = User::createUser($row); //creates a new object of the User class
           $result->append($user);  //and adds it to the array of the results
        }
        return $result;
     }

     

     function addNewUser($newusername, $newemail,  $newpassword) {
         //$newPreparedStatement = $this->getPdo()->prepare("INSERT INTO user (name, email, password) VALUES (?,?,?)");
         //$newPreparedStatement->execute([$newusername,$newemail,$newpassword, ]);
         $encryptedPassword = password_hash($newpassword, PASSWORD_BCRYPT);
         $newPreparedStatement = $this->getPdo()->prepare("INSERT INTO user (name, email, password) VALUES (:name, :email, :password)");
         $newPreparedStatement->bindParam(':name', $newusername, PDO::PARAM_STR);
         $newPreparedStatement->bindParam(':email', $newemail, PDO::PARAM_STR);
         $newPreparedStatement->bindParam(':password', $encryptedPassword, PDO::PARAM_STR);
         $newPreparedStatement->execute();
         
         return $this->getPdo()->lastInsertId();
     }

     
     function updatepassword($username,$password) {
         echo "I will update now a user"."<br />\n";
         $updateStatement=$this->getPdo()->prepare("UPDATE user SET password=? WHERE name=?");
         $updateStatement->execute([$password, $username]);
         echo "New user has been updated"."<br />\n";
     }


    function deleteUser($username,$password){
        echo "I will delete a user"."<br />\n";
        $deleteStatetment=$this->getPdo()->prepare("DELETE FROM user WHERE name=? AND password=?");
        $deleteStatetment->execute([$username,$password]);
        echo"User has been deleted"."<br />\n";
    }
}
