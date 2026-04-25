<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';

// 1. UBAH DI SINI: Gunakan $_COOKIE, bukan $_SESSION
if(!isset($_COOKIE['role']) || $_COOKIE['role'] != 'guest') {
    header("Location: login.php");
    exit;
}

// Menangkap parameter 'dokter' dari URL jika ada
$dokter_pilihan = isset($_GET['dokter']) ? $_GET['dokter'] : '';

// Proses simpan jadwal ke database saat tombol Konfirmasi ditekan
// Proses simpan jadwal ke database saat tombol Konfirmasi ditekan
if(isset($_POST['submit_jadwal'])){
    
    // Ambil nama dari $_COOKIE
    $nama_pasien = $_COOKIE['nama']; 
    
    // UBAH DI SINI: Gunakan $koneksi, bukan $conn
    $dokter_tujuan = mysqli_real_escape_string($koneksi, $_POST['dokter_tujuan']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $waktu = mysqli_real_escape_string($koneksi, $_POST['waktu']);
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);

    // Simpan ke database
    $query = "INSERT INTO jadwal (nama_pasien, dokter_tujuan, tanggal, waktu, keluhan, status) 
              VALUES ('$nama_pasien', '$dokter_tujuan', '$tanggal', '$waktu', '$keluhan', 'menunggu')";
    
    // UBAH DI SINI JUGA: Gunakan $koneksi
    if(mysqli_query($koneksi, $query)){
        echo "<script>
                alert('Jadwal berhasil diajukan! Menunggu konfirmasi admin.');
                window.location.href='menu.php';
              </script>";
        exit;
    } else {
        echo "<script>alert('Gagal mengajukan jadwal. Silakan coba lagi.');</script>";
    }
}

include 'header.php'; 
?>

<div class="container">
    <div class="row justify-content-center mt-4 mb-5">
        <div class="col-md-8 glass-panel">
            <h2 class="mb-4 text-center" style="color: #006b8f;">Atur Jadwal Konsultasi</h2>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Pilih Dokter</label>
                        <select name="dokter_tujuan" class="form-select glass-input" required>
                            <option value="">-- Silakan Pilih --</option>
                            <option value="umum" <?= ($dokter_pilihan == 'umum') ? 'selected' : ''; ?>>Dr. Andi (Dokter Umum)</option>
                            <option value="anak" <?= ($dokter_pilihan == 'anak') ? 'selected' : ''; ?>>Dr. Sarahvi (Spesialis Anak)</option>
                            <option value="psikolog" <?= ($dokter_pilihan == 'psikolog') ? 'selected' : ''; ?>>Dr. Citra (Psikolog Klinis)</option>
                            <option value="gigi" <?= ($dokter_pilihan == 'gigi') ? 'selected' : ''; ?>>Drg. Budiono (Dokter Gigi)</option>
                            <option value="kulit" <?= ($dokter_pilihan == 'kulit') ? 'selected' : ''; ?>>Dr. Diana (Spesialis Kulit)</option>
                            <option value="dalam" <?= ($dokter_pilihan == 'dalam') ? 'selected' : ''; ?>>Dr. Ekoju (Penyakit Dalam)</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control glass-input" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Waktu Konsultasi</label>
                        <select name="waktu" class="form-select glass-input" required>
                            <option value="">-- Pilih Waktu --</option>
                            <option value="09:00">09:00 - 10:00 WIB</option>
                            <option value="13:00">13:00 - 14:00 WIB</option>
                            <option value="16:00">16:00 - 17:00 WIB</option>
                            <option value="19:00">19:00 - 20:00 WIB</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Keluhan Singkat</label>
                        <textarea name="keluhan" class="form-control glass-input" rows="2" placeholder="Tuliskan keluhan Anda..." required></textarea>
                    </div>

                </div>
                <button type="submit" name="submit_jadwal" class="btn btn-glass w-100 mt-4">Konfirmasi Jadwal</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>