<?php
// includes/header.php
session_start();
require_once __DIR__ . '/../config/database.php';

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$userName = isset($_SESSION['user_nama']) ? $_SESSION['user_nama'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>PitTel Moto</title>
    <link rel="stylesheet" href="/pittel-moto/assets/css/style.css">
    <style>
        /* Icon SVG inline untuk performa */
        .icon-settings::before { content: "⚙️"; }
        .icon-user::before { content: "👤"; }
        .icon-wrench::before { content: "🔧"; }
        .icon-bike::before { content: "🏍️"; }
        .icon-clipboard::before { content: "📋"; }
        .icon-package::before { content: "📦"; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="/pittel-moto/" class="logo">
                <div class="logo-icon">
                    <span class="icon-settings"></span>
                </div>
                <div class="logo-text">
                    <h3>PitTel Moto</h3>
                    <span>Fast & Trusted</span>
                </div>
            </a>
            
            <nav>
                <ul>
                    <?php if ($isLoggedIn): ?>
                        <li><a href="/pittel-moto/pages/dashboard.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>">Dashboard</a></li>
                        <li><a href="/pittel-moto/pages/pelanggan/">Pelanggan</a></li>
                        <li><a href="/pittel-moto/pages/mekanik/">Mekanik</a></li>
                        <li><a href="/pittel-moto/pages/motor/">Motor</a></li>
                        <li><a href="/pittel-moto/pages/servis/">Servis</a></li>
                        <li><a href="/pittel-moto/pages/spareparts/">Spareparts</a></li>
                        <li><span style="color: var(--yellow);">👋 <?php echo $userName; ?></span></li>
                        <li><a href="/pittel-moto/auth/logout.php" class="btn btn-danger btn-sm">Keluar</a></li>
                    <?php else: ?>
                        <li><a href="/pittel-moto/">Beranda</a></li>
                        <li><a href="/pittel-moto/auth/login.php" class="btn btn-primary btn-sm">Masuk</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </nav>
    
    <div class="main-content">
