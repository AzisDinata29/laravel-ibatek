@extends('layouts.app')

@section('title', 'Verifikasi Aktifitas Mahasiswa')
@section('page-heading', 'Verifikasi Aktifitas Mahasiswa')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                        <h4 class="mb-0 fw-bold text-primary">Verifikasi Aktifitas Mahasiswa</h4>
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
                        <form method="GET" action="{{ route('verifikasi-aktifitas-mahasiswa.index') }}" class="row g-3">
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
                            <div class="col-12 col-md-3">
                                <label class="form-label mb-1">Angkatan</label>
                                <select name="angkatan" id="filterAngkatan" class="form-select form-select-sm rounded-pill">
                                    <option value="">Semua</option>
                                    @foreach ($angkatanList as $angkatan)
                                        <option value="{{ $angkatan }}"
                                            {{ request('angkatan') == $angkatan ? 'selected' : '' }}>
                                            {{ $angkatan }}
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
                                    <th>Aksi</th>
                                    <th>Status</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>Fakultas</th>
                                    <th>Prodi</th>
                                    <th>Kegiatan</th>
                                    <th>Semester</th>
                                    <th>Periode</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data ?? [] as $i => $row)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning btnEditAktifitas"
                                                data-id="{{ $row->id }}">
                                                Verifikasi
                                            </button>
                                        </td>
                                        <td>
                                            @if ($row->status == 'Terima')
                                                <span class="badge bg-success">{{ $row->status }}</span>
                                            @elseif ($row->status == 'Tidak Diterima')
                                                <span class="badge bg-danger">{{ $row->status }}</span>
                                            @else
                                                <span class="badge bg-warning text-dark">{{ $row->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->user->name }}</td>
                                        <td>{{ $row->user->npm }}</td>
                                        <td>{{ $row->user->fakultas_detail->name ?? '-' }}</td>
                                        <td>{{ $row->user->prodi_detail->name ?? '-' }}</td>
                                        <td>
                                            <strong>{{ $row->label }}</strong><br>
                                            <small class="text-muted">{{ $row->label_detail ?? '-' }}</small>
                                        </td>
                                        <td>{{ $row->semester ? 'Semester ' . $row->semester : '—' }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d M Y') }}
                                        </td>
                                        <td>
                                            @if ($row->file)
                                                <a href="{{ asset('storage/' . $row->file) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-success">
                                                    Lihat File
                                                </a>
                                            @else
                                                <span class="text-muted small">Tidak Ada</span>
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

    <div class="modal fade" id="modalEditAktifitas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title" id="modalEditLabel">Verifikasi Aktifitas Mahasiswa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="editAktifitasContent">
                    <div class="text-center py-5 text-muted">
                        <div class="spinner-border text-primary mb-2" role="status"></div>
                        <p>Memuat data...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $(document).on('click', '.btnEditAktifitas', function() {
                    const id = $(this).data('id');
                    const modalBody = $('#editAktifitasContent');
                    modalBody.html(`<div class="text-center py-5 text-muted">
                        <div class="spinner-border text-primary mb-2" role="status"></div>
                        <p>Memuat data...</p>
                    </div>`);

                    $('#modalEditAktifitas').modal('show');

                    $.get("{{ url('verifikasi-aktifitas-mahasiswa') }}/" + id + "/edit", function(data) {
                        modalBody.html(data);
                    }).fail(function() {
                        modalBody.html(
                            '<div class="alert alert-danger text-center">Gagal memuat data. Coba lagi.</div>'
                        );
                    });
                });
            });
        </script>
    @endpush

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
                    });
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('.btn-delete').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const id = this.getAttribute('data-id');
                        const form = document.getElementById(`form-delete-${id}`);

                        Swal.fire({
                            title: 'Yakin ingin menghapus?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
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
