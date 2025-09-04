<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Tambah Rumah Sakit - Sistem Manajemen Rumah Sakit</title>
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
                    {{-- <a href="{{ route('auth.pasien.index') }}" class="nav-link text-white">
                        <i class="fas fa-user-injured me-2"></i> Pasien
                    </a> --}}
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <div class="bg-white shadow-sm p-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-plus text-primary"></i> Tambah Rumah Sakit
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
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </nav>

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Form Tambah Rumah Sakit</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('auth.rumah-sakit.store') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="nama_rumah_sakit" class="form-label">
                                            Nama Rumah Sakit <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('nama_rumah_sakit') is-invalid @enderror"
                                            id="nama_rumah_sakit" name="nama_rumah_sakit"
                                            value="{{ old('nama_rumah_sakit') }}" required>
                                        @error('nama_rumah_sakit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">
                                            Alamat <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                            required>{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">
                                            Email <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="telepon" class="form-label">
                                            Telepon <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('telepon') is-invalid @enderror" id="telepon"
                                            name="telepon" value="{{ old('telepon') }}" required>
                                        @error('telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Simpan
                                        </button>
                                        <a href="{{ route('auth.rumah-sakit.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                    </div>
                                </form>
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
