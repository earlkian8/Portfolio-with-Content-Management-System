<?php
    class Admin {
        private $conn;
        private $table = "admin";

        public function __construct($db){
            $this->conn = $db;
        }

        public function login($username, $password){
            $query = "SELECT * FROM " . $this->table . " WHERE username = :username AND password = :password";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":username" => $username, ":password" => $password]);
            $account = $stmt->fetch(PDO::FETCH_ASSOC);

            return $account ? true : false;
        }
    }
?>