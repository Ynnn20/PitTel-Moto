<?php
// pages/pelanggan/edit.php
$pageTitle = "Edit Pelanggan";
require_once '../../auth/auth_check.php';
require_once '../../includes/header.php';

$success = '';
$error = '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data pelanggan
$query = "SELECT * FROM pelanggan WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    die("Pelanggan tidak ditemukan!");
}

$pelanggan = mysqli_fetch_assoc($result);

// Update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = clean($_POST['nama']);
    $email = clean($_POST['email']);
    $telepon = clean($_POST['telepon']);
    $alamat = clean($_POST['alamat']);
    
    $query = "UPDATE pelanggan SET nama='$nama', email='$email', telepon='$telepon', alamat='$alamat' WHERE id=$id";
    
    if (mysqli_query($conn, $query)) {
        $success = "Data pelanggan berhasil diupdate!";
        // Refresh data
        $pelanggan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pelanggan WHERE id = $id LIMIT 1"));
    } else {
        $error = "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>

<div class="container" style="max-width: 800px;">
    <div style="margin-bottom: 2rem;">
        <a href="index.php" style="color: var(--steel); text-decoration: none;">← Kembali ke Daftar Pelanggan</a>
        <h2 style="margin-top: 1rem;">✏️ Edit Pelanggan: <?php echo $pelanggan['nama']; ?></h2>
    </div>
    
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="card" style="border-left: 4px solid var(--blue);">
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama Lengkap <span style="color: var(--primary-red);">*</span></label>
                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $pelanggan['nama']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $pelanggan['email']; ?>">
            </div>
            
            <div class="form-group">
                <label for="telepon">Nomor Telepon <span style="color: var(--primary-red);">*</span></label>
                <input type="tel" id="telepon" name="telepon" class="form-control" value="<?php echo $pelanggan['telepon']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" class="form-control" rows="4"><?php echo $pelanggan['alamat']; ?></textarea>
            </div>
            
            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">💾 Update Data</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>