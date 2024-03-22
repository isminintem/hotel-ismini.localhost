<?php

namespace Model\Hotel;

class User {

    private $user_id;
    private $name;
    private $email;
    private $password;
    private $created_time;
    private $updated_time;

    
    public function __construct($user_id, $name, $email, $password, $created_time, $updated_time) {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->created_time = $created_time;
        $this->updated_time = $updated_time;
    }

    public function getUser_ID() {
        return $this->user_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getCreated_time() {
        return $this->created_time;
    }

    public function getUpdated_time() {
        return $this->updated_time;
    }

    

    public function __toString() {   
        return $this->user_id."-".$this->name."-".$this->email;     
    }

    public static function createUser($row) {
        return new User($row["user_id"], $row["name"], $row["email"], $row["password"], $row["created_time"], $row["updated_time"]);
    }
}