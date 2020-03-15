<?php

abstract class Connection{
    private static $conn;
    public static function getConn(){
        if(is_null(self::$conn)){
            self::$conn = new PDO('mysql: host=localhost; dbname=phpmvc; charset=utf8', 'root', '');
        }
        return self::$conn;
    }
}