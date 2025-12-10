<?php
// auth/login.php
$pageTitle = "Login";
require_once '../includes/header.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = clean($_POST['email']);
    $password = $_POST['password'];
    
    $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nama'] = $user['nama'];
            $_SESSION['user_role'] = $user['role'];
            
            header('Location: /pittel-moto/pages/dashboard.php');
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>

<div class="container" style="max-width: 500px; margin-top: 5rem;">
    <div class="card" style="border-top: 4px solid var(--primary-red);">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-red), var(--fire-red)); border-radius: 15px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <span style="font-size: 2.5rem;">⚙️</span>
            </div>
            <h2>Masuk ke PitTel Moto</h2>
            <p style="color: var(--steel); opacity: 0.7;">Kelola servis motor dengan presisi racing-grade</p>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="email@example.com" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                🔓 Masuk
            </button>
        </form>
        
        <div style="text-align: center; margin-top: 1.5rem;">
            <p style="font-size: 0.9rem; color: var(--steel);">
                Belum punya akun? <a href="register.php" style="color: var(--primary-red); font-weight: 600;">Daftar di sini</a>
            </p>
        </div>
    </div>
    
    <div style="text-align: center; margin-top: 1rem;">
        <a href="/pittel-moto/" style="color: var(--steel);">← Kembali ke Beranda</a>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>