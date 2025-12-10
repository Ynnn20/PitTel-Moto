<?php
// pages/dashboard.php
$pageTitle = "Dashboard";
require_once '../auth/auth_check.php';
require_once '../includes/header.php';

// Ambil statistik
$totalPelanggan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pelanggan"))['total'];
$totalMekanik = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mekanik WHERE status='Aktif'"))['total'];
$totalMotor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM motor"))['total'];
$totalServisBulanIni = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM servis WHERE MONTH(tanggal_masuk) = MONTH(CURRENT_DATE()) AND YEAR(tanggal_masuk) = YEAR(CURRENT_DATE())"))['total'];
$totalSpareparts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM spareparts WHERE status='Ready'"))['total'];

// Ambil servis terbaru
$queryServis = "SELECT s.*, m.plat_nomor, mk.nama as nama_mekanik, p.nama as nama_pelanggan 
                FROM servis s 
                JOIN motor m ON s.id_motor = m.id 
                JOIN mekanik mk ON s.id_mekanik = mk.id 
                JOIN pelanggan p ON m.id_pelanggan = p.id 
                ORDER BY s.created_at DESC 
                LIMIT 5";
$recentServis = mysqli_query($conn, $queryServis);
?>

<div class="container">
    <div style="margin-bottom: 2rem;">
        <h2>Dashboard PitTel Moto</h2>
        <p style="color: var(--steel); opacity: 0.7;">Selamat datang, <?php echo $_SESSION['user_nama']; ?>! 👋</p>
    </div>
    
    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="icon">👥</div>
            <h4><?php echo $totalPelanggan; ?></h4>
            <p>Total Pelanggan</p>
            <a href="pelanggan/" style="color: var(--primary-red); font-size: 0.85rem; margin-top: 0.5rem; display: inline-block;">Lihat Detail →</a>
        </div>
        
        <div class="stat-card" style="border-left-color: var(--primary-red);">
            <div class="icon">🔧</div>
            <h4><?php echo $totalMekanik; ?></h4>
            <p>Mekanik Aktif</p>
            <a href="mekanik/" style="color: var(--primary-red); font-size: 0.85rem; margin-top: 0.5rem; display: inline-block;">Lihat Detail →</a>
        </div>
        
        <div class="stat-card" style="border-left-color: var(--yellow);">
            <div class="icon" style="background: linear-gradient(135deg, var(--yellow), #F0B429);">🏍️</div>
            <h4><?php echo $totalMotor; ?></h4>
            <p>Motor Terdaftar</p>
            <a href="motor/" style="color: var(--primary-red); font-size: 0.85rem; margin-top: 0.5rem; display: inline-block;">Lihat Detail →</a>
        </div>
        
        <div class="stat-card" style="border-left-color: #28A745;">
            <div class="icon" style="background: linear-gradient(135deg, #28A745, #20C997);">📋</div>
            <h4><?php echo $totalServisBulanIni; ?></h4>
            <p>Servis Bulan Ini</p>
            <a href="servis/" style="color: var(--primary-red); font-size: 0.85rem; margin-top: 0.5rem; display: inline-block;">Lihat Detail →</a>
        </div>
        
        <div class="stat-card" style="border-left-color: var(--blue);">
            <div class="icon" style="background: linear-gradient(135deg, var(--blue), #0056D2);">📦</div>
            <h4><?php echo $totalSpareparts; ?></h4>
            <p>Spareparts Ready</p>
            <a href="spareparts/" style="color: var(--primary-red); font-size: 0.85rem; margin-top: 0.5rem; display: inline-block;">Lihat Detail →</a>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="card">
        <h3 style="margin-bottom: 1.5rem;">⚡ Aksi Cepat</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
            <a href="pelanggan/tambah.php" class="btn btn-primary">➕ Tambah Pelanggan</a>
            <a href="mekanik/tambah.php" class="btn btn-primary">➕ Tambah Mekanik</a>
            <a href="motor/tambah.php" class="btn btn-primary">➕ Tambah Motor</a>
            <a href="spareparts/tambah.php" class="btn btn-primary">➕ Tambah Sparepart</a>
            <a href="servis/tambah.php" class="btn btn-primary">➕ Buat Servis Baru</a>
        </div>
    </div>
    
    <!-- Recent Services -->
    <div class="card">
        <div class="card-header">
            <h3>📋 Servis Terbaru</h3>
            <a href="servis/" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Plat Nomor</th>
                    <th>Pelanggan</th>
                    <th>Mekanik</th>
                    <th>Jenis Servis</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($recentServis) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($recentServis)): ?>
                        <tr>
                            <td><strong><?php echo $row['plat_nomor']; ?></strong></td>
                            <td><?php echo $row['nama_pelanggan']; ?></td>
                            <td><?php echo $row['nama_mekanik']; ?></td>
                            <td><?php echo $row['jenis_servis']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['tanggal_masuk'])); ?></td>
                            <td>
                                <?php
                                $badgeClass = '';
                                switch($row['status']) {
                                    case 'Selesai': $badgeClass = 'badge-success'; break;
                                    case 'Sedang Dikerjakan': $badgeClass = 'badge-info'; break;
                                    case 'Menunggu': $badgeClass = 'badge-warning'; break;
                                    default: $badgeClass = 'badge-info';
                                }
                                ?>
                                <span class="badge <?php echo $badgeClass; ?>"><?php echo $row['status']; ?></span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; color: var(--steel); opacity: 0.5;">Belum ada data servis</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>