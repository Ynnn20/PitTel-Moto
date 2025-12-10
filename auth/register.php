<?php
// auth/register.php
$pageTitle = "Daftar";
require_once '../includes/header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = clean($_POST['nama']);
    $email = clean($_POST['email']);
    $telepon = clean($_POST['telepon']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Cek email sudah ada
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        $query = "INSERT INTO users (nama, email, telepon, password) VALUES ('$nama', '$email', '$telepon', '$password')";
        
        if (mysqli_query($conn, $query)) {
            $success = "Pendaftaran berhasil! Silakan login.";
        } else {
            $error = "Terjadi kesalahan: " . mysqli_error($conn);
        }
    }
}
?>

<div class="container" style="max-width: 500px; margin-top: 3rem;">
    <div class="card" style="border-top: 4px solid var(--primary-red);">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-red), var(--fire-red)); border-radius: 15px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <span style="font-size: 2.5rem;">⚙️</span>
            </div>
            <h2>Daftar PitTel Moto</h2>
            <p style="color: var(--steel); opacity: 0.7;">Bergabung dengan layanan servis terbaik</p>
        </div>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="telepon">Nomor Telepon</label>
                <input type="tel" id="telepon" name="telepon" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" minlength="8" required>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                ✅ Daftar Sekarang
            </button>
        </form>
        
        <div style="text-align: center; margin-top: 1.5rem;">
            <p style="font-size: 0.9rem; color: var(--steel);">
                Sudah punya akun? <a href="login.php" style="color: var(--primary-red); font-weight: 600;">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>