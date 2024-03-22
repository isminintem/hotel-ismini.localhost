<?php

namespace Data\Hotel;
use PDO;
use ArrayObject;
use \model\Hotel\Payment;

class PaymentDBA {
    private $pdo;
    public function __construct(){
        $this->pdo=new PDO('mysql:host=127.0.0.1;dbname=hotel;charset=UTF8','root','Filaki19!!!',[
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        ]);
    }

    protected function getPdo(){
        return $this->pdo;
    }

    function getAllPayments(){
        $result=new ArrayObject();
        $statement=$this->getPdo()->query("SELECT*FROM payment");
        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $payment=Payment::createPayment($row);
            $result->append($payment);
        }
        return $result;
    }
}



