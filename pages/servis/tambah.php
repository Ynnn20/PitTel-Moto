<?php
// pages/servis/tambah.php
$pageTitle = "Buat Servis Baru";
require_once '../../auth/auth_check.php';
require_once '../../includes/header.php';

$success = '';
$error = '';

$motorList = mysqli_query($conn, "SELECT m.*, p.nama as nama_pelanggan FROM motor m JOIN pelanggan p ON m.id_pelanggan = p.id ORDER BY p.nama ASC");
$mekanikList = mysqli_query($conn, "SELECT * FROM mekanik WHERE status='Aktif' ORDER BY nama ASC");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_motor = (int)$_POST['id_motor'];
    $id_mekanik = (int)$_POST['id_mekanik'];
    $tanggal_masuk = clean($_POST['tanggal_masuk']);
    $jenis_servis = clean($_POST['jenis_servis']);
    $keluhan = clean($_POST['keluhan']);
    $status = clean($_POST['status']);
    
    $query = "INSERT INTO servis (id_motor, id_mekanik, tanggal_masuk, jenis_servis, keluhan, status) 
              VALUES ($id_motor, $id_mekanik, '$tanggal_masuk', '$jenis_servis', '$keluhan', '$status')";
    
    if (mysqli_query($conn, $query)) {
        $success = "Servis berhasil dibuat!";
    } else {
        $error = "Gagal membuat servis: " . mysqli_error($conn);
    }
}
?>

<div class="container" style="max-width: 900px;">
    <div style="margin-bottom: 2rem;">
        <a href="index.php" style="color: var(--steel); text-decoration: none;">← Kembali ke Daftar Servis</a>
        <h2 style="margin-top: 1rem;">➕ Buat Servis Baru</h2>
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
                <label for="id_motor">Motor (Plat Nomor - Pemilik) <span style="color: var(--primary-red);">*</span></label>
                <select id="id_motor" name="id_motor" class="form-control" required>
                    <option value="">Pilih motor</option>
                    <?php while ($m = mysqli_fetch_assoc($motorList)): ?>
                        <option value="<?php echo $m['id']; ?>">
                            <?php echo $m['plat_nomor'] . ' - ' . $m['merk'] . ' ' . $m['model'] . ' (' . $m['nama_pelanggan'] . ')'; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <small style="color: var(--steel); opacity: 0.7;">Belum terdaftar? <a href="../motor/tambah.php" style="color: var(--primary-red);">Tambah motor baru</a></small>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="id_mekanik">Mekanik <span style="color: var(--primary-red);">*</span></label>
                    <select id="id_mekanik" name="id_mekanik" class="form-control" required>
                        <option value="">Pilih mekanik</option>
                        <?php while ($mk = mysqli_fetch_assoc($mekanikList)): ?>
                            <option value="<?php echo $mk['id']; ?>">
                                <?php echo $mk['nama'] . ' - ' . $mk['spesialisasi']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="tanggal_masuk">Tanggal Masuk <span style="color: var(--primary-red);">*</span></label>
                    <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="jenis_servis">Jenis Servis <span style="color: var(--primary-red);">*</span></label>
                <select id="jenis_servis" name="jenis_servis" class="form-control" required>
                    <option value="">Pilih jenis servis</option>
                    <option value="Servis Rutin">Servis Rutin</option>
                    <option value="Ganti Oli">Ganti Oli</option>
                    <option value="Tune Up">Tune Up</option>
                    <option value="Perbaikan Mesin">Perbaikan Mesin</option>
                    <option value="Perbaikan Kelistrikan">Perbaikan Kelistrikan</option>
                    <option value="Ganti Ban">Ganti Ban</option>
                    <option value="Ganti Kampas Rem">Ganti Kampas Rem</option>
                    <option value="Overhaul">Overhaul</option>
                    <option value="Body Repair">Body Repair</option>
                    <option value="Custom/Modifikasi">Custom/Modifikasi</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="keluhan">Keluhan / Catatan <span style="color: var(--primary-red);">*</span></label>
                <textarea id="keluhan" name="keluhan" class="form-control" rows="4" placeholder="Jelaskan keluhan atau kebutuhan servis..." required></textarea>
            </div>
            
            <div class="form-group">
                <label for="status">Status <span style="color: var(--primary-red);">*</span></label>
                <select id="status" name="status" class="form-control" required>
                    <option value="Menunggu">Menunggu</option>
                    <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Diambil">Diambil</option>
                </select>
            </div>
            
            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">💾 Simpan Servis</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>