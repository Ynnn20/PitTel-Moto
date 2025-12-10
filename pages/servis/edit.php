<?php
// pages/servis/edit.php
$pageTitle = "Edit Servis";
require_once '../../auth/auth_check.php';
require_once '../../includes/header.php';

$success = '';
$error = '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = "SELECT * FROM servis WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    die("Servis tidak ditemukan!");
}

$servis = mysqli_fetch_assoc($result);

$motorList = mysqli_query($conn, "SELECT m.*, p.nama as nama_pelanggan FROM motor m JOIN pelanggan p ON m.id_pelanggan = p.id ORDER BY p.nama ASC");
$mekanikList = mysqli_query($conn, "SELECT * FROM mekanik WHERE status='Aktif' ORDER BY nama ASC");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_motor = (int)$_POST['id_motor'];
    $id_mekanik = (int)$_POST['id_mekanik'];
    $tanggal_masuk = clean($_POST['tanggal_masuk']);
    $tanggal_selesai = !empty($_POST['tanggal_selesai']) ? "'" . clean($_POST['tanggal_selesai']) . "'" : "NULL";
    $jenis_servis = clean($_POST['jenis_servis']);
    $keluhan = clean($_POST['keluhan']);
    $perbaikan = clean($_POST['perbaikan']);
    $biaya = (float)$_POST['biaya'];
    $status = clean($_POST['status']);
    
    $query = "UPDATE servis SET 
              id_motor=$id_motor, 
              id_mekanik=$id_mekanik, 
              tanggal_masuk='$tanggal_masuk', 
              tanggal_selesai=$tanggal_selesai, 
              jenis_servis='$jenis_servis', 
              keluhan='$keluhan', 
              perbaikan='$perbaikan', 
              biaya=$biaya, 
              status='$status' 
              WHERE id=$id";
    
    if (mysqli_query($conn, $query)) {
        $success = "Data servis berhasil diupdate!";
        $servis = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM servis WHERE id = $id LIMIT 1"));
    } else {
        $error = "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>

<div class="container" style="max-width: 900px;">
    <div style="margin-bottom: 2rem;">
        <a href="index.php" style="color: var(--steel); text-decoration: none;">← Kembali ke Daftar Servis</a>
        <h2 style="margin-top: 1rem;">✏️ Edit Servis #<?php echo $servis['id']; ?></h2>
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
                <label for="id_motor">Motor (Plat Nomor - Pemilik) <span style="color: var(--primary-red);">*</span></label>
                <select id="id_motor" name="id_motor" class="form-control" required>
                    <?php while ($m = mysqli_fetch_assoc($motorList)): ?>
                        <option value="<?php echo $m['id']; ?>" <?php echo ($servis['id_motor'] == $m['id']) ? 'selected' : ''; ?>>
                            <?php echo $m['plat_nomor'] . ' - ' . $m['merk'] . ' ' . $m['model'] . ' (' . $m['nama_pelanggan'] . ')'; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="id_mekanik">Mekanik <span style="color: var(--primary-red);">*</span></label>
                    <select id="id_mekanik" name="id_mekanik" class="form-control" required>
                        <?php while ($mk = mysqli_fetch_assoc($mekanikList)): ?>
                            <option value="<?php echo $mk['id']; ?>" <?php echo ($servis['id_mekanik'] == $mk['id']) ? 'selected' : ''; ?>>
                                <?php echo $mk['nama'] . ' - ' . $mk['spesialisasi']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="tanggal_masuk">Tanggal Masuk <span style="color: var(--primary-red);">*</span></label>
                    <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control" value="<?php echo $servis['tanggal_masuk']; ?>" required>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" value="<?php echo $servis['tanggal_selesai']; ?>">
                </div>
                
                <div class="form-group">
                    <label for="biaya">Biaya (Rp)</label>
                    <input type="number" id="biaya" name="biaya" class="form-control" value="<?php echo $servis['biaya']; ?>" min="0" step="1000">
                </div>
            </div>
            
            <div class="form-group">
                <label for="jenis_servis">Jenis Servis <span style="color: var(--primary-red);">*</span></label>
                <select id="jenis_servis" name="jenis_servis" class="form-control" required>
                    <option value="Servis Rutin" <?php echo ($servis['jenis_servis'] == 'Servis Rutin') ? 'selected' : ''; ?>>Servis Rutin</option>
                    <option value="Ganti Oli" <?php echo ($servis['jenis_servis'] == 'Ganti Oli') ? 'selected' : ''; ?>>Ganti Oli</option>
                    <option value="Tune Up" <?php echo ($servis['jenis_servis'] == 'Tune Up') ? 'selected' : ''; ?>>Tune Up</option>
                    <option value="Perbaikan Mesin" <?php echo ($servis['jenis_servis'] == 'Perbaikan Mesin') ? 'selected' : ''; ?>>Perbaikan Mesin</option>
                    <option value="Perbaikan Kelistrikan" <?php echo ($servis['jenis_servis'] == 'Perbaikan Kelistrikan') ? 'selected' : ''; ?>>Perbaikan Kelistrikan</option>
                    <option value="Ganti Ban" <?php echo ($servis['jenis_servis'] == 'Ganti Ban') ? 'selected' : ''; ?>>Ganti Ban</option>
                    <option value="Ganti Kampas Rem" <?php echo ($servis['jenis_servis'] == 'Ganti Kampas Rem') ? 'selected' : ''; ?>>Ganti Kampas Rem</option>
                    <option value="Overhaul" <?php echo ($servis['jenis_servis'] == 'Overhaul') ? 'selected' : ''; ?>>Overhaul</option>
                    <option value="Body Repair" <?php echo ($servis['jenis_servis'] == 'Body Repair') ? 'selected' : ''; ?>>Body Repair</option>
                    <option value="Custom/Modifikasi" <?php echo ($servis['jenis_servis'] == 'Custom/Modifikasi') ? 'selected' : ''; ?>>Custom/Modifikasi</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="keluhan">Keluhan / Catatan <span style="color: var(--primary-red);">*</span></label>
                <textarea id="keluhan" name="keluhan" class="form-control" rows="3" required><?php echo $servis['keluhan']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="perbaikan">Perbaikan yang Dilakukan</label>
                <textarea id="perbaikan" name="perbaikan" class="form-control" rows="3" placeholder="Jelaskan detail perbaikan yang sudah dilakukan..."><?php echo $servis['perbaikan']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="status">Status <span style="color: var(--primary-red);">*</span></label>
                <select id="status" name="status" class="form-control" required>
                    <option value="Menunggu" <?php echo ($servis['status'] == 'Menunggu') ? 'selected' : ''; ?>>Menunggu</option>
                    <option value="Sedang Dikerjakan" <?php echo ($servis['status'] == 'Sedang Dikerjakan') ? 'selected' : ''; ?>>Sedang Dikerjakan</option>
                    <option value="Selesai" <?php echo ($servis['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                    <option value="Diambil" <?php echo ($servis['status'] == 'Diambil') ? 'selected' : ''; ?>>Diambil</option>
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