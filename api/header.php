<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokter Kita - Telemedicine</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            /* Path ke gambar latar di luar folder api */
            background: url('../latar.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding-bottom: 50px;
            color: #1a1a1a;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(255, 255, 255, 0.3);
            z-index: -1;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .navbar-glass {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        
        .nav-link {
            color: #006b8f !important;
            font-weight: 600;
        }
        
        .nav-link:hover {
            color: #0099cc !important;
        }

        .btn-glass {
            background: rgba(0, 153, 204, 0.7);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: #fff;
            border-radius: 10px;
            font-weight: bold;
            transition: 0.3s;
            text-decoration: none;
            padding: 8px 20px;
            display: inline-block;
        }
        
        .btn-glass:hover {
            background: rgba(0, 107, 143, 0.9);
            color: #fff;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-glass sticky-top mb-5">
        <div class="container">
            <a class="navbar-brand" href="../index.html">
                <img src="../logo.png" alt="Logo" style="height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="../index.html">Home</a></li>
                    
                    <?php if(isset($_COOKIE['nama'])): ?>
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
                        <li class="nav-item"><a class="btn btn-glass ms-lg-3" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="btn btn-glass ms-lg-2" href="register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>