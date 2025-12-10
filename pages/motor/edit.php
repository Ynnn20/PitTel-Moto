<?php
// pages/motor/edit.php
$pageTitle = "Edit Motor";
require_once '../../auth/auth_check.php';
require_once '../../includes/header.php';

$success = '';
$error = '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = "SELECT * FROM motor WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    die("Motor tidak ditemukan!");
}

$motor = mysqli_fetch_assoc($result);
$pelangganList = mysqli_query($conn, "SELECT id, nama FROM pelanggan ORDER BY nama ASC");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pelanggan = (int)$_POST['id_pelanggan'];
    $merk = clean($_POST['merk']);
    $model = clean($_POST['model']);
    $tahun = (int)$_POST['tahun'];
    $plat_nomor = strtoupper(clean($_POST['plat_nomor']));
    $warna = clean($_POST['warna']);
    
    // Cek plat nomor duplikat (kecuali motor ini sendiri)
    $check = mysqli_query($conn, "SELECT * FROM motor WHERE plat_nomor = '$plat_nomor' AND id != $id");
    if (mysqli_num_rows($check) > 0) {
        $error = "Plat nomor sudah terdaftar!";
    } else {
        $query = "UPDATE motor SET id_pelanggan=$id_pelanggan, merk='$merk', model='$model', tahun=$tahun, plat_nomor='$plat_nomor', warna='$warna' WHERE id=$id";
        
        if (mysqli_query($conn, $query)) {
            $success = "Data motor berhasil diupdate!";
            $motor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM motor WHERE id = $id LIMIT 1"));
        } else {
            $error = "Gagal mengupdate data: " . mysqli_error($conn);
        }
    }
}
?>

<div class="container" style="max-width: 800px;">
    <div style="margin-bottom: 2rem;">
        <a href="index.php" style="color: var(--steel); text-decoration: none;">← Kembali ke Daftar Motor</a>
        <h2 style="margin-top: 1rem;">✏️ Edit Motor: <?php echo $motor['plat_nomor']; ?></h2>
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
                <label for="id_pelanggan">Pemilik Motor <span style="color: var(--primary-red);">*</span></label>
                <select id="id_pelanggan" name="id_pelanggan" class="form-control" required>
                    <?php while ($p = mysqli_fetch_assoc($pelangganList)): ?>
                        <option value="<?php echo $p['id']; ?>" <?php echo ($motor['id_pelanggan'] == $p['id']) ? 'selected' : ''; ?>>
                            <?php echo $p['nama']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="merk">Merk Motor <span style="color: var(--primary-red);">*</span></label>
                    <select id="merk" name="merk" class="form-control" required>
                        <option value="Honda" <?php echo ($motor['merk'] == 'Honda') ? 'selected' : ''; ?>>Honda</option>
                        <option value="Yamaha" <?php echo ($motor['merk'] == 'Yamaha') ? 'selected' : ''; ?>>Yamaha</option>
                        <option value="Suzuki" <?php echo ($motor['merk'] == 'Suzuki') ? 'selected' : ''; ?>>Suzuki</option>
                        <option value="Kawasaki" <?php echo ($motor['merk'] == 'Kawasaki') ? 'selected' : ''; ?>>Kawasaki</option>
                        <option value="Vespa" <?php echo ($motor['merk'] == 'Vespa') ? 'selected' : ''; ?>>Vespa</option>
                        <option value="Ducati" <?php echo ($motor['merk'] == 'Ducati') ? 'selected' : ''; ?>>Ducati</option>
                        <option value="Harley Davidson" <?php echo ($motor['merk'] == 'Harley Davidson') ? 'selected' : ''; ?>>Harley Davidson</option>
                        <option value="KTM" <?php echo ($motor['merk'] == 'KTM') ? 'selected' : ''; ?>>KTM</option>
                        <option value="BMW" <?php echo ($motor['merk'] == 'BMW') ? 'selected' : ''; ?>>BMW</option>
                        <option value="Lainnya" <?php echo ($motor['merk'] == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="model">Model/Tipe <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" id="model" name="model" class="form-control" value="<?php echo $motor['model']; ?>" required>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="tahun">Tahun Produksi <span style="color: var(--primary-red);">*</span></label>
                    <input type="number" id="tahun" name="tahun" class="form-control" value="<?php echo $motor['tahun']; ?>" min="1980" max="<?php echo date('Y') + 1; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="warna">Warna <span style="color: var(--primary-red);">*</span></label>
                    <input type="text" id="warna" name="warna" class="form-control" value="<?php echo $motor['warna']; ?>" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="plat_nomor">Plat Nomor <span style="color: var(--primary-red);">*</span></label>
                <input type="text" id="plat_nomor" name="plat_nomor" class="form-control" value="<?php echo $motor['plat_nomor']; ?>" required style="text-transform: uppercase; font-weight: 700;">
            </div>
            
            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">💾 Update Data</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>