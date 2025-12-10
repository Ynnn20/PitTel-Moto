<?php
// pages/pelanggan/tambah.php
$pageTitle = "Tambah Pelanggan";
require_once '../../auth/auth_check.php';
require_once '../../includes/header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = clean($_POST['nama']);
    $email = clean($_POST['email']);
    $telepon = clean($_POST['telepon']);
    $alamat = clean($_POST['alamat']);
    
    $query = "INSERT INTO pelanggan (nama, email, telepon, alamat) VALUES ('$nama', '$email', '$telepon', '$alamat')";
    
    if (mysqli_query($conn, $query)) {
        $success = "Pelanggan berhasil ditambahkan!";
    } else {
        $error = "Gagal menambahkan pelanggan: " . mysqli_error($conn);
    }
}
?>

<div class="container" style="max-width: 800px;">
    <div style="margin-bottom: 2rem;">
        <a href="index.php" style="color: var(--steel); text-decoration: none;">← Kembali ke Daftar Pelanggan</a>
        <h2 style="margin-top: 1rem;">➕ Tambah Pelanggan Baru</h2>
    </div>
    
    <?php if ($success): ?>
        <div class="alert alert-success">
            <?php echo $success; ?>
            <a href="index.php" style="color: #155724; font-weight: 600; margin-left: 1rem;">Lihat Daftar →</a>
        </div>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="card" style="border-left: 4px solid var(--primary-red);">
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama Lengkap <span style="color: var(--primary-red);">*</span></label>
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Contoh: Budi Santoso" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="budi@example.com">
            </div>
            
            <div class="form-group">
                <label for="telepon">Nomor Telepon <span style="color: var(--primary-red);">*</span></label>
                <input type="tel" id="telepon" name="telepon" class="form-control" placeholder="0812-3456-7890" required>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" class="form-control" rows="4" placeholder="Jl. Contoh No. 123, Jakarta"></textarea>
            </div>
            
            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">💾 Simpan Pelanggan</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>