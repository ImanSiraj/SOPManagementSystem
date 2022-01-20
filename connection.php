<?php


class DBController {
    private $host = "localhost";
    private $user = "root";
    private $password = "YES";
    private $database = "db_sfms";
    
    private static $conn;
    
   
    
    function connectDB() {
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        return $conn;
    }
    
    function selectDB() {
        mysqli_select_db($this->conn, $this->database);
    }
    
   
}
?>