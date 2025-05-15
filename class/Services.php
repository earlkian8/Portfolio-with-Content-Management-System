<?php

    class Services {
        private $conn;
        private $table = "services";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getServices(){
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function addServices($name, $description){
            $query = "INSERT INTO " . $this->table . " (name, description) VALUES (:name, :description)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":name" => $name, ":description" => $description]);
        }

        public function updateServices($id, $name, $description){
            $query = "UPDATE " . $this->table . " SET name = :name, description = :description WHERE service_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":name" => $name, ":description" => $description, ":id" => $id]);
        }

        public function deleteServices($id){
            $query = "DELETE FROM " . $this->table . " WHERE service_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
        }
    }
?>