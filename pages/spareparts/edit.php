<?php
// pages/spareparts/edit.php
$pageTitle = "Edit Sparepart";
require_once '../../auth/auth_check.php';
require_once '../../includes/header.php';

$success = '';
$error = '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = "SELECT * FROM spareparts WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    die("Sparepart tidak ditemukan!");
}

$sparepart = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = clean($_POST['nama']);
    $kategori = clean($_POST['kategori']);
    $stok = (int)$_POST['stok'];
    $harga = (float)$_POST['harga'];
    $deskripsi = clean($_POST['deskripsi']);
    
    // Auto set status berdasarkan stok
    $status = $stok == 0 ? 'Habis' : ($stok < 10 ? 'Low Stock' : 'Ready');
    
    $query = "UPDATE spareparts SET nama='$nama', kategori='$kategori', stok=$stok, harga=$harga, deskripsi='$deskripsi', status='$status' WHERE id=$id";
    
    if (mysqli_query($conn, $query)) {
        $success = "Data sparepart berhasil diupdate!";
        $sparepart = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM spareparts WHERE id = $id LIMIT 1"));
    } else {
        $error = "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>

<div class="container" style="max-width: 800px;">
    <div style="margin-bottom: 2rem;">
        <a href="index.php" style="color: var(--steel); text-decoration: none;">← Kembali ke Daftar Spareparts</a>
        <h2 style="margin-top: 1rem;">✏️ Edit Sparepart: <?php echo $sparepart['nama']; ?></h2>
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
                <label for="nama">Nama Sparepart <span style="color: var(--primary-red);">*</span></label>
                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $sparepart['nama']; ?>" required>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="kategori">Kategori <span style="color: var(--primary-red);">*</span></label>
                    <select id="kategori" name="kategori" class="form-control" required>
                        <option value="Oli Mesin" <?php echo ($sparepart['kategori'] == 'Oli Mesin') ? 'selected' : ''; ?>>Oli Mesin</option>
                        <option value="Ban" <?php echo ($sparepart['kategori'] == 'Ban') ? 'selected' : ''; ?>>Ban</option>
                        <option value="Rem" <?php echo ($sparepart['kategori'] == 'Rem') ? 'selected' : ''; ?>>Rem</option>
                        <option value="Kelistrikan" <?php echo ($sparepart['kategori'] == 'Kelistrikan') ? 'selected' : ''; ?>>Kelistrikan</option>
                        <option value="Filter" <?php echo ($sparepart['kategori'] == 'Filter') ? 'selected' : ''; ?>>Filter</option>
                        <option value="Transmisi" <?php echo ($sparepart['kategori'] == 'Transmisi') ? 'selected' : ''; ?>>Transmisi</option>
                        <option value="Suspensi" <?php echo ($sparepart['kategori'] == 'Suspensi') ? 'selected' : ''; ?>>Suspensi</option>
                        <option value="Body Parts" <?php echo ($sparepart['kategori'] == 'Body Parts') ? 'selected' : ''; ?>>Body Parts</option>
                        <option value="Aksesoris" <?php echo ($sparepart['kategori'] == 'Aksesoris') ? 'selected' : ''; ?>>Aksesoris</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="stok">Jumlah Stok <span style="color: var(--primary-red);">*</span></label>
                    <input type="number" id="stok" name="stok" class="form-control" value="<?php echo $sparepart['stok']; ?>" min="0" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="harga">Harga Jual (Rp) <span style="color: var(--primary-red);">*</span></label>
                <input type="number" id="harga" name="harga" class="form-control" value="<?php echo $sparepart['harga']; ?>" min="0" step="1000" required>
            </div>
            
            <div class="form-group">
                <label for="deskripsi">Deskripsi & Spesifikasi</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4"><?php echo $sparepart['deskripsi']; ?></textarea>
            </div>
            
            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">💾 Update Data</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>