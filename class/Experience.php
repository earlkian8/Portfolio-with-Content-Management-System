<?php
    
    class Experience {
        private $conn;
        private $table = "experience";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllExperience(){
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addExperience($position, $company, $startYear, $endYear, $description){
            $query = "INSERT INTO " . $this->table . " (position, company, start_year, end_year, description) VALUES (:position, :company, :startYear, :endYear, :description)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":position" => $position, ":company" => $company, ":startYear" => $startYear, ":endYear" => $endYear, ":description" => $description]);
        }

        public function updateExperience($id, $position, $company, $startYear, $endYear, $description){
            $query = "UPDATE " . $this->table . " SET position = :position, company = :company, start_year = :startYear, end_year = :endYear, description = :description WHERE experience_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":position" => $position, ":company" => $company, ":startYear" => $startYear, ":endYear" => $endYear, ":description" => $description, ":id" => $id]);
        }

        public function deleteExperience($id){
            $query = "DELETE FROM " . $this->table . " WHERE experience_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
        }
    }
?>