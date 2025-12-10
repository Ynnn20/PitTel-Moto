<?php
// pages/motor/index.php
$pageTitle = "Data Motor";
require_once '../../auth/auth_check.php';
require_once '../../includes/header.php';

// Join dengan tabel pelanggan
$query = "SELECT m.*, p.nama as nama_pelanggan FROM motor m 
          LEFT JOIN pelanggan p ON m.id_pelanggan = p.id 
          ORDER BY m.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <div class="card-header">
        <div>
            <h2>🏍️ Data Motor</h2>
            <p style="color: var(--steel); opacity: 0.7;">Kelola database kendaraan pelanggan</p>
        </div>
        <a href="tambah.php" class="btn btn-primary">➕ Tambah Motor</a>
    </div>
    
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Cari motor berdasarkan plat nomor, merk, atau pemilik..." onkeyup="searchTable()">
    </div>
    
    <div class="card" style="padding: 0;">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Plat Nomor</th>
                    <th>Merk & Model</th>
                    <th>Tahun</th>
                    <th>Warna</th>
                    <th>Pemilik</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><strong>#<?php echo $row['id']; ?></strong></td>
                            <td>
                                <span style="background: var(--asphalt); color: var(--yellow); padding: 0.4rem 0.8rem; border-radius: 6px; font-weight: 700; font-family: monospace;">
                                    <?php echo $row['plat_nomor']; ?>
                                </span>
                            </td>
                            <td>
                                <strong><?php echo $row['merk']; ?></strong> <?php echo $row['model']; ?>
                            </td>
                            <td><?php echo $row['tahun']; ?></td>
                            <td>
                                <span class="badge badge-info"><?php echo $row['warna']; ?></span>
                            </td>
                            <td><?php echo $row['nama_pelanggan']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm" style="background: var(--blue); color: white;">✏️ Edit</a>
                                <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus motor ini?')">🗑️ Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 3rem; color: var(--steel); opacity: 0.5;">
                            Belum ada data motor. <a href="tambah.php" style="color: var(--primary-red);">Tambah sekarang</a>
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