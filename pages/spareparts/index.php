<?php
// pages/spareparts/index.php
$pageTitle = "Data Spareparts";
require_once '../../auth/auth_check.php';
require_once '../../includes/header.php';

$query = "SELECT * FROM spareparts ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <div class="card-header">
        <div>
            <h2>📦 Data Spareparts</h2>
            <p style="color: var(--steel); opacity: 0.7;">Kelola inventori spareparts dan stok barang</p>
        </div>
        <a href="tambah.php" class="btn btn-primary">➕ Tambah Sparepart</a>
    </div>
    
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Cari sparepart berdasarkan nama atau kategori..." onkeyup="searchTable()">
    </div>
    
    <div class="card" style="padding: 0;">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Sparepart</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><strong>#<?php echo $row['id']; ?></strong></td>
                            <td>
                                <strong><?php echo $row['nama']; ?></strong>
                                <?php if ($row['deskripsi']): ?>
                                    <br><small style="color: var(--steel); opacity: 0.7;"><?php echo substr($row['deskripsi'], 0, 50) . '...'; ?></small>
                                <?php endif; ?>
                            </td>
                            <td><span class="badge badge-info"><?php echo $row['kategori']; ?></span></td>
                            <td>
                                <strong style="<?php echo ($row['stok'] < 10) ? 'color: var(--primary-red);' : ''; ?>">
                                    📦 <?php echo $row['stok']; ?> pcs
                                </strong>
                            </td>
                            <td><strong style="color: #28A745;">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></strong></td>
                            <td>
                                <?php
                                $badgeClass = '';
                                switch($row['status']) {
                                    case 'Ready': $badgeClass = 'badge-success'; break;
                                    case 'Low Stock': $badgeClass = 'badge-warning'; break;
                                    case 'Habis': $badgeClass = 'badge-danger'; break;
                                    default: $badgeClass = 'badge-info';
                                }
                                ?>
                                <span class="badge <?php echo $badgeClass; ?>"><?php echo $row['status']; ?></span>
                            </td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm" style="background: var(--blue); color: white;">✏️ Edit</a>
                                <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus sparepart ini?')">🗑️ Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 3rem; color: var(--steel); opacity: 0.5;">
                            Belum ada data spareparts. <a href="tambah.php" style="color: var(--primary-red);">Tambah sekarang</a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function searchTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toUpperCase();
    const table = document.getElementById('dataTable');
    const tr = table.getElementsByTagName('tr');
    
    for (let i = 1; i < tr.length; i++) {
        let txtValue = tr[i].textContent || tr[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = '';
        } else {
            tr[i].style.display = 'none';
        }
    }
}
</script>

<?php require_once '../../includes/footer.php'; ?>