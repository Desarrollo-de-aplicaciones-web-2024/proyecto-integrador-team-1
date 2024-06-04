<?php
class Database {
    private $host = 'database-team1-daw.c30w0agw4764.us-east-2.rds.amazonaws.com';
    private $db_name = 'PP_TEAM1';
    private $username = 'admin';
    private $password = 'S1stemas_23';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
