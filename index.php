<?php
// index.php
$pageTitle = "Beranda";
require_once 'includes/header.php';
?>

<div style="background: linear-gradient(135deg, rgba(15,15,15,0.95), rgba(28,28,30,0.9)), url('https://images.unsplash.com/photo-1636761358783-209512dccd98?w=1200') center/cover; min-height: 600px; display: flex; align-items: center; color: white; margin: -2rem -2rem 2rem -2rem;">
    <div class="container">
        <div style="max-width: 600px;">
            <div style="display: inline-block; background: rgba(214, 10, 30, 0.1); border: 1px solid rgba(214, 10, 30, 0.3); padding: 0.5rem 1rem; border-radius: 25px; margin-bottom: 1.5rem;">
                <span style="color: var(--yellow);">⚡ Racing-Grade Service</span>
            </div>
            <h1 style="color: white; margin-bottom: 1.5rem;">Servis Motor Lebih Cepat & Terpercaya</h1>
            <p style="font-size: 1.2rem; margin-bottom: 2rem; opacity: 0.9;">
                Mekanik profesional bersertifikat, teknologi modern, dan standar servis racing-grade.
            </p>
            <div style="display: flex; gap: 1rem;">
                <a href="auth/login.php" class="btn btn-primary">
                    🚀 Book Service Now
                </a>
                <a href="auth/register.php" class="btn" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2);">
                    📋 Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="container">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="icon">🏍️</div>
            <h4>5,000+</h4>
            <p>Motor Dikerjakan</p>
        </div>
        <div class="stat-card">
            <div class="icon">⭐</div>
            <h4>98%</h4>
            <p>Satisfaction Rate</p>
        </div>
        <div class="stat-card">
            <div class="icon">🔧</div>
            <h4>15+</h4>
            <p>Expert Mechanics</p>
        </div>
        <div class="stat-card">
            <div class="icon">⚡</div>
            <h4>24/7</h4>
            <p>Customer Support</p>
        </div>
    </div>
    
    <!-- Features -->
    <div style="margin: 4rem 0;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <h2>Mengapa Memilih PitTel Moto?</h2>
            <p style="color: var(--steel); opacity: 0.7; margin-top: 1rem;">Kombinasi kecepatan, presisi, dan layanan premium</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <div class="card">
                <h3 style="color: var(--primary-red); margin-bottom: 1rem;">🔧 Mekanik Racing-Grade</h3>
                <p>Tim mekanik bersertifikat dengan standar industri racing dan pengalaman lebih dari 15 tahun.</p>
            </div>
            <div class="card">
                <h3 style="color: var(--yellow); margin-bottom: 1rem;">⚡ Express Service</h3>
                <p>Layanan cepat dengan teknologi diagnostic modern tanpa mengurangi kualitas pekerjaan.</p>
            </div>
            <div class="card">
                <h3 style="color: var(--blue); margin-bottom: 1rem;">🛡️ Garansi 100%</h3>
                <p>Setiap servis dilindungi garansi penuh untuk ketenangan dan kepuasan Anda.</p>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>