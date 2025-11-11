<?php
require_once __DIR__ . '/../config/Database.php';

class MoodTypeModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // ambil semua jenis mood
    public function getAllMoods() {
        $query = "SELECT * FROM mood_types ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $moods = [];
        while ($row = $result->fetch_assoc()) {
            $moods[] = $row;
        }
        return $moods;
    }

    // ambil satu mood type berdasarkan ID-nya
    public function getMoodTypeById($mood_id) {
        $query = "SELECT * FROM mood_types WHERE mood_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $mood_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // tambah mood baru
    public function addMoodType($mood_name, $mood_color) {
        $query = "INSERT INTO mood_types (mood_name, mood_color) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $mood_name, $mood_color);
        return $stmt->execute();
    }

    // update mood type
    public function updateMoodType($mood_id, $mood_name, $mood_color) {
        $query = "UPDATE mood_types SET mood_name = ?, mood_color = ? WHERE mood_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $mood_name, $mood_color, $mood_id);
        return $stmt->execute();
    }

    // hapus mood type
    public function deleteMoodType($mood_id) {
        $query = "DELETE FROM mood_types WHERE mood_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $mood_id);
        return $stmt->execute();
    }
}
?>