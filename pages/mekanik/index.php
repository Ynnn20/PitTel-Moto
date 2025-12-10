<?php
// pages/mekanik/index.php
$pageTitle = "Data Mekanik";
require_once '../../auth/auth_check.php';
require_once '../../includes/header.php';

$query = "SELECT * FROM mekanik ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <div class="card-header">
        <div>
            <h2>🔧 Data Mekanik</h2>
            <p style="color: var(--steel); opacity: 0.7;">Kelola informasi mekanik profesional</p>
        </div>
        <a href="tambah.php" class="btn btn-primary">➕ Tambah Mekanik</a>
    </div>
    
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Cari mekanik berdasarkan nama atau spesialisasi..." onkeyup="searchTable()">
    </div>
    
    <div class="card" style="padding: 0;">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Spesialisasi</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><strong>#<?php echo $row['id']; ?></strong></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><span class="badge badge-info"><?php echo $row['spesialisasi']; ?></span></td>
                            <td><?php echo $row['telepon']; ?></td>
                            <td><?php echo $row['email'] ?: '-'; ?></td>
                            <td>
                                <?php
                                $badgeClass = $row['status'] == 'Aktif' ? 'badge-success' : 
                                             ($row['status'] == 'Cuti' ? 'badge-warning' : 'badge-danger');
                                ?>
                                <span class="badge <?php echo $badgeClass; ?>"><?php echo $row['status']; ?></span>
                            </td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm" style="background: var(--blue); color: white;">✏️ Edit</a>
                                <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus mekanik ini?')">🗑️ Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 3rem; color: var(--steel); opacity: 0.5;">
                            Belum ada data mekanik. <a href="tambah.php" style="color: var(--primary-red);">Tambah sekarang</a>
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