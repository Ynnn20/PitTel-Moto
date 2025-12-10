<?php
// pages/motor/tambah.php
$pageTitle = "Tambah Motor";
require_once '../../auth/auth_check.php';
require_once '../../includes/header.php';

$success = '';
$error = '';

// Ambil daftar pelanggan untuk dropdown
$pelangganList = mysqli_query($conn, "SELECT id, nama FROM pelanggan ORDER BY nama ASC");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pelanggan = (int)$_POST['id_pelanggan'];
    $merk = clean($_POST['merk']);
    $model = clean($_POST['model']);
    $tahun = (int)$_POST['tahun'];
    $plat_nomor = strtoupper(clean($_POST['plat_nomor']));
    $warna = clean($_POST['warna']);
    
    // Cek plat nomor sudah ada
    $check = mysqli_query($conn, "SELECT * FROM motor WHERE plat_nomor = '$plat_nomor'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Plat nomor sudah terdaftar!";
    } else {
        $query = "INSERT INTO motor (id_pelanggan, merk, model, tahun, plat_nomor, warna) 
                  VALUES ($id_pelanggan, '$merk', '$model', $tahun, '$plat_nomor', '$warna')";
        
        if (mysqli_query($conn, $query)) {
            $success = "Motor berhasil ditambahkan!";
        } else {
            $error = "Gagal menambahkan motor: " . mysqli_error($conn);
        }
    }
}
?>

<div class="container" style="max-width: 800px;">
    <div style="margin-bottom: 2rem;">
        <a href="index.php" style="color: var(--steel); text-decoration: none;">← Kembali ke Daftar Motor</a>
        <h2 style="margin-top: 1rem;">➕ Tambah Motor Baru</h2>
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
                <label for="id_pelanggan">Pemilik Motor <span style="color: var(--primary-red);">*</span></label>
                <select id="id_pelanggan" name="id_pelanggan" class="form-control" required>
                    <option value="">Pilih pelanggan</option>
                    <?php while ($p = mysqli_fetch_assoc($pelangganList)): ?>
                        <option value="<?php echo $p['id']; ?>"><?php echo $p['nama']; ?></option>
                    <?php endwhile; ?>
                </select>
                <small style="color: var(--steel); opacity: 0.7;">Belum ada pelanggan? <a href="../pelanggan/tambah.php" style="color: var(--primary-red);">Tambah pelanggan baru</a></small>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="merk">Merk Motor <span style="color: var(--primary-red);">*</span></label>
                    <select id="merk" name="merk" class="form-control" required>
                        <option value="">Pilih merk</option>
                        <option value="Honda">Honda</option>
                        <option value="Yamaha">Yamaha</option>
                        <option value="Suzuki">Suzuki</option>
                        <option value="Kawasaki">Kawasaki</option>
                        <option value="Vespa">Vespa</option>
                        <option value="Ducati">Ducati</option>
                        <option value="Harley Davidson">Harley Davidson</option>
                        <option value="KTM">KTM</option>
                        <option value="BMW">BMW</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="model">Model/Tipe <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" id="model" name="model" class="form-control" placeholder="Contoh: Vario 150" required>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="tahun">Tahun Produksi <span style="color: var(--primary-red);">*</span></label>
                    <input type="number" id="tahun" name="tahun" class="form-control" placeholder="2023" min="1980" max="<?php echo date('Y') + 1; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="warna">Warna <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" id="warna" name="warna" class="form-control" placeholder="Hitam Metalik" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="plat_nomor">Plat Nomor <span style="color: var(--primary-red);">*</span></label>
                <input type="text" id="plat_nomor" name="plat_nomor" class="form-control" placeholder="B 1234 XYZ" required style="text-transform: uppercase; font-weight: 700;">
                <small style="color: var(--steel); opacity: 0.7;">Format: B 1234 XYZ (akan otomatis kapital)</small>
            </div>
            
            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">💾 Simpan Motor</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
// Auto uppercase plat nomor
document.getElementById('plat_nomor').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
});
</script>

<?php require_once '../../includes/footer.php'; ?>