<?php
    class Projects {
        private $conn;
        private $table = "projects";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllProjects(){
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addProject($title, $description, $image, $technologiesUsed, $url, $github){
            $query = "INSERT INTO " . $this->table . " (title, description, image, technologies_used, url, github) VALUES (:title, :description, :image, :technologiesUsed, :url, :github)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":title" => $title, ":description" => $description, ":image" => $image, ":technologiesUsed" => $technologiesUsed, ":url" => $url, ":github" => $github]);
        }

        public function updateProject($id, $title, $description, $image, $technologiesUsed, $url, $github){
            $query = "UPDATE " . $this->table . " SET title = :title, description = :description, image = :image, technologies_used = :technologiesUsed, url = :url, github = :github WHERE project_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id, ":title" => $title, ":description" => $description, ":image" => $image, ":technologiesUsed" => $technologiesUsed, ":url" => $url, ":github" => $github]);
        }

        public function deleteProject($id){
            $query = "DELETE FROM " . $this->table . " WHERE project_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
        }
    }
?>