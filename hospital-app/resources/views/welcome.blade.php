<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Selamat Datang - Sistem Manajemen Rumah Sakit</title>
</head>

<body class="bg-light">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-hospital"></i> Sistem Rumah Sakit
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link btn ms-2 px-3" href="{{ route('auth.login') }}">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container-fluid bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center min-vh-50">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">
                        Sistem Manajemen Rumah Sakit
                    </h1>
                    <p class="lead mb-4">
                        Kelola data rumah sakit dan pasien dengan mudah dan efisien.
                        Sistem terintegrasi untuk manajemen yang lebih baik.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('auth.login') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-sign-in-alt"></i> Mulai Sekarang
                        </a>
                        <button class="btn btn-outline-light btn-lg" data-bs-toggle="modal" data-bs-target="#demoModal">
                            <i class="fas fa-play"></i> Demo
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fas fa-hospital display-1 mb-4 opacity-75"></i>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="card bg-white text-primary">
                                <div class="card-body">
                                    <h3 class="display-6">{{ \App\Models\RumahSakit::count() }}</h3>
                                    <small>Rumah Sakit</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-white text-success">
                                <div class="card-body">
                                    <h3 class="display-6">{{ \App\Models\Pasien::count() }}</h3>
                                    <small>Pasien</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tentang Section -->
    <div class="container py-5" id="tentang">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-5 fw-bold text-primary mb-4">Tentang Sistem</h2>
                <p class="lead text-muted">
                    Sistem ini dibangun untuk memudahkan pengelolaan data rumah sakit dan pasien.
                    Dengan interface yang user-friendly dan fitur yang lengkap.
                </p>
            </div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-hospital text-primary fa-3x mb-3"></i>
                        <h5>Manajemen Rumah Sakit</h5>
                        <p class="text-muted">Kelola data rumah sakit dengan mudah termasuk informasi kontak dan alamat.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-user-injured text-success fa-3x mb-3"></i>
                        <h5>Data Pasien</h5>
                        <p class="text-muted">Sistem pencatatan pasien yang terintegrasi dengan data rumah sakit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-line text-info fa-3x mb-3"></i>
                        <h5>Laporan & Statistik</h5>
                        <p class="text-muted">Dashboard lengkap dengan statistik dan laporan yang informatif.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-primary text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h6><i class="fas fa-hospital"></i> Sistem Rumah Sakit</h6>
                    <p class="text-white mb-0">Manajemen data rumah sakit dan pasien yang efisien.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Demo Modal -->
    <div class="modal fade" id="demoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-play"></i> Demo Akun
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Gunakan akun demo berikut untuk mengakses sistem:</p>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>admin</code></td>
                                    <td><code>password</code></td>
                                    <td><span class="badge bg-primary">Administrator</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{ route('auth.login') }}" class="btn btn-primary">Login Sekarang</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
