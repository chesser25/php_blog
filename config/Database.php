<?php

namespace App\Config;

use \PDO;

class Database
{
    // Db params
    private $host = "localhost";
    private $db_name = "blog";
    private $username = "root";
    private $password = "1234";
    private $conn = null;

    // Db connect
    public function connect(){
        try{
            $this->conn = new PDO('mysql:host=' . $this->host . ';db_name=' . $this->db_name, 
            $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            echo 'Connection error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}