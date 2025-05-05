<?php
class Home {
    private $conn;
    private $table_name = "home";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getHome() {
        $query = "SELECT * FROM " . $this->table_name . " LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateHome($name, $designation, $tagline, $profile_image) {
        $query = "UPDATE " . $this->table_name . " SET name = :name, designation = :designation, tagline = :tagline , profile_image = :profile_image WHERE home_id = 1";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([":name" => $name, ":designation" => $designation, ":tagline" => $tagline, ":profile_image" => $profile_image]);
    }
}
?>