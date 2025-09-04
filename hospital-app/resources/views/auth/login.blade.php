<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Login - Sistem Manajemen Rumah Sakit</title>
</head>

<body class="bg-light">

    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="text-center mb-3">
                    <a href="{{ url('/') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                    </a>
                </div>

                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h3 class="mb-2">
                            <i class="fas fa-hospital fa-2x"></i>
                        </h3>
                        <h4 class="mb-1">Login Sistem</h4>
                        <p class="mb-0 small">Manajemen Rumah Sakit</p>
                    </div>

                    <div class="card-body p-4">
                        @if ($errors->has('auth.login'))
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('auth.login') }}
                            </div>
                        @endif

                        <form action="{{ route('auth.login') }}" method="POST" id="loginForm">
                            @csrf

                            <div class="mb-3">
                                <label for="username" class="form-label">
                                    <i class="fas fa-user"></i> Username
                                </label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username') }}" required autofocus
                                    placeholder="Masukkan username">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Password
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required placeholder="Masukkan password">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Ingat saya
                                </label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg" id="loginBtn">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer text-center text-muted py-3">
                        <small>
                            <i class="fas fa-info-circle"></i>
                            Silakan login dengan username dan password yang valid
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Toggle password visibility
            $('#togglePassword').click(function() {
                const passwordField = $('#password');
                const eyeIcon = $('#eyeIcon');

                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Form validation
            $('#loginForm').submit(function(e) {
                const username = $('#username').val().trim();
                const password = $('#password').val().trim();

                if (!username || !password) {
                    e.preventDefault();
                    alert('Username dan password harus diisi!');
                    return false;
                }

                // Change button state
                $('#loginBtn').html('<i class="fas fa-spinner fa-spin"></i> Memproses...').prop('disabled',
                    true);
            });
        });
    </script>
</body>

</html>
