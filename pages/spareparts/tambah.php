<?php
// pages/spareparts/tambah.php
$pageTitle = "Tambah Sparepart";
require_once '../../auth/auth_check.php';
require_once '../../includes/header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = clean($_POST['nama']);
    $kategori = clean($_POST['kategori']);
    $stok = (int)$_POST['stok'];
    $harga = (float)$_POST['harga'];
    $deskripsi = clean($_POST['deskripsi']);
    
    // Auto set status berdasarkan stok
    $status = $stok == 0 ? 'Habis' : ($stok < 10 ? 'Low Stock' : 'Ready');
    
    $query = "INSERT INTO spareparts (nama, kategori, stok, harga, deskripsi, status) 
              VALUES ('$nama', '$kategori', $stok, $harga, '$deskripsi', '$status')";
    
    if (mysqli_query($conn, $query)) {
        $success = "Sparepart berhasil ditambahkan!";
    } else {
        $error = "Gagal menambahkan sparepart: " . mysqli_error($conn);
    }
}
?>

<div class="container" style="max-width: 800px;">
    <div style="margin-bottom: 2rem;">
        <a href="index.php" style="color: var(--steel); text-decoration: none;">← Kembali ke Daftar Spareparts</a>
        <h2 style="margin-top: 1rem;">➕ Tambah Sparepart Baru</h2>
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
                <label for="nama">Nama Sparepart <span style="color: var(--primary-red);">*</span></label>
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Contoh: Oli Motul 7100 10W-40" required>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="kategori">Kategori <span style="color: var(--primary-red);">*</span></label>
                    <select id="kategori" name="kategori" class="form-control" required>
                        <option value="">Pilih kategori</option>
                        <option value="Oli Mesin">Oli Mesin</option>
                        <option value="Ban">Ban</option>
                        <option value="Rem">Rem</option>
                        <option value="Kelistrikan">Kelistrikan</option>
                        <option value="Filter">Filter</option>
                        <option value="Transmisi">Transmisi</option>
                        <option value="Suspensi">Suspensi</option>
                        <option value="Body Parts">Body Parts</option>
                        <option value="Aksesoris">Aksesoris</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="stok">Jumlah Stok <span style="color: var(--primary-red);">*</span></label>
                    <input type="number" id="stok" name="stok" class="form-control" placeholder="0" min="0" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="harga">Harga Jual (Rp) <span style="color: var(--primary-red);">*</span></label>
                <input type="number" id="harga" name="harga" class="form-control" placeholder="125000" min="0" step="1000" required>
            </div>
            
            <div class="form-group">
                <label for="deskripsi">Deskripsi & Spesifikasi</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" placeholder="Deskripsikan spesifikasi teknis, kualitas, dan kegunaan sparepart..."></textarea>
            </div>
            
            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">💾 Simpan Sparepart</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>