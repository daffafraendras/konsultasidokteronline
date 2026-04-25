<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';

if(isset($_SESSION['role'])) {
    header("Location: ../index.html");
    exit;
}

if(isset($_POST['submit_register'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']); 
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password_mentah = $_POST['password'];
    
    // Proses Hashing Password
    $password_hashed = password_hash($password_mentah, PASSWORD_DEFAULT);
    
    $cek_email = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");
    
    if(mysqli_num_rows($cek_email) > 0){
        echo "<script>alert('Email sudah terdaftar! Silakan gunakan email lain atau Login.');</script>";
    } else {
        // Simpan password yang sudah di-hash ke database
        $query_simpan = "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$password_hashed', 'guest')";
        
        if(mysqli_query($koneksi, $query_simpan)){
            $_SESSION['role'] = 'guest';
            $_SESSION['nama'] = $nama;
            
            echo "<script>
                    alert('Pendaftaran berhasil! Selamat datang, $nama.');
                    window.location.href='menu.php';
                  </script>";
            exit;
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
    }
}

include 'header.php'; 
?>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-5">
            <div class="glass-panel">
                <h3 class="mb-4 text-center" style="color: #006b8f;">Daftar Akun Baru</h3>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control glass-input" placeholder="Nama Anda" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control glass-input" placeholder="user@email.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control glass-input" placeholder="Buat Password" required>
                    </div>
                    
                    <button type="submit" name="submit_register" class="btn btn-glass w-100">Daftar Sekarang</button>
                    <p class="text-center mt-3">Sudah punya akun? <a href="login.php">Login di sini</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>