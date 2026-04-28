<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokter Kita - Telemedicine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-glass sticky-top mb-5">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="../logo.png" alt="Logo" style="height: 40px;">
                <?php if(isset($_COOKIE['role']) && $_COOKIE['role'] == 'admin'): ?>
                    <span class="ms-2 fw-bold text-danger">ADMIN</span>
                <?php endif; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="../index.html">Home</a></li>
                    
                    <?php if(!isset($_COOKIE['role'])): ?>
                        <li class="nav-item"><a class="btn btn-glass ms-lg-3" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="btn btn-glass ms-lg-2" href="register.php">Register</a></li>
                    
                    <?php elseif($_COOKIE['role'] == 'guest'): ?>
                        <li class="nav-item"><a class="btn btn-glass ms-lg-3" href="menu.php">💬 Konsultasi</a></li>
                        <li class="nav-item"><a class="nav-link text-danger ms-lg-2 fw-bold" href="logout.php">Logout</a></li>
                    
                    <?php elseif($_COOKIE['role'] == 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="admin.php">Panel Admin</a></li>
                        <li class="nav-item"><a class="btn btn-glass ms-lg-3 text-danger" href="logout.php">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>