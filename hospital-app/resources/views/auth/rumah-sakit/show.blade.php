<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Detail Rumah Sakit - Sistem Manajemen Rumah Sakit</title>
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
                    <a href="{{ route('auth.rumah-sakit.index') }}"
                        class="nav-link text-white bg-primary bg-opacity-75 active">
                        <i class="fas fa-hospital me-2"></i> Rumah Sakit
                    </a>
                    <a href="{{ route('pasien.index') }}" class="nav-link text-white">
                        <i class="fas fa-user-injured me-2"></i> Pasien
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <div class="bg-white shadow-sm p-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-eye text-primary"></i> Detail Rumah Sakit
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
                            <a href="{{ route('auth.rumah-sakit.index') }}">Rumah Sakit</a>
                        </li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </nav>

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-hospital"></i> {{ $rumahSakit->nama_rumah_sakit }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>ID:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ $rumahSakit->id }}
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Nama Rumah Sakit:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ $rumahSakit->nama_rumah_sakit }}
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Alamat:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ $rumahSakit->alamat }}
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Email:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        <a href="mailto:{{ $rumahSakit->email }}">{{ $rumahSakit->email }}</a>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Telepon:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        <a href="tel:{{ $rumahSakit->telepon }}">{{ $rumahSakit->telepon }}</a>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Dibuat pada:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ date('d F Y H:i', strtotime($rumahSakit->created_at)) }} WIB
                                    </div>
                                </div>

                                @if ($rumahSakit->updated_at != $rumahSakit->created_at)
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong>Diupdate pada:</strong>
                                        </div>
                                        <div class="col-md-8">
                                            {{ date('d F Y H:i', strtotime($rumahSakit->updated_at)) }} WIB
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('auth.rumah-sakit.edit', $rumahSakit->id) }}"
                                        class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('auth.rumah-sakit.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
