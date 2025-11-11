<?php
require_once __DIR__ . '/../config/Database.php';

class MoodEntryModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // ambil semua catatan mood milik user tertentu
    public function getEntriesByUser($user_id) {
        $query = "SELECT me.entry_id, me.entry_date, me.note, mt.mood_name, mt.mood_color 
                  FROM mood_entries me
                  JOIN mood_types mt ON me.mood_id = mt.mood_id
                  WHERE me.user_id = ?
                  ORDER BY me.entry_date DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $entries = [];
        while ($row = $result->fetch_assoc()) {
            $entries[] = $row;
        }
        return $entries;
    }

    // ambil satu catatan mood berdasarkan ID-nya
    public function getEntryById($entry_id) {
        $query = "SELECT * FROM mood_entries WHERE entry_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $entry_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // tambah catatan mood baru
    public function addEntry($user_id, $mood_id, $entry_date, $note) {
        $query = "INSERT INTO mood_entries (user_id, mood_id, entry_date, note)
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiss", $user_id, $mood_id, $entry_date, $note);
        return $stmt->execute();
    }

    // update catatan mood
    public function updateEntry($entry_id, $mood_id, $entry_date, $note) {
        $query = "UPDATE mood_entries 
                  SET mood_id = ?, entry_date = ?, note = ? 
                  WHERE entry_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issi", $mood_id, $entry_date, $note, $entry_id);
        return $stmt->execute();
    }

    // hapus catatan mood
    public function deleteEntry($entry_id) {
        $query = "DELETE FROM mood_entries WHERE entry_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $entry_id);
        return $stmt->execute();
    }
}
?>
