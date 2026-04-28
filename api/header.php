<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Konsultasi Medis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0f2f1 0%, #b2ebf2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-glass {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            padding: 15px 0;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        .btn-glass {
            background: rgba(0, 107, 143, 0.8);
            color: white;
            border-radius: 10px;
            border: none;
            transition: 0.3s;
        }
        .btn-glass:hover {
            background: rgba(0, 107, 143, 1);
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-glass mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php" style="color: #006b8f;">🩺 MedisConsult</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if(isset($_COOKIE['role'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ($_COOKIE['role'] == 'admin') ? 'admin.php' : 'menu.php'; ?>">Dashboard</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <span class="nav-link fw-bold" style="color: #006b8f;">Hi, <?= $_COOKIE['nama']; ?>!</span>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="logout.php" class="btn btn-danger btn-sm rounded-pill px-3">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="login.php" class="btn btn-glass btn-sm px-4">Login</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="register.php" class="btn btn-outline-primary btn-sm rounded-pill px-4">Daftar</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>