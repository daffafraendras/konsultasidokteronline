<?php
// Session start tidak terlalu dibutuhkan lagi jika pakai cookie murni, tapi biarkan saja aman.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// SATPAM SEKARANG MENGECEK COOKIE
if(!isset($_COOKIE['role']) || $_COOKIE['role'] == 'admin') {
    header("Location: login.php");
    exit;
}

include 'header.php'; 
?>
 
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 glass-panel text-center">
            <h2 class="mb-4" style="color: #006b8f;">Pilih Kategori Konsultasi</h2>
            <div class="row mt-4">
                
                <div class="col-md-4 mb-3">
                    <div class="p-4 border rounded h-100" style="background: rgba(255,255,255,0.4); border-color: rgba(255,255,255,0.8) !important;">
                        <h4>👨‍⚕️ Dokter Umum</h4>
                        <p class="small text-muted">Konsultasi gejala ringan, flu, demam, dan anjuran obat awal.</p>
                        <a href="jadwal.php?dokter=umum" class="btn btn-sm btn-glass mt-2">Pilih & Buat Jadwal</a>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="p-4 border rounded h-100" style="background: rgba(255,255,255,0.4); border-color: rgba(255,255,255,0.8) !important;">
                        <h4>👩‍⚕️ Spesialis Anak</h4>
                        <p class="small text-muted">Layanan tumbuh kembang, imunisasi, dan kesehatan balita.</p>
                        <a href="jadwal.php?dokter=anak" class="btn btn-sm btn-glass mt-2">Pilih & Buat Jadwal</a>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="p-4 border rounded h-100" style="background: rgba(255,255,255,0.4); border-color: rgba(255,255,255,0.8) !important;">
                        <h4>🧠 Psikolog</h4>
                        <p class="small text-muted">Dukungan kesehatan mental, stres, kecemasan, dan terapi.</p>
                        <a href="jadwal.php?dokter=psikolog" class="btn btn-sm btn-glass mt-2">Pilih & Buat Jadwal</a>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="p-4 border rounded h-100" style="background: rgba(255,255,255,0.4); border-color: rgba(255,255,255,0.8) !important;">
                        <h4>🦷 Dokter Gigi</h4>
                        <p class="small text-muted">Konsultasi sakit gigi, gusi bengkak, dan perawatan mulut.</p>
                        <a href="jadwal.php?dokter=gigi" class="btn btn-sm btn-glass mt-2">Pilih & Buat Jadwal</a>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="p-4 border rounded h-100" style="background: rgba(255,255,255,0.4); border-color: rgba(255,255,255,0.8) !important;">
                        <h4>✨ Spesialis Kulit</h4>
                        <p class="small text-muted">Penanganan jerawat, alergi kulit, dan estetika wajah.</p>
                        <a href="jadwal.php?dokter=kulit" class="btn btn-sm btn-glass mt-2">Pilih & Buat Jadwal</a>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="p-4 border rounded h-100" style="background: rgba(255,255,255,0.4); border-color: rgba(255,255,255,0.8) !important;">
                        <h4>❤️ Penyakit Dalam</h4>
                        <p class="small text-muted">Konsultasi diabetes, hipertensi, asam lambung, dll.</p>
                        <a href="jadwal.php?dokter=dalam" class="btn btn-sm btn-glass mt-2">Pilih & Buat Jadwal</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>