<?php


class Connection{
    
    static $host = "mysql:localhost=host;dbname=scstr;port=3306";
    static $user = "root";
    static $password = "DD2022";
    public $connection;

    public function __construct(){
        try{

            $this->connection = new PDO(Connection::$host,Connection::$user,Connection::$password);

        }catch(PDOException $e){

            print_r($e->getMessage());

        }

    }
    public function get_connectino(){
        return $this->connection;
    }

}

