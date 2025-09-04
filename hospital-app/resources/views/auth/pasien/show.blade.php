<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Detail Pasien - Sistem Manajemen Rumah Sakit</title>
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
                    <a href="{{ route('auth.dashboard') }}" class="nav-link text-white">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('auth.rumah-sakit.index') }}" class="nav-link text-white">
                        <i class="fas fa-hospital me-2"></i> Rumah Sakit
                    </a>
                    <a href="{{ route('auth.pasien.index') }}" class="nav-link text-white bg-primary bg-opacity-75 active">
                        <i class="fas fa-user-injured me-2"></i> Pasien
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <div class="bg-white shadow-sm p-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-eye text-primary"></i> Detail Pasien
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
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('auth.pasien.index') }}">Pasien</a>
                        </li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </nav>

                <div class="row">
                    <!-- Patient Info -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-user-injured"></i> Informasi Pasien
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>ID Pasien:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ $pasien->id }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>Nama Pasien:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ $pasien->nama_pasien }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>Alamat:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ $pasien->alamat }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>No Telepon:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        <a href="tel:{{ $pasien->no_telpon }}">{{ $pasien->no_telpon }}</a>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>Terdaftar pada:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ date('d F Y H:i', strtotime($pasien->created_at)) }} WIB
                                    </div>
                                </div>

                                @if ($pasien->updated_at != $pasien->created_at)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong>Diupdate pada:</strong>
                                        </div>
                                        <div class="col-md-8">
                                            {{ date('d F Y H:i', strtotime($pasien->updated_at)) }} WIB
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Hospital Info -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-hospital"></i> Rumah Sakit Terdaftar
                                </h5>
                            </div>
                            <div class="card-body">
                                @if ($pasien->nama_rumah_sakit)
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <strong>Nama RS:</strong>
                                        </div>
                                        <div class="col-md-8">
                                            {{ $pasien->nama_rumah_sakit }}
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <strong>Alamat RS:</strong>
                                        </div>
                                        <div class="col-md-8">
                                            {{ $pasien->alamat_rumah_sakit }}
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <strong>Email RS:</strong>
                                        </div>
                                        <div class="col-md-8">
                                            <a
                                                href="mailto:{{ $pasien->email_rumah_sakit }}">{{ $pasien->email_rumah_sakit }}</a>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <strong>No Telepon:</strong>
                                        </div>
                                        <div class="col-md-8">
                                            <a href="tel:{{ $pasien->no_telpon }}">{{ $pasien->no_telpon }}</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center text-muted py-4">
                                        <i class="fas fa-exclamation-triangle fa-2x mb-2 d-block"></i>
                                        Pasien belum terdaftar di rumah sakit manapun
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <a href="{{ route('auth.pasien.edit', $pasien->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('auth.pasien.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
