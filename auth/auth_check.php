<?php
// auth/auth_check.php
// File ini untuk proteksi halaman yang butuh login

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    // Redirect ke login jika belum login
    header('Location: /pittel-moto/auth/login.php');
    exit();
}

// Optional: Cek role tertentu
function checkRole($requiredRole) {
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== $requiredRole) {
        die('Akses ditolak! Anda tidak memiliki izin untuk halaman ini.');
    }
}
?>