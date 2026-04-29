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
        <h2 style="color: #006b8f; font-weight: bold;">Panel Admin</h2>
    </div>

    <div class="glass-panel p-2 p-md-4">
        <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
            <thead class="table-dark">
                <tr>
                    <th class="p-1 text-center" style="width: 5%;">No</th>
                    <th class="p-1" style="width: 20%;">Pasien</th>
                    <th class="p-1 d-none d-md-table-cell">Poli/Dokter</th> <th class="p-1">Tanggal</th>
                    <th class="p-1 d-none d-sm-table-cell">Waktu</th> <th class="p-1">Keluhan</th>
                    <th class="p-1 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = mysqli_query($koneksi, "SELECT * FROM jadwal ORDER BY id DESC");
                $no = 1;
                if(mysqli_num_rows($query) > 0){
                    while($row = mysqli_fetch_assoc($query)){
                ?>
                <tr>
                    <td class="text-center p-1"><?= $no++; ?></td>
                    <td class="p-1">
                        <div class="fw-bold text-wrap" style="max-width: 80px;"><?= htmlspecialchars($row['nama_pasien']); ?></div>
                    </td>
                    <td class="p-1 d-none d-md-table-cell"><?= htmlspecialchars(ucfirst($row['dokter_tujuan'])); ?></td>
                    <td class="p-1" style="font-size: 0.75rem;"><?= date('d/m', strtotime($row['tanggal'])); ?></td>
                    <td class="p-1 d-none d-sm-table-cell"><?= htmlspecialchars($row['waktu']); ?></td>
                    <td class="p-1">
                        <div class="text-wrap" style="max-width: 100px; font-size: 0.75rem; line-height: 1.2;">
                            <?= htmlspecialchars($row['keluhan']); ?>
                        </div>
                    </td>
                    <td class="p-1 text-center">
                        <div class="d-flex flex-column gap-1">
                            <?php if($row['status'] == 'menunggu'): ?>
                                <a href="admin.php?setujui=<?= $row['id']; ?>" class="btn btn-xs btn-primary" style="font-size: 0.7rem; padding: 2px 5px;">Setujui</a>
                            <?php endif; ?>
                            <a href="admin.php?hapus=<?= $row['id']; ?>" class="btn btn-xs btn-danger" style="font-size: 0.7rem; padding: 2px 5px;" onclick="return confirm('Hapus?');">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php 
                    } 
                } else {
                    echo "<tr><td colspan='7' class='text-center py-4'>Kosong</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>