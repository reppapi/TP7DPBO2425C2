<?php
require_once __DIR__ . '/UserModel.php';

class UserController {
    private $model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->model = new UserModel();
    }

    // ---------- REGISTER ----------
    public function showRegisterForm($error_message = null) {
        require __DIR__ . '/../view/register.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=users&action=showRegister');
            exit;
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($username) || empty($email) || empty($password)) {
            $this->showRegisterForm("Semua field harus diisi!");
            return;
        }

        if ($this->model->getUserByUsername($username)) {
             $this->showRegisterForm("Username sudah digunakan!");
             return;
        }

        if ($this->model->getUserByEmail($email)) {
            $this->showRegisterForm("Email sudah terdaftar!");
            return;
        }

        $result = $this->model->registerUser($username, $email, $password);
        if ($result) {
            // Kalau sukses, kirim pesan sukses ke halaman login
            $this->showLoginForm(null, "Registrasi berhasil! Silakan login."); 
        } else {
            $this->showRegisterForm("Registrasi gagal, silakan coba lagi.");
        }
    }

    // ---------- LOGIN ----------
    public function showLoginForm($error_message = null, $success_message = null) {
        require __DIR__ . '/../view/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=users&action=showLogin');
            exit;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $user = $this->model->loginUser($username, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            
            if (isset($_SESSION['intended_page'])) {
                $destination = $_SESSION['intended_page'];
                unset($_SESSION['intended_page']);
                header("Location: index.php?page=" . $destination);
            } else {
                header('Location: index.php?page=home');
            }
            exit;
        } else {
            // Kirim error ke form login
            $this->showLoginForm("Username atau password salah!");
        }
    }

    // ---------- LOGOUT ----------
    public function logout() {
        session_unset();
        session_destroy();
        header('Location: index.php?page=users&action=showLogin');
        exit;
    }
}
?>