<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class Database {
    private $host = 'localhost';
    private $db_name = 'b18_39446707_cuoiky_db'; // Change to your database name
    private $username = 'root'; // Change if your MySQL username is different
    private $password = 'Aa@123456';     // Change if your MySQL password is not empty
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>