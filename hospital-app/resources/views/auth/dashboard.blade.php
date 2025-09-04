<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Dashboard - Sistem Manajemen Rumah Sakit</title>
</head>

<body class="bg-light">

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-primary text-white d-flex flex-column" style="width: 250px; min-height: 100vh;">
            <div class="p-3 border-bottom border-white border-opacity-25">
                <h5 class="mb-0">
                    <i class="fas fa-hospital"></i> Sistem Rumah Sakit
                </h5>
            </div>
            <div class="flex-grow-1">
                <nav class="nav flex-column">
                    <a href="{{ url('/dashboard') }}" class="nav-link text-white bg-primary bg-opacity-75 active">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                    <a href="{{ url('/rumah-sakit') }}" class="nav-link text-white">
                        <i class="fas fa-hospital me-2"></i> Rumah Sakit
                    </a>
                    <a href="{{ url('/pasien') }}" class="nav-link text-white">
                        <i class="fas fa-user-injured me-2"></i> Pasien
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <div class="bg-white shadow-sm p-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-tachometer-alt text-primary"></i> Dashboard
                </h4>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle text-primary" href="#" role="button"
                        data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i> {{ Auth::user()->username }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Statistics Cards -->
                <div class="row g-4 mb-4">
                    <!-- Rumah Sakit -->
                    <div class="col-md-6">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">
                                            <i class="fas fa-hospital"></i> Rumah Sakit
                                        </h6>
                                        <h2 class="mb-1">{{ \App\Models\RumahSakit::count() }}</h2>
                                        <small>Total terdaftar</small>
                                    </div>
                                    <i class="fas fa-hospital fa-3x opacity-50"></i>
                                </div>
                            </div>
                            <div class="card-footer bg-primary border-top border-white border-opacity-25">
                                <a href="{{ url('/rumah-sakit') }}" class="text-white text-decoration-none">
                                    <small>Kelola Data <i class="fas fa-arrow-right"></i></small>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Pasien -->
                    <div class="col-md-6">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">
                                            <i class="fas fa-user-injured"></i> Pasien
                                        </h6>
                                        <h2 class="mb-1">{{ \App\Models\Pasien::count() }}</h2>
                                        <small>Total terdaftar</small>
                                    </div>
                                    <i class="fas fa-user-injured fa-3x opacity-50"></i>
                                </div>
                            </div>
                            <div class="card-footer bg-success border-top border-white border-opacity-25">
                                <a href="{{ url('/pasien') }}" class="text-white text-decoration-none">
                                    <small>Kelola Data <i class="fas fa-arrow-right"></i></small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Table -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-chart-line text-info"></i>
                            Statistik Pasien per Rumah Sakit
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Rumah Sakit</th>
                                        <th>Jumlah Pasien</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $rumahSakits = \App\Models\RumahSakit::withCount('pasiens')->get();
                                    @endphp
                                    @forelse($rumahSakits as $rs)
                                        <tr>
                                            <td class="fw-bold">{{ $rs->nama_rumah_sakit }}</td>
                                            <td>
                                                <span class="badge bg-primary">{{ $rs->pasiens_count }}</span>
                                            </td>
                                            <td>{{ Str::limit($rs->alamat, 40) }}</td>
                                            <td>{{ $rs->email }}</td>
                                            <td>{{ $rs->telepon }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                Belum ada data rumah sakit
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
