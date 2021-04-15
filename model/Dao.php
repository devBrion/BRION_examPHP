<?php

namespace Source\model;

use PDO;
use PDOException;

class Dao{
    private static $host = "localhost";
    private static $port = "3306";
    private static $database = "examPHP";
    private static $charset = "UTF8";
    private static $user = "root";
    private static $password = "";
    private static $connection;

    public static function openDatabase(){
        $dsn = "mysql:"."host=".self::$host.";"."port=".self::$port.";"."dbname=".self::$database.";"."charset=".self::$charset.";";
        try{
           self:: $connection =  new PDO($dsn, self::$user, self::$password);
            return self::$connection;
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function closeDatabase(){
        self::$connection=null;
    }

}