<?php
    class Education {
        private $conn;
        private $table = "education";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllEducation(){
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addEducation($degree, $institution, $startYear, $endYear, $description){
            $query = "INSERT INTO " . $this->table . " (degree, institution, start_year, end_year, description) VALUES (:degree, :institution, :startYear, :endYear, :description)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":degree" => $degree, ":institution" => $institution, ":startYear" => $startYear, ":endYear" => $endYear, ":description" => $description]);

        }

        public function updateEducation($id, $degree, $institution, $startYear, $endYear, $description){
            $query = "UPDATE " . $this->table . " SET degree = :degree, institution = :institution, start_year = :startYear, end_year = :endYear, description = :description WHERE education_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":degree" => $degree, ":institution" => $institution, ":startYear" => $startYear, ":endYear" => $endYear, ":description" => $description, ":id" => $id]);

        }

        public function deleteEducation($id){
            $query = "DELETE FROM " . $this->table . " WHERE education_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
        }
    }
?>