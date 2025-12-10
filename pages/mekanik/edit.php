<?php
// pages/mekanik/edit.php
$pageTitle = "Edit Mekanik";
require_once '../../auth/auth_check.php';
require_once '../../includes/header.php';

$success = '';
$error = '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = "SELECT * FROM mekanik WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    die("Mekanik tidak ditemukan!");
}

$mekanik = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = clean($_POST['nama']);
    $spesialisasi = clean($_POST['spesialisasi']);
    $telepon = clean($_POST['telepon']);
    $email = clean($_POST['email']);
    $status = clean($_POST['status']);
    
    $query = "UPDATE mekanik SET nama='$nama', spesialisasi='$spesialisasi', telepon='$telepon', email='$email', status='$status' WHERE id=$id";
    
    if (mysqli_query($conn, $query)) {
        $success = "Data mekanik berhasil diupdate!";
        $mekanik = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mekanik WHERE id = $id LIMIT 1"));
    } else {
        $error = "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>

<div class="container" style="max-width: 800px;">
    <div style="margin-bottom: 2rem;">
        <a href="index.php" style="color: var(--steel); text-decoration: none;">← Kembali ke Daftar Mekanik</a>
        <h2 style="margin-top: 1rem;">✏️ Edit Mekanik: <?php echo $mekanik['nama']; ?></h2>
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
                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $mekanik['nama']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="spesialisasi">Spesialisasi <span style="color: var(--primary-red);">*</span></label>
                <select id="spesialisasi" name="spesialisasi" class="form-control" required>
                    <option value="Mesin" <?php echo ($mekanik['spesialisasi'] == 'Mesin') ? 'selected' : ''; ?>>Mesin</option>
                    <option value="Kelistrikan" <?php echo ($mekanik['spesialisasi'] == 'Kelistrikan') ? 'selected' : ''; ?>>Kelistrikan</option>
                    <option value="Body & Cat" <?php echo ($mekanik['spesialisasi'] == 'Body & Cat') ? 'selected' : ''; ?>>Body & Cat</option>
                    <option value="Tune Up" <?php echo ($mekanik['spesialisasi'] == 'Tune Up') ? 'selected' : ''; ?>>Tune Up</option>
                    <option value="Servis Rutin" <?php echo ($mekanik['spesialisasi'] == 'Servis Rutin') ? 'selected' : ''; ?>>Servis Rutin</option>
                    <option value="Racing Modification" <?php echo ($mekanik['spesialisasi'] == 'Racing Modification') ? 'selected' : ''; ?>>Racing Modification</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="telepon">Nomor Telepon <span style="color: var(--primary-red);">*</span></label>
                <input type="tel" id="telepon" name="telepon" class="form-control" value="<?php echo $mekanik['telepon']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $mekanik['email']; ?>">
            </div>
            
            <div class="form-group">
                <label for="status">Status <span style="color: var(--primary-red);">*</span></label>
                <select id="status" name="status" class="form-control" required>
                    <option value="Aktif" <?php echo ($mekanik['status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                    <option value="Cuti" <?php echo ($mekanik['status'] == 'Cuti') ? 'selected' : ''; ?>>Cuti</option>
                    <option value="Non-Aktif" <?php echo ($mekanik['status'] == 'Non-Aktif') ? 'selected' : ''; ?>>Non-Aktif</option>
                </select>
            </div>
            
            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">💾 Update Data</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>