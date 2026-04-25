<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';

if(isset($_SESSION['role'])) {
    header("Location: ../index.html");
    exit;
}

if(isset($_POST['submit'])) { // atau apapun nama tombol submit-mu
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    
    // 👇 TAMBAHKAN BARIS INI (Ini yang tadi hilang/terlupa)
    $password = $_POST['password']; 

    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");

    if(mysqli_num_rows($cek_user) > 0){
        $data_user = mysqli_fetch_assoc($cek_user);
        
        // Sekarang $password sudah ada isinya, jadi error baris 24 akan hilang!
        if (password_verify($password, $data_user['password'])) {
            // ... (kode setcookie dll)
            setcookie("role", $data_user['role'], time() + 86400, "/");
            setcookie("nama", $data_user['nama'], time() + 86400, "/");

            // CEK ROLE LALU ARAHKAN KE HALAMAN YANG BENAR
            if ($data_user['role'] == 'admin') {
                header("Location: admin.php"); // Admin ke admin.php
            } else {
                header("Location: menu.php"); // Guest ke menu.php
            }
            exit;
        } else {
            // Jika password salah
            echo "<script>alert('Password salah! Silakan coba lagi.');</script>";
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