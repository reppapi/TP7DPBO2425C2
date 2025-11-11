<?php
// 1. Path-nya kita benerin ke file yang udah di-rename
require_once __DIR__ . '/MoodTypeModel.php'; 

class MoodController {
    // 2. Kita ganti nama variabelnya biar jelas
    private $moodTypeModel; 

    public function __construct() {
        // 3. Kita panggil class yang udah di-rename
        $this->moodTypeModel = new MoodTypeModel(); 
    }

    // Tampilkan semua mood types (ini halaman kelola mood)
    public function index() {
        $moods = $this->moodTypeModel->getAllMoods();
        // Nanti kita akan panggil view dari sini
        // Untuk sekarang, kita panggil file view lamanya
        require __DIR__ . '/../view/mood_page.php';
    }

    // Tambah jenis mood baru
    public function create() {
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['mood_name'];
            $color = $_POST['mood_color'];

            if (empty($name)) {
                $message = 'Nama mood tidak boleh kosong';
            } else {
                $result = $this->moodTypeModel->addMoodType($name, $color);
                $message = $result ? 'Mood berhasil ditambahkan' : 'Gagal menambahkan mood';
            }
        }
        // Setelah proses, kembali ke halaman index
        // header('Location: index.php?page=moods'); // Ini cara yang bener nanti
        echo $message; // Untuk sementara
        $this->index(); // Tampilkan lagi halaman index
    }

    // Hapus mood
    public function delete() {
        $message = '';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $this->moodTypeModel->deleteMoodType($id);
            $message = $result ? 'Mood berhasil dihapus' : 'Gagal menghapus mood';
        }
        // header('Location: index.php?page=moods');
        echo $message;
        $this->index();
    }

    // Method untuk MENAMPILKAN form edit
    public function showEditForm() {
        $mood_id = $_GET['id'];

        // Ambil data mood yang mau diedit
        $mood = $this->moodTypeModel->getMoodTypeById($mood_id);

        if (!$mood) {
            echo "Mood tidak ditemukan.";
            echo '<p><a href="index.php?page=moods">Kembali</a></p>';
            exit;
        }

        // Panggil view form edit (Langkah 2)
        require __DIR__ . '/../view/edit_mood.php';
    }

    // Method untuk MEMPROSES data update
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari form
            $mood_id = $_POST['mood_id'];
            $name = $_POST['mood_name'];
            $color = $_POST['mood_color'];

            // Kirim ke model untuk di-update
            $result = $this->moodTypeModel->updateMoodType($mood_id, $name, $color);

            if ($result) {
                // Sukses, lempar balik ke halaman kelola mood
                header('Location: index.php?page=moods');
                exit;
            } else {
                echo "Gagal mengupdate mood.";
            }
        } else {
            // Jika diakses bukan via POST, lempar aja
            header('Location: index.php?page=moods');
            exit;
        }
    }
}
?>