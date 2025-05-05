<?php
    class Programming {
        private $conn;
        private $table = "programming";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllProgramming(){
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addProgramming($name, $iconClass){
            $query = "INSERT INTO " . $this->table . " (name, icon_class) VALUES (:name, :iconClass)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":name" => $name, ":iconClass" => $iconClass]);
        }

        public function updateProgramming($id, $name, $iconClass){
            $query = "UPDATE " . $this->table . " SET name = :name, icon_class = :iconClass WHERE programming_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":name" => $name, ":iconClass" => $iconClass, ":id" => $id]);
        }

        public function deleteProgramming($id){
            $query = "DELETE FROM " . $this->table . " WHERE programming_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
        }
    }
?>