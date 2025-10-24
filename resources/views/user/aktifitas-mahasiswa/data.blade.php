@extends('layouts.app')

@section('title', 'Aktifitas Mahasiswa Management')
@section('page-heading', 'Aktifitas Mahasiswa Management')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                        <h4 class="mb-0 fw-bold text-primary">Aktifitas Mahasiswa</h4>
                        <a href="{{ route('user-aktifitas-mahasiswa.create') }}" class="btn btn-primary rounded-pill">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Aktifitas
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    <div class="rounded-4 p-3 mb-4">
                        <form method="GET" action="{{ route('user-aktifitas-mahasiswa.index') }}" class="row g-3">
                            <div class="col-12 col-md-3">
                                <label class="form-label mb-1">Semester</label>
                                <select name="semester" id="filterSemester" class="form-select form-select-sm rounded-pill">
                                    <option value="">Semua</option>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}"
                                            {{ request('semester') == $i ? 'selected' : '' }}>
                                            Semester {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label mb-1">Status</label>
                                <select name="status" id="filterStatus" class="form-select form-select-sm rounded-pill">
                                    <option value="">Semua</option>
                                    <option {{ request('status') == 'Menunggu Validasi' ? 'selected' : '' }}>Menunggu
                                        Validasi</option>
                                    <option {{ request('status') == 'Terima' ? 'selected' : '' }}>Terima</option>
                                    <option {{ request('status') == 'Tidak Diterima' ? 'selected' : '' }}>Tidak Diterima
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label mb-1">Tipe</label>
                                <select name="tipe" id="filterTipe" class="form-select form-select-sm rounded-pill">
                                    <option value="">Semua</option>
                                    @foreach ($tipe ?? [] as $t)
                                        <option value="{{ $t->name }}"
                                            {{ request('tipe') == $t->name ? 'selected' : '' }}>
                                            {{ $t->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-2 d-flex align-items-end gap-2">
                                <button type="submit" class="btn btn-primary w-100 btn-sm rounded-pill">Filter</button>
                                <a href="{{ route('user-aktifitas-mahasiswa.index') }}"
                                    class="btn btn-outline-secondary w-100 btn-sm rounded-pill">Reset</a>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table id="usersTable" class="table table-striped table-hover align-middle nowrap"
                            style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Kegiatan</th>
                                    <th>Durasi</th>
                                    <th>Semester</th>
                                    <th>Periode</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data ?? [] as $i => $row)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            @php
                                                $badge = match ($row->status) {
                                                    'Terima' => 'success',
                                                    'Tidak Diterima' => 'danger',
                                                    default => 'warning',
                                                };
                                            @endphp
                                            <span class="badge bg-{{ $badge }}">{{ $row->status }}</span>
                                            @if ($row->status == 'Tidak Diterima' && $row->keterangan_validasi)
                                                <div class="small text-muted mt-1">{{ $row->keterangan_validasi }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $row->label }}</strong><br>
                                            <small class="text-muted">{{ $row->label_detail ?? '-' }}</small>
                                        </td>
                                        <td>{{ $row->durasi ?? '-' }}</td>
                                        <td>{{ $row->semester ? 'Semester ' . $row->semester : '—' }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d M Y') }}
                                        </td>
                                        <td>
                                            @if ($row->file)
                                                <a href="{{ $row->file }}" target="_blank"
                                                    class="btn btn-sm btn-outline-success">
                                                    Lihat File
                                                </a>
                                            @else
                                                <span class="text-muted small">Tidak Ada</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info btn-detail" data-bs-toggle="modal"
                                                data-bs-target="#detailModal" data-tipe="{{ $row->tipe?->name }}"
                                                data-status="{{ $row->status }}" data-label="{{ $row->label }}"
                                                data-label-detail="{{ $row->label_detail }}"
                                                data-id-tipe="{{ $row->tipe_aktifitas_mahasiswa_id }}"
                                                data-dosen="{{ $row->dosen_pembimbing }}" data-mitra="{{ $row->mitra }}"
                                                data-keterangan="{{ $row->keterangan }}"
                                                data-semester="{{ $row->semester }}" data-durasi="{{ $row->durasi }}"
                                                data-periode="{{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d M Y') }}"
                                                data-file="{{ $row->file }}"
                                                data-label-title="{{ $row->tipe?->label ?? 'Judul Kegiatan' }}"
                                                data-detail-title="{{ $row->tipe?->label_detail ?? 'Detail Aktivitas' }}">
                                                Detail
                                            </a>

                                            @if ($row->status !== 'Terima')
                                                <a href="{{ route('user-aktifitas-mahasiswa.edit', $row->id) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <form id="form-delete-{{ $row->id }}"
                                                    action="{{ route('user-aktifitas-mahasiswa.destroy', $row->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                        data-id="{{ $row->id }}"> Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-sm btn-success" disabled>Valid</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                <div class="modal-header p-4">
                    <div>
                        <h5 class="modal-title fw-bold" id="detailModalLabel">
                            <i class="bi bi-info-circle me-2"></i>Detail Aktivitas Mahasiswa
                        </h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body p-4 bg-light">
                    <!-- Informasi Umum -->
                    <div class="mb-4">
                        <h6
                            class="fw-bold text-uppercase text-primary mb-3 d-flex align-items-center gap-2 border-bottom pb-2">
                            <i class="bi bi-mortarboard-fill"></i> Informasi Umum
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1 small">Tipe Aktivitas</p>
                                <div class="fw-semibold fs-6" id="modalTipe">-</div>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1 small">Status</p>
                                <span id="modalStatus" class="badge rounded-pill px-3 py-2 shadow-sm">-</span>
                            </div>
                            <div class="col-md-12">
                                <p class="text-muted mb-1 small" id="modalLabelTitle">Judul Kegiatan</p>
                                <div class="fw-semibold fs-6 text-dark" id="modalLabel">-</div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Detail Aktivitas -->
                    <div class="mb-4">
                        <h6
                            class="fw-bold text-uppercase text-primary mb-3 d-flex align-items-center gap-2 border-bottom pb-2">
                            <i class="bi bi-journal-text"></i> Detail Aktivitas
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <p class="text-muted mb-1 small" id="modalDetailTitle">Detail Aktivitas</p>
                                <p id="modalDetail" class="text-dark">-</p>
                            </div>
                            <div class="col-md-12">
                                <p class="text-muted mb-1 small">Keterangan</p>
                                <p id="modalKeterangan" class="fst-italic text-muted">-</p>
                            </div>

                            <!-- Dosen & Mitra: Hanya tampil jika idTipe == 4 -->
                            <div class="col-md-6 d-none" id="modalDosenRow">
                                <p class="text-muted mb-1 small">Dosen Pembimbing</p>
                                <p id="modalDosen" class="fw-semibold text-dark">-</p>
                            </div>
                            <div class="col-md-6 d-none" id="modalMitraRow">
                                <p class="text-muted mb-1 small">Mitra / Instansi</p>
                                <p id="modalMitra" class="fw-semibold text-dark">-</p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Periode & Tambahan -->
                    <div class="mb-3">
                        <h6
                            class="fw-bold text-uppercase text-primary mb-3 d-flex align-items-center gap-2 border-bottom pb-2">
                            <i class="bi bi-calendar-week"></i> Periode & Informasi Tambahan
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <p class="text-muted mb-1 small">Semester</p>
                                <h6 id="modalSemester" class="text-dark">-</h6>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted mb-1 small">Durasi</p>
                                <h6 id="modalDurasi" class="text-dark">-</h6>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted mb-1 small">Periode</p>
                                <h6 id="modalPeriode" class="text-dark">-</h6>
                            </div>
                            <div class="col-md-12 mt-2">
                                <p class="text-muted mb-1 small">File Pendukung</p>
                                <div class="d-flex align-items-center gap-2">
                                    <a id="modalFile" href="#" target="_blank"
                                        class="btn btn-success btn-sm rounded-pill px-4 d-none shadow-sm">
                                        <i class="bi bi-paperclip"></i> Lihat File
                                    </a>
                                    <span id="modalNoFile" class="text-muted small">Tidak ada file yang diunggah.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-white d-flex justify-content-between align-items-center px-4 py-3">
                    <small class="text-muted"></small>
                    <button type="button" class="btn btn-outline-primary rounded-pill px-4 d-flex align-items-center"
                        data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                document.querySelectorAll('.btn-detail').forEach(btn => {
                    btn.addEventListener('click', function() {
                        // Ambil semua data
                        const tipe = this.dataset.tipe || '-';
                        const status = this.dataset.status || '-';
                        const label = this.dataset.label || '-';
                        const labelDetail = this.dataset.labelDetail || '-';
                        const keterangan = this.dataset.keterangan || '-';
                        const semester = this.dataset.semester || '-';
                        const durasi = this.dataset.durasi || '-';
                        const periode = this.dataset.periode || '-';
                        const idTipe = this.dataset.idTipe || '-';
                        const mitra = this.dataset.mitra || '-';
                        const dosen = this.dataset.dosen || '-';
                        const file = this.dataset.file;
                        const labelTitle = this.dataset.labelTitle || 'Judul Kegiatan';
                        const detailTitle = this.dataset.detailTitle || 'Detail Aktivitas';

                        // Isi data ke modal
                        document.getElementById('modalTipe').textContent = tipe;
                        document.getElementById('modalLabel').textContent = label;
                        document.getElementById('modalDetail').textContent = labelDetail;
                        document.getElementById('modalKeterangan').textContent = keterangan;
                        document.getElementById('modalSemester').textContent = semester;
                        document.getElementById('modalDurasi').textContent = durasi;
                        document.getElementById('modalPeriode').textContent = periode;

                        document.getElementById('modalMitra').textContent = mitra;
                        document.getElementById('modalDosen').textContent = dosen;

                        // Ganti judul field sesuai tipe
                        document.getElementById('modalLabelTitle').textContent = labelTitle;
                        document.getElementById('modalDetailTitle').textContent = detailTitle;

                        // Ganti badge status
                        const badge = document.getElementById('modalStatus');
                        badge.textContent = status;
                        badge.className = 'badge rounded-pill px-3 py-2 shadow-sm';
                        if (status === 'Terima') badge.classList.add('bg-success');
                        else if (status === 'Tidak Diterima') badge.classList.add('bg-danger');
                        else badge.classList.add('bg-warning', 'text-dark');

                        // Tampilkan atau sembunyikan file
                        const fileBtn = document.getElementById('modalFile');
                        const noFile = document.getElementById('modalNoFile');
                        if (file) {
                            fileBtn.href = file;
                            fileBtn.classList.remove('d-none');
                            noFile.classList.add('d-none');
                        } else {
                            fileBtn.classList.add('d-none');
                            noFile.classList.remove('d-none');
                        }

                        // --- Tampilkan Dosen & Mitra hanya jika idTipe == 4 ---
                        const dosenRow = document.getElementById('modalDosenRow');
                        const mitraRow = document.getElementById('modalMitraRow');
                        if (idTipe == 4) {
                            dosenRow.classList.remove('d-none');
                            mitraRow.classList.remove('d-none');
                        } else {
                            dosenRow.classList.add('d-none');
                            mitraRow.classList.add('d-none');
                        }
                    });
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const id = this.dataset.id;
                        const form = document.getElementById(`form-delete-${id}`);

                        Swal.fire({
                            title: 'Yakin ingin menghapus data ini?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal',
                            reverseButtons: true,
                            customClass: {
                                confirmButton: 'rounded-pill px-4',
                                cancelButton: 'rounded-pill px-4'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
