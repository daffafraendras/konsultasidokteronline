<?php
include 'header.php';

// Cek apakah pengguna sudah login
if (!isset($_COOKIE['role'])) {
    header("Location: login.php");
    exit;
}

// Ambil data dari API BPS
$api_response = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . '/telemedicine/api/api_bps.php');
$data_bps = json_decode($api_response, true);
?>

    <div class="container">
        <div class="glass-panel">
            <div class="mb-4">
                <h1 class="mb-3">
                    Selamat Datang, <span class="text-primary"><?php echo htmlspecialchars($_COOKIE['nama'] ?? 'Pengguna'); ?></span>
                </h1>
                <p class="text-muted">Role: <strong><?php echo htmlspecialchars($_COOKIE['role'] ?? 'User'); ?></strong></p>
            </div>

            <hr class="my-4">

            <h3 class="mb-4">Data BPS - Statistik Indonesia</h3>
            
            <?php if (is_array($data_bps) && count($data_bps) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-glass">
                        <thead>
                            <tr>
                                <th>Wilayah</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_bps as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['wilayah']); ?></td>
                                    <td><?php echo htmlspecialchars($item['nilai']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    Gagal memuat data BPS. Silakan coba lagi nanti.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>