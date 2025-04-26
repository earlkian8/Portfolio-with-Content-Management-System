<?php
class Home {
    private $conn;
    private $table = "home";
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getHome() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateHome($name, $designation, $tagline, $profile_image = null) {
        try {
            if ($profile_image) {
                $stmt = $this->conn->prepare("UPDATE home SET name=?, designation=?, tagline=?, profile_image=? WHERE home_id=1");
                $stmt->bind_param("ssss", $name, $designation, $tagline, $profile_image);
            } else {
                $stmt = $this->conn->prepare("UPDATE home SET name=?, designation=?, tagline=? WHERE id=1");
                $stmt->bind_param("sss", $name, $designation, $tagline);
            }
            
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
}
?>