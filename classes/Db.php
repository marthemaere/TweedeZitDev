<?php
abstract class Db{
    private static $conn;

    public static function getConnection(){
        if(self::$conn != null){
            return self::$conn;
        } else {
            self::$conn = new PDO("mysql:host=[HOST];dbname=[DBNAME]", '[USERNAME]', '[PASSWORD]');
            return self::$conn;
        }
    }
}