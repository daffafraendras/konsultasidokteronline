<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';

if(isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}

if(isset($_POST['submit_login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password_input = $_POST['password'];
    
    // Cari data user HANYA berdasarkan email terlebih dahulu
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    
    if(mysqli_num_rows($query) > 0){
        $data_user = mysqli_fetch_assoc($query);
        
        // Cek apakah password yang diinput cocok dengan hash di database
        if(password_verify($password_input, $data_user['password'])){
            
            // Jika cocok, buat session
            $_SESSION['role'] = $data_user['role'];
            $_SESSION['nama'] = $data_user['nama'];
            
            if($data_user['role'] == 'admin'){
                echo "<script>window.location.href='admin.php';</script>";
            } else {
                echo "<script>window.location.href='menu.php';</script>";
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