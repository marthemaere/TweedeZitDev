<?php
abstract class Db{
    private static $conn;

    public static function getConnection(){
        if(self::$conn != null){
            return self::$conn;
        } else {
            self::$conn = new PDO("mysql:host=ID367778_herexamenphp.db.webhosting.be;dbname=ID367778_herexamenphp", 'ID367778_herexamenphp', 'Test1234!');
            return self::$conn;
        }
    }
}