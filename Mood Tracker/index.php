<?php
// Mulai session 
session_start();

// halaman default
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Cek apakah user sudah login
$isLoggedIn = isset($_SESSION['user_id']);

// Simple Router 
if ($page === 'home') {
    if (!$isLoggedIn) {
        // Belum login? Tendang ke halaman login
        header('Location: index.php?page=users&action=showLogin');
        exit;
    }
    // Lolos? Lanjut panggil view home
    include __DIR__ . '/view/home.php'; 

} elseif ($page === 'users') {
    // Halaman login/register 
    require_once __DIR__ . '/class/UserController.php'; 
    $controller = new UserController();
    
    if ($action === 'register') {
        $controller->register();
    } elseif ($action === 'showRegister') {
        $controller->showRegisterForm();
    } elseif ($action === 'login') { 
        $controller->login();
    } elseif ($action === 'showLogin') { 
        $controller->showLoginForm();
    } elseif ($action === 'logout') { 
        $controller->logout();
    } else {
        $controller->showLoginForm(); // Default jika aksi tidak ada
    }

} elseif ($page === 'moods') { 
    if (!$isLoggedIn) {
        // Belum login? Tendang ke halaman login
        header('Location: index.php?page=users&action=showLogin');
        exit;
    }
    // Lolos? Lanjut panggil MoodController
    require_once __DIR__ . '/class/MoodController.php'; 
    $controller = new MoodController();
    
    if ($action === 'create') {
        $controller->create();
    } elseif ($action === 'delete') {
        $controller->delete();
    } elseif ($action === 'edit') { 
        $controller->showEditForm();
    } elseif ($action === 'update') { 
        $controller->update();
    } else { 
        $controller->index();
    }

} elseif ($page === 'entries') { 
    if (!$isLoggedIn) {
        // Belum login? Tendang ke halaman login
        header('Location: index.php?page=users&action=showLogin');
        exit;
    }
    // Lolos? Lanjut panggil MoodEntryController
    require_once __DIR__ . '/class/MoodEntryController.php'; 
    $controller = new MoodEntryController();

    if ($action === 'create') {
        $controller->create();
    } elseif ($action === 'delete') {
        $controller->delete();
    } elseif ($action === 'edit') { 
        $controller->showEditForm();
    } elseif ($action === 'update') { 
        $controller->update();
    } else { 
        $controller->index();
    }
} else {
    // Halaman tidak ditemukan
    http_response_code(404);
    echo "<h1>404 Page Not Found</h1>";
}
?>