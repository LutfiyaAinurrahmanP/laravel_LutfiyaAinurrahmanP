<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Data Pasien - Sistem Manajemen Rumah Sakit</title>
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
                    <a href="{{ route('auth.pasien.index') }}"
                        class="nav-link text-white bg-primary bg-opacity-75 active">
                        <i class="fas fa-user-injured me-2"></i> Pasien
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <div class="bg-white shadow-sm p-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-user-injured text-primary"></i> Data Pasien
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
                        <h5 class="mb-1">Daftar Pasien</h5>
                        <p class="text-muted mb-0">Kelola data pasien yang terdaftar</p>
                    </div>
                    <a href="{{ route('auth.pasien.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Pasien
                    </a>
                </div>

                <!-- Filter -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <label for="filter_rumah_sakit" class="form-label">Filter by Rumah Sakit</label>
                                <select class="form-select" id="filter_rumah_sakit">
                                    <option value="">Semua Rumah Sakit</option>
                                    @foreach ($rumahSakits as $rs)
                                        <option value="{{ $rs->id }}">{{ $rs->nama_rumah_sakit }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-outline-secondary" id="btn-reset-filter">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="pasien-table">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" width="80">No</th>
                                        <th>Nama Pasien</th>
                                        <th>Alamat</th>
                                        <th>No Telepon</th>
                                        <th>Rumah Sakit</th>
                                        <th class="text-center" width="150">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="pasien-tbody">
                                    @forelse($pasiens as $index => $pasien)
                                        <tr id="row-{{ $pasien->id }}">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="fw-bold">{{ $pasien->nama_pasien }}</td>
                                            <td>{{ Str::limit($pasien->alamat, 50) }}</td>
                                            <td>{{ $pasien->no_telpon }}</td>
                                            <td>
                                                @if ($pasien->nama_rumah_sakit)
                                                    <span class="badge bg-info">{{ $pasien->nama_rumah_sakit }}</span>
                                                @else
                                                    <span class="badge bg-secondary">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('auth.pasien.show', $pasien->id) }}"
                                                        class="btn btn-sm btn-primary" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('auth.pasien.edit', $pasien->id) }}"
                                                        class="btn btn-sm btn-warning text-white" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                        data-id="{{ $pasien->id }}"
                                                        data-name="{{ $pasien->nama_pasien }}" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="empty-row">
                                            <td colspan="6" class="text-center text-muted py-4">
                                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                Belum ada data pasien
                                                <br>
                                                <a href="{{ route('auth.pasien.create') }}"
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
                    <p>Apakah Anda yakin ingin menghapus pasien <strong id="delete-name"></strong>?</p>
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
        document.addEventListener('DOMContentLoaded', function() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Filter functionality
            const filterSelect = document.getElementById('filter_rumah_sakit');
            const resetBtn = document.getElementById('btn-reset-filter');

            filterSelect.addEventListener('change', function() {
                filterPasien();
            });

            resetBtn.addEventListener('click', function() {
                filterSelect.value = '';
                filterPasien();
            });

            function filterPasien() {
                const rumahSakitId = filterSelect.value;

                fetch('/pasien-filter?' + new URLSearchParams({
                        rumah_sakit_id: rumahSakitId
                    }), {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateTable(data.data);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            function updateTable(pasiens) {
                const tbody = document.getElementById('pasien-tbody');
                tbody.innerHTML = '';

                if (pasiens.length === 0) {
                    tbody.innerHTML = `
                        <tr id="empty-row">
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                Tidak ada data pasien yang sesuai filter
                            </td>
                        </tr>
                    `;
                } else {
                    pasiens.forEach((pasien, index) => {
                        const row = `
                            <tr id="row-${pasien.id}">
                                <td class="text-center">${index + 1}</td>
                                <td class="fw-bold">${pasien.nama_pasien}</td>
                                <td>${pasien.alamat.length > 50 ? pasien.alamat.substring(0, 50) + '...' : pasien.alamat}</td>
                                <td>${pasien.no_telpon}</td>
                                <td>
                                    ${pasien.nama_rumah_sakit ?
                                        `<span class="badge bg-info">${pasien.nama_rumah_sakit}</span>` :
                                        `<span class="badge bg-secondary">Tidak ada</span>`
                                    }
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="/pasien/${pasien.id}" class="btn btn-sm btn-primary text-white" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="/pasien/${pasien.id}/edit" class="btn btn-sm btn-warning text-white" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                data-id="${pasien.id}" data-name="${pasien.nama_pasien}" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;
                        tbody.insertAdjacentHTML('beforeend', row);
                    });

                    // Re-attach delete event listeners
                    attachDeleteListeners();
                }
            }

            // Delete functionality
            let deleteId = null;
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

            function attachDeleteListeners() {
                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function() {
                        deleteId = this.getAttribute('data-id');
                        const name = this.getAttribute('data-name');
                        document.getElementById('delete-name').textContent = name;
                        deleteModal.show();
                    });
                });
            }

            // Initial attach
            attachDeleteListeners();

            // Handle confirm delete
            document.getElementById('confirm-delete').addEventListener('click', function() {
                if (deleteId) {
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
                    this.disabled = true;

                    fetch(`/pasien/${deleteId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById(`row-${deleteId}`).remove();
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
