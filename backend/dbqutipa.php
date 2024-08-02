<?php
// db.php

// التأكد من تعريف الثوابت مرة واحدة فقط
if (!defined('DB_SERVER')) {
    define("DB_SERVER", "localhost");
}
if (!defined('DB_USERNAME')) {
    define("DB_USERNAME", "root");
}
if (!defined('DB_PASSWORD')) {
    define("DB_PASSWORD", "");
}
if (!defined('DB_NAME')) {
    define("DB_NAME", "e-commerce");
}

// التأكد من عدم تعريف كلاس Database أكثر من مرة
if (!class_exists('Database')) {
    class Database {
        private $conn;

        public function __construct() {
            $this->connect();
        }

        public function connect() {
            $this->conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }

        public function getConnection() {
            return $this->conn;
        }
    }
}
?>
