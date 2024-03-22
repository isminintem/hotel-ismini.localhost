<?php
namespace services;
use \model\Hotel\User;
use \data\Hotel\UserDBA;


class UserService {

    private static $currentUser;

    static function setCurrentUser($user) {
        UserService::$currentUser = $user;
    }

    static function getCurrentUser() {
        return UserService::$currentUser;
    }


    /*
    * It adds a new user.
    * It first check if the user already exist, if yes, then it will return an empty user
    * If it does not exist, then it creates a new one and returns the newly creted user
    */
    public static function register($username, $email, $password) {
        $userdba = new UserDBA();
        $user = $userdba->getUserByEmail($email);
        


        if(!$user) { //user does not exist
            $id = $userdba->addNewUser($username, $email, $password); //add new user
            $user = $userdba->getUserByUserId($id); //and get the whole info from the user
        } else { //now user exists
            return; //return an empty user
        }

        UserService::setCurrentUser($user->getUser_ID());
        
        return $user; //return the newly created user 
    }

    public static function login($email, $password){
        $userdba=new UserDBA();
        $user=$userdba->getUserByEmail($email);

        if($user) {
            $hash = $user->getPassword();
            $result = password_verify($password, $hash);
            if($result==true) {
                UserService::setCurrentUser($user->getUser_ID());
                return $user;
            } else {
                return;
            }
        } else {
            return;
        }
    }
          
}



