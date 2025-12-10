<?php
// pages/mekanik/tambah.php
$pageTitle = "Tambah Mekanik";
require_once '../../auth/auth_check.php';
require_once '../../includes/header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = clean($_POST['nama']);
    $spesialisasi = clean($_POST['spesialisasi']);
    $telepon = clean($_POST['telepon']);
    $email = clean($_POST['email']);
    $status = clean($_POST['status']);
    
    $query = "INSERT INTO mekanik (nama, spesialisasi, telepon, email, status) VALUES ('$nama', '$spesialisasi', '$telepon', '$email', '$status')";
    
    if (mysqli_query($conn, $query)) {
        $success = "Mekanik berhasil ditambahkan!";
    } else {
        $error = "Gagal menambahkan mekanik: " . mysqli_error($conn);
    }
}
?>

<div class="container" style="max-width: 800px;">
    <div style="margin-bottom: 2rem;">
        <a href="index.php" style="color: var(--steel); text-decoration: none;">← Kembali ke Daftar Mekanik</a>
        <h2 style="margin-top: 1rem;">➕ Tambah Mekanik Baru</h2>
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
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Contoh: Ahmad Hidayat" required>
            </div>
            
            <div class="form-group">
                <label for="spesialisasi">Spesialisasi <span style="color: var(--primary-red);">*</span></label>
                <select id="spesialisasi" name="spesialisasi" class="form-control" required>
                    <option value="">Pilih spesialisasi</option>
                    <option value="Mesin">Mesin</option>
                    <option value="Kelistrikan">Kelistrikan</option>
                    <option value="Body & Cat">Body & Cat</option>
                    <option value="Tune Up">Tune Up</option>
                    <option value="Servis Rutin">Servis Rutin</option>
                    <option value="Racing Modification">Racing Modification</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="telepon">Nomor Telepon <span style="color: var(--primary-red);">*</span></label>
                <input type="tel" id="telepon" name="telepon" class="form-control" placeholder="0812-3456-7890" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="mekanik@pittelmoto.com">
            </div>
            
            <div class="form-group">
                <label for="status">Status <span style="color: var(--primary-red);">*</span></label>
                <select id="status" name="status" class="form-control" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Cuti">Cuti</option>
                    <option value="Non-Aktif">Non-Aktif</option>
                </select>
            </div>
            
            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">💾 Simpan Mekanik</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>