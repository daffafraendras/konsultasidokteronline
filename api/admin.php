<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';

// Mengecek apakah yang akses benar admin
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Logc untuk Menyetujui Jadwal
if(isset($_GET['setujui'])){
    $id_jadwal = $_GET['setujui'];
    mysqli_query($conn, "UPDATE jadwal SET status='disetujui' WHERE id='$id_jadwal'");
    echo "<script>alert('Jadwal berhasil disetujui!'); window.location.href='admin.php';</script>";
    exit;
}

// Logic untuk Menghapus Jadwal
if(isset($_GET['hapus'])){
    $id_jadwal = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM jadwal WHERE id='$id_jadwal'");
    echo "<script>alert('Jadwal berhasil dihapus!'); window.location.href='admin.php';</script>";
    exit;
}

include 'header.php'; 
?>

<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color: #006b8f;">Panel Admin - Kelola Jadwal</h2>
    </div>

    <div class="glass-panel p-4" style="overflow-x: auto;">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Poli / Dokter</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Keluhan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Mengambil data jadwal dari database diurutkan dari yang paling baru
                $query = mysqli_query($conn, "SELECT * FROM jadwal ORDER BY id DESC");
                $no = 1;

                if(mysqli_num_rows($query) > 0){
                    while($row = mysqli_fetch_assoc($query)){
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td class="fw-bold"><?= htmlspecialchars($row['nama_pasien']); ?></td>
                    <td><?= htmlspecialchars(ucfirst($row['dokter_tujuan'])); ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                    <td><?= htmlspecialchars($row['waktu']); ?></td>
                    <td><?= htmlspecialchars($row['keluhan']); ?></td>
                    <td>
                        <?php if($row['status'] == 'menunggu'): ?>
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        <?php else: ?>
                            <span class="badge bg-success">Disetujui</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($row['status'] == 'menunggu'): ?>
                            <a href="admin.php?setujui=<?= $row['id']; ?>" class="btn btn-sm btn-primary">Setujui</a>
                        <?php endif; ?>
                        <a href="admin.php?hapus=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus jadwal ini?');">Hapus</a>
                    </td>
                </tr>
                <?php 
                    } 
                } else {
                    echo "<tr><td colspan='8' class='text-center text-muted'>Belum ada jadwal konsultasi yang masuk.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>