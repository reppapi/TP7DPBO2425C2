<?php
require_once __DIR__ . '/MoodEntryModel.php';
require_once __DIR__ . '/MoodTypeModel.php'; 

class MoodEntryController {
    private $entryModel;
    private $moodTypeModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Pastikan session jalan
        }
        $this->entryModel = new MoodEntryModel();
        $this->moodTypeModel = new MoodTypeModel();
    }

    // Method untuk menampilkan halaman catatan harian
    public function index() {
        $userId = $_SESSION['user_id']; 

        // Ambil data yang diperlukan untuk view
        $entries = $this->entryModel->getEntriesByUser($userId);
        $moods = $this->moodTypeModel->getAllMoods(); // Untuk dropdown form

        // Panggil file view dan kirimkan data
        require __DIR__ . '/../view/entry_page.php';
    }

    // Method untuk memproses penambahan catatan baru
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $userId = $_SESSION['user_id']; 
            
            $moodId = $_POST['mood_id'];
            $entryDate = $_POST['entry_date'];
            $note = $_POST['note'];

            if (empty($moodId) || empty($entryDate)) {
                echo "Data tidak lengkap";
            } else {
                $result = $this->entryModel->addEntry($userId, $moodId, $entryDate, $note);
                if ($result) {
                    header('Location: index.php?page=entries');
                    exit;
                } else {
                    echo "Gagal menyimpan entri.";
                }
            }
        } else {
            header('Location: index.php?page=entries');
            exit;
        }
    }

    // Method untuk menghapus catatan
    public function delete() {
        if (isset($_GET['id'])) {
            $entry_id = $_GET['id'];
            
            $user_id = $_SESSION['user_id'];
            
            $result = $this->entryModel->deleteEntry($entry_id);
            
            if ($result) {
                header('Location: index.php?page=entries');
                exit;
            } else {
                echo "Gagal menghapus entri.";
            }
        } else {
            header('Location: index.php?page=entries');
            exit;
        }
    }

    // Method untuk menampilkan form edit
    public function showEditForm() {
        $entry_id = $_GET['id'];
        $user_id = $_SESSION['user_id'];
        
        // Ambil data entri yang mau diedit
        $entry = $this->entryModel->getEntryById($entry_id);
        
        // Cek dulu datanya ada, dan punya user yang login
        if (!$entry || $entry['user_id'] != $user_id) {
            echo "Entri tidak ditemukan atau bukan milik Anda.";
            echo '<p><a href="index.php?page=entries">Kembali</a></p>';
            exit;
        }
        
        // Ambil data moods untuk dropdown
        $moods = $this->moodTypeModel->getAllMoods();
        
        // Panggil view form edit (Langkah 2)
        require __DIR__ . '/../view/edit_entry.php';
    }
    
    // Method untuk memproses data update
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $entry_id = $_POST['entry_id'];
            $user_id = $_SESSION['user_id'];
            
            // Cek lagi datanya beneran punya user ini
            $entry = $this->entryModel->getEntryById($entry_id);
            if (!$entry || $entry['user_id'] != $user_id) {
                echo "Aksi tidak diizinkan.";
                exit;
            }
            
            // Ambil data dari form
            $moodId = $_POST['mood_id'];
            $entryDate = $_POST['entry_date'];
            $note = $_POST['note'];
            
            // Kirim ke model untuk di-update
            $result = $this->entryModel->updateEntry($entry_id, $moodId, $entryDate, $note);
            
            if ($result) {
                // Sukses, lempar balik ke halaman daftar entri
                header('Location: index.php?page=entries');
                exit;
            } else {
                echo "Gagal mengupdate entri.";
            }
        } else {
            // Jika diakses bukan via POST, lempar aja
            header('Location: index.php?page=entries');
            exit;
        }
    }
}
?>