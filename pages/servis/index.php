<?php
// pages/servis/index.php
$pageTitle = "Data Servis";
require_once '../../auth/auth_check.php';
require_once '../../includes/header.php';

$query = "SELECT s.*, m.plat_nomor, m.merk, m.model, mk.nama as nama_mekanik, p.nama as nama_pelanggan 
          FROM servis s 
          JOIN motor m ON s.id_motor = m.id 
          JOIN mekanik mk ON s.id_mekanik = mk.id 
          JOIN pelanggan p ON m.id_pelanggan = p.id 
          ORDER BY s.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <div class="card-header">
        <div>
            <h2>📋 Data Servis</h2>
            <p style="color: var(--steel); opacity: 0.7;">Tracking dan monitoring servis motor</p>
        </div>
        <a href="tambah.php" class="btn btn-primary">➕ Buat Servis Baru</a>
    </div>
    
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Cari servis berdasarkan plat nomor, pelanggan, atau mekanik..." onkeyup="searchTable()">
    </div>
    
    <div class="card" style="padding: 0;">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Plat Nomor</th>
                    <th>Pelanggan</th>
                    <th>Mekanik</th>
                    <th>Jenis Servis</th>
                    <th>Tanggal Masuk</th>
                    <th>Biaya</th>
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
                                <span style="background: var(--asphalt); color: var(--yellow); padding: 0.4rem 0.8rem; border-radius: 6px; font-weight: 700; font-family: monospace;">
                                    <?php echo $row['plat_nomor']; ?>
                                </span>
                                <br>
                                <small style="color: var(--steel); opacity: 0.7;"><?php echo $row['merk'] . ' ' . $row['model']; ?></small>
                            </td>
                            <td><?php echo $row['nama_pelanggan']; ?></td>
                            <td><?php echo $row['nama_mekanik']; ?></td>
                            <td><?php echo $row['jenis_servis']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['tanggal_masuk'])); ?></td>
                            <td><strong style="color: #28A745;">Rp <?php echo number_format($row['biaya'], 0, ',', '.'); ?></strong></td>
                            <td>
                                <?php
                                $badgeClass = '';
                                switch($row['status']) {
                                    case 'Selesai': $badgeClass = 'badge-success'; break;
                                    case 'Sedang Dikerjakan': $badgeClass = 'badge-info'; break;
                                    case 'Menunggu': $badgeClass = 'badge-warning'; break;
                                    case 'Diambil': $badgeClass = 'badge-success'; break;
                                    default: $badgeClass = 'badge-info';
                                }
                                ?>
                                <span class="badge <?php echo $badgeClass; ?>"><?php echo $row['status']; ?></span>
                            </td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm" style="background: var(--blue); color: white;">✏️ Edit</a>
                                <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data servis ini?')">🗑️ Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 3rem; color: var(--steel); opacity: 0.5;">
                            Belum ada data servis. <a href="tambah.php" style="color: var(--primary-red);">Buat servis baru</a>
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