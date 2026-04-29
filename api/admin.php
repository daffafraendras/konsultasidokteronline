<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';

// Proteksi Admin via Cookie
if(!isset($_COOKIE['role']) || $_COOKIE['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// LOGIC SETUJUI JADWAL
if(isset($_GET['setujui'])){
    $id_jadwal = mysqli_real_escape_string($koneksi, $_GET['setujui']);
    // Update status berdasarkan ID
    $query = "UPDATE jadwal SET status='disetujui' WHERE id='$id_jadwal'";
    
    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Jadwal berhasil disetujui!'); window.location.href='admin.php';</script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// LOGIC HAPUS JADWAL
if(isset($_GET['hapus'])){
    $id_jadwal = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    // Hapus baris berdasarkan ID
    $query = "DELETE FROM jadwal WHERE id='$id_jadwal'";
    
    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Jadwal berhasil dihapus!'); window.location.href='admin.php';</script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

include 'header.php'; 
?>

<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color: #006b8f; font-weight: bold;">Panel Admin - Kelola Jadwal</h2>
    </div>

    <div class="glass-panel p-3 p-md-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-nowrap mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Pasien</th>
                        <th>Poli / Dokter</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Mengambil data jadwal dari database diurutkan dari yang paling baru
                    $query = mysqli_query($koneksi, "SELECT * FROM jadwal ORDER BY id DESC");
                    $no = 1;

                    if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_assoc($query)){
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="fw-bold"><?= htmlspecialchars($row['nama_pasien']); ?></td>
                        <td><?= htmlspecialchars(ucfirst($row['dokter_tujuan'])); ?></td>
                        <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                        <td><?= htmlspecialchars($row['waktu']); ?></td>
                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">
                            <?= htmlspecialchars($row['keluhan']); ?>
                        </td>
                        <td>
                            <?php if($row['status'] == 'menunggu'): ?>
                                <span class="badge bg-warning text-dark px-3 py-2">Menunggu</span>
                            <?php else: ?>
                                <span class="badge bg-success px-3 py-2">Disetujui</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <?php if($row['status'] == 'menunggu'): ?>
                                    <a href="admin.php?setujui=<?= $row['id']; ?>" class="btn btn-sm btn-primary px-3">Setujui</a>
                                <?php endif; ?>
                                <a href="admin.php?hapus=<?= $row['id']; ?>" class="btn btn-sm btn-danger px-3" onclick="return confirm('Yakin ingin menghapus jadwal ini?');">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else {
                        echo "<tr><td colspan='8' class='text-center text-muted py-4'>Belum ada jadwal konsultasi yang masuk.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>