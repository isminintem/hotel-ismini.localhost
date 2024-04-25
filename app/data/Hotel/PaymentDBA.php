<?php

namespace Data\Hotel;
use PDO;
use ArrayObject;
use \model\Hotel\Payment;
use Services\Utils\Configuration;

class PaymentDBA {
    private $pdo;
    public function __construct(){
        $config = Configuration::getInstance();

        $this->pdo=new PDO(sprintf('mysql:host=%s;dbname=%s;charset=UTF8', $config->getDataBaseHost(), $config->getDataBaseName()), 
            $config->getDataBaseUser(), 
            $config->getDataBasePassword(), 
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]);
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



