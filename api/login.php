<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// SATPAM LOGIN: Kalau sudah punya cookie, langsung pindahkan!
if (isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 'admin') {
        header("Location: admin.php");
        exit;
    } else {
        header("Location: menu.php");
        exit;
    }
}

include 'koneksi.php';

if(isset($_POST['submit'])) { // atau apapun nama tombol submit-mu
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    
    // 👇 TAMBAHKAN BARIS INI (Ini yang tadi hilang/terlupa)
    $password = $_POST['password']; 

    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");

    if(mysqli_num_rows($cek_user) > 0){
        $data_user = mysqli_fetch_assoc($cek_user);
        
        // Sekarang $password sudah ada isinya, jadi error baris 24 akan hilang!
        // ... kode di atasnya ...
        if (password_verify($password, $data_user['password'])) {
            // 1. SET COOKIE (Pastikan tidak ada 'echo' sebelum baris ini)
            setcookie("role", $data_user['role'], time() + 86400, "/");
            setcookie("nama", $data_user['nama'], time() + 86400, "/");

            // 2. PENGALIHAN YANG AMAN UNTUK VERCEL
            if ($data_user['role'] == 'admin') {
                echo "<script>alert('Login berhasil sebagai Admin!');</script>";
                header("Refresh: 0; URL=admin.php");
            } else {
                echo "<script>alert('Login berhasil! Selamat datang.');</script>";
                header("Refresh: 0; URL=menu.php");
            }
            exit; // Wajib ada exit agar kode di bawahnya berhenti dieksekusi
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        // Jika email tidak ditemukan
        echo "<script>alert('Akun dengan email tersebut tidak ditemukan!');</script>";
    }
}

include 'header.php'; 
?>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-5">
            <div class="glass-panel">
                <h3 class="mb-4 text-center" style="color: #006b8f;">Login Akun</h3>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control glass-input" placeholder="contohuser@email.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control glass-input" placeholder="Masukkan Password" required>
                    </div>
                    <button type="submit" name="submit_login" class="btn btn-glass w-100">Masuk</button>
                    <p class="text-center mt-3">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>