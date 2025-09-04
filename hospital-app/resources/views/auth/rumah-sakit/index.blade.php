<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Data Rumah Sakit - Sistem Manajemen Rumah Sakit</title>
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
                    <i class="fas fa-hospital text-primary"></i> Data Rumah Sakit
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
                <!-- Alert Messages -->
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

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1">Daftar Rumah Sakit</h5>
                        <p class="text-muted mb-0">Kelola data rumah sakit yang terdaftar</p>
                    </div>
                    <a href="{{ route('auth.rumah-sakit.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Rumah Sakit
                    </a>
                </div>

                <!-- Data Table -->
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" width="80">No</th>
                                        <th>Nama Rumah Sakit</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th class="text-center" width="150">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rumahSakits as $index => $rs)
                                        <tr id="row-{{ $rs->id }}">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="fw-bold">{{ $rs->nama_rumah_sakit }}</td>
                                            <td>{{ Str::limit($rs->alamat, 50) }}</td>
                                            <td>{{ $rs->email }}</td>
                                            <td>{{ $rs->telepon }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('auth.rumah-sakit.show', $rs->id) }}"
                                                        class="btn btn-sm btn-primary" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('auth.rumah-sakit.edit', $rs->id) }}"
                                                        class="btn btn-sm btn-warning text-white" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                        data-id="{{ $rs->id }}"
                                                        data-name="{{ $rs->nama_rumah_sakit }}" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                Belum ada data rumah sakit
                                                <br>
                                                <a href="{{ route('auth.rumah-sakit.create') }}"
                                                    class="btn btn-primary btn-sm mt-2">
                                                    <i class="fas fa-plus"></i> Tambah Data Pertama
                                                </a>
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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus rumah sakit <strong id="delete-name"></strong>?</p>
                    <p class="text-muted">Data yang dihapus tidak dapat dikembalikan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // AJAX Setup
        document.addEventListener('DOMContentLoaded', function() {
            // Setup CSRF token for AJAX
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Delete functionality
            let deleteId = null;
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

            // Handle delete button click
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function() {
                    deleteId = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    document.getElementById('delete-name').textContent = name;
                    deleteModal.show();
                });
            });

            // Handle confirm delete
            document.getElementById('confirm-delete').addEventListener('click', function() {
                if (deleteId) {
                    // Show loading
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
                    this.disabled = true;

                    fetch(`/rumah-sakit/${deleteId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Remove row from table
                                document.getElementById(`row-${deleteId}`).remove();

                                // Show success message
                                showAlert('success', data.message);

                                deleteModal.hide();
                            } else {
                                showAlert('danger', data.message);
                            }
                        })
                        .catch(error => {
                            showAlert('danger', 'Terjadi kesalahan saat menghapus data');
                        })
                        .finally(() => {
                            // Reset button
                            this.innerHTML = '<i class="fas fa-trash"></i> Hapus';
                            this.disabled = false;
                            deleteId = null;
                        });
                }
            });

            // Function to show alert
            function showAlert(type, message) {
                const alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;

                const contentArea = document.querySelector('.p-4');
                contentArea.insertAdjacentHTML('afterbegin', alertHtml);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    const alert = contentArea.querySelector('.alert');
                    if (alert) {
                        alert.remove();
                    }
                }, 5000);
            }
        });
    </script>
</body>

</html>
