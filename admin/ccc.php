<?php
class db {
    public $db;

    public function __construct() {
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "minor_db";
        $message = "";

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "passed";
            
        } catch (PDOException $error) {
            $message = $error->getMessage();
            echo "failed";
        }
    }
}

$database = new db();
?>