<?php

    class Skills {
        private $conn;
        private $table = "skills";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getSkill(){
            $query = "SELECT * FROM " . $this->table . " WHERE skills_id = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function updateSkill($id, $description, $projectCompleted, $clientsServed, $yearsExperience){
            $query = "UPDATE " . $this->table . " SET description = :description, project_completed = :projectCompleted, clients_served = :clientsServed, years_experience = :yearsExperience WHERE skills_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":description" => $description, ":projectCompleted" => $projectCompleted, ":clientsServed" => $clientsServed, ":yearsExperience" => $yearsExperience, ":id" => $id]);
        }
    }
?>