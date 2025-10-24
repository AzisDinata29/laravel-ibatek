@extends('layouts.app')

@section('title', 'Aktifitas Mahasiswa Management')
@section('page-heading', 'Aktifitas Mahasiswa Management')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Perbarui Aktifitas Mahasiswa</h4>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="fw-semibold mb-1">Periksa kembali isian kamu:</div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('user-aktifitas-mahasiswa.update', $aktifitas->id) }}" method="POST"
                        enctype="multipart/form-data" id="formAktifitas">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="tipe_aktifitas_mahasiswa_id" class="form-label">Tipe Aktifitas</label>
                                <input type="text" class="form-control bg-light" value="{{ $aktifitas->tipe?->name }}"
                                    readonly>
                                <input type="hidden" name="tipe_aktifitas_mahasiswa_id"
                                    value="{{ $aktifitas->tipe_aktifitas_mahasiswa_id }}">
                            </div>
                            <div class="col-md-6">
                                <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                                <select class="form-select" id="semester" name="semester" required>
                                    <option value="">Pilih Semester</option>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}"
                                            {{ old('semester', $aktifitas->semester) == $i ? 'selected' : '' }}>
                                            Semester {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('semester')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="label" class="form-label">{{ $aktifitas->tipe->label }} <span
                                        class="text-danger">*</span></label>
                                @if ($aktifitas->tipe_aktifitas_mahasiswa_id == 1)
                                    <select class="form-select" id="label" name="label" required>
                                        <option value="">-- Pilih Organisasi --</option>
                                        @foreach ($organizations as $org)
                                            <option value="{{ $org->name }}"
                                                {{ old('label', $aktifitas->label) == $org->name ? 'selected' : '' }}>
                                                {{ $org->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" class="form-control" id="label" name="label"
                                        value="{{ old('label', $aktifitas->label) }}" placeholder="Masukkan label kegiatan"
                                        required>
                                @endif
                                @error('label')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="label_detail" class="form-label">{{ $aktifitas->tipe->label_detail }} <span
                                        class="text-danger">*</span></label>
                                @if ($aktifitas->tipe_aktifitas_mahasiswa_id == 1)
                                    <select class="form-select need-tipe" id="label_detail" name="label_detail" ${!id
                                        ? 'disabled' : '' }>
                                        <option value="">-- Pilih Jabatan --</option>
                                        <option value="Ketua" {{ $aktifitas->label_detail == 'Ketua' ? 'selected' : '' }}>
                                            Ketua
                                        </option>
                                        <option value="Wakil Ketua"
                                            {{ $aktifitas->label_detail == 'Wakil Ketua' ? 'selected' : '' }}>Wakil Ketua
                                        </option>
                                        <option value="Sekretaris"
                                            {{ $aktifitas->label_detail == 'Sekretaris' ? 'selected' : '' }}>Sekretaris
                                        </option>
                                        <option value="Bendahara 1"
                                            {{ $aktifitas->label_detail == 'Bendahara 1' ? 'selected' : '' }}>Bendahara 1
                                        </option>
                                        <option value="Bendahara 2"
                                            {{ $aktifitas->label_detail == 'Bendahara 2' ? 'selected' : '' }}>Bendahara 2
                                        </option>
                                        <option value="ketua divisi"
                                            {{ $aktifitas->label_detail == 'ketua divisi' ? 'selected' : '' }}>Anggota
                                            Divisi
                                        </option>
                                        <option value="Anggota"
                                            {{ $aktifitas->label_detail == 'Anggota' ? 'selected' : '' }}>
                                            Anggota</option>
                                    </select>
                                @elseif($aktifitas->tipe_aktifitas_mahasiswa_id == 2)
                                    <select class="form-select need-tipe" id="label_detail" name="label_detail" ${!id
                                        ? 'disabled' : '' }>
                                        <option value="">-- Pilih Jabatan --</option>
                                        <option value="Ketua Pelaksana"
                                            {{ $aktifitas->label_detail == 'Ketua Pelaksana' ? 'selected' : '' }}>Ketua
                                            Pelaksana</option>
                                        <option value="Sekretaris Pelaksana"
                                            {{ $aktifitas->label_detail == 'Sekretaris Pelaksana' ? 'selected' : '' }}>
                                            Sekretaris Pelaksana</option>
                                        <option value="Bendahara Pelaksana"
                                            {{ $aktifitas->label_detail == 'Bendahara Pelaksana' ? 'selected' : '' }}>
                                            Bendahara
                                            Pelaksana</option>
                                        <option value="PJ Acara"
                                            {{ $aktifitas->label_detail == 'PJ Acara' ? 'selected' : '' }}>
                                            PJ Acara</option>
                                        <option value="PJ Konsumsi"
                                            {{ $aktifitas->label_detail == 'PJ Konsumsi' ? 'selected' : '' }}>PJ Konsumsi
                                        </option>
                                        <option value="PJ Korlap"
                                            {{ $aktifitas->label_detail == 'PJ Korlap' ? 'selected' : '' }}>PJ Korlap
                                        </option>
                                        <option value="PJ Medis"
                                            {{ $aktifitas->label_detail == 'PJ Medis' ? 'selected' : '' }}>
                                            PJ Medis</option>
                                        <option value="PJ Perlengkapan"
                                            {{ $aktifitas->label_detail == 'PJ Perlengkapan' ? 'selected' : '' }}>PJ
                                            Perlengkapan</option>
                                        <option value="Anggota"
                                            {{ $aktifitas->label_detail == 'Anggota' ? 'selected' : '' }}>
                                            Anggota</option>
                                    </select>
                                @elseif($aktifitas->tipe_aktifitas_mahasiswa_id == 4)
                                    <select class="form-select need-tipe" id="label_detail" name="label_detail" ${!id
                                        ? 'disabled' : '' }>
                                        <option value="">-- Pilih Tujuan SDGs --</option>
                                        <option value="No Poverty (Tanpa Kemiskinan)"
                                            {{ $aktifitas->label_detail == 'No Poverty (Tanpa Kemiskinan)' ? 'selected' : '' }}>
                                            No Poverty (Tanpa Kemiskinan)
                                        </option>
                                        <option value="Zero Hunger (Tanpa Kelaparan)"
                                            {{ $aktifitas->label_detail == 'Zero Hunger (Tanpa Kelaparan)' ? 'selected' : '' }}>
                                            Zero Hunger (Tanpa Kelaparan)
                                        </option>
                                        <option value="Good Health and Well-being (Kehidupan Sehat dan Sejahtera)"
                                            {{ $aktifitas->label_detail == 'Good Health and Well-being (Kehidupan Sehat dan Sejahtera)' ? 'selected' : '' }}>
                                            Good Health and Well-being (Kehidupan Sehat dan Sejahtera)
                                        </option>
                                        <option value="Quality Education (Pendidikan Berkualitas)"
                                            {{ $aktifitas->label_detail == 'Quality Education (Pendidikan Berkualitas)' ? 'selected' : '' }}>
                                            Quality Education (Pendidikan Berkualitas)
                                        </option>
                                        <option value="Gender Equality (Kesetaraan Gender)"
                                            {{ $aktifitas->label_detail == 'Gender Equality (Kesetaraan Gender)' ? 'selected' : '' }}>
                                            Gender Equality (Kesetaraan Gender)
                                        </option>
                                        <option value="Clean Water and Sanitation (Air Bersih dan Sanitasi Layak)"
                                            {{ $aktifitas->label_detail == 'Clean Water and Sanitation (Air Bersih dan Sanitasi Layak)' ? 'selected' : '' }}>
                                            Clean Water and Sanitation (Air Bersih dan Sanitasi Layak)
                                        </option>
                                        <option value="Affordable and Clean Energy (Energi Bersih dan Terjangkau)"
                                            {{ $aktifitas->label_detail == 'Affordable and Clean Energy (Energi Bersih dan Terjangkau)' ? 'selected' : '' }}>
                                            Affordable and Clean Energy (Energi Bersih dan Terjangkau)
                                        </option>
                                        <option
                                            value="Decent Work and Economic Growth (Pekerjaan Layak dan Pertumbuhan Ekonomi)"
                                            {{ $aktifitas->label_detail == 'Decent Work and Economic Growth (Pekerjaan Layak dan Pertumbuhan Ekonomi)' ? 'selected' : '' }}>
                                            Decent Work and Economic Growth (Pekerjaan Layak dan Pertumbuhan Ekonomi)
                                        </option>
                                        <option
                                            value="Industry, Innovation, and Infrastructure (Industri, Inovasi, dan Infrastruktur)"
                                            {{ $aktifitas->label_detail == 'Industry, Innovation, and Infrastructure (Industri, Inovasi, dan Infrastruktur)' ? 'selected' : '' }}>
                                            Industry, Innovation, and Infrastructure (Industri, Inovasi, dan Infrastruktur)
                                        </option>
                                        <option value="Reduced Inequalities (Berkurangnya Ketimpangan)"
                                            {{ $aktifitas->label_detail == 'Reduced Inequalities (Berkurangnya Ketimpangan)' ? 'selected' : '' }}>
                                            Reduced Inequalities (Berkurangnya Ketimpangan)
                                        </option>
                                        <option
                                            value="Sustainable Cities and Communities (Kota dan Permukiman Berkelanjutan)"
                                            {{ $aktifitas->label_detail == 'Sustainable Cities and Communities (Kota dan Permukiman Berkelanjutan)' ? 'selected' : '' }}>
                                            Sustainable Cities and Communities (Kota dan Permukiman Berkelanjutan)
                                        </option>
                                        <option
                                            value="Responsible Consumption and Production (Konsumsi dan Produksi yang Bertanggung Jawab)"
                                            {{ $aktifitas->label_detail == 'Responsible Consumption and Production (Konsumsi dan Produksi yang Bertanggung Jawab)' ? 'selected' : '' }}>
                                            Responsible Consumption and Production (Konsumsi dan Produksi yang Bertanggung
                                            Jawab)
                                        </option>
                                        <option value="Climate Action (Penanganan Perubahan Iklim)"
                                            {{ $aktifitas->label_detail == 'Climate Action (Penanganan Perubahan Iklim)' ? 'selected' : '' }}>
                                            Climate Action (Penanganan Perubahan Iklim)
                                        </option>
                                        <option value="Life Below Water (Ekosistem Lautan)"
                                            {{ $aktifitas->label_detail == 'Life Below Water (Ekosistem Lautan)' ? 'selected' : '' }}>
                                            Life Below Water (Ekosistem Lautan)
                                        </option>
                                        <option value="Life on Land (Ekosistem Daratan)"
                                            {{ $aktifitas->label_detail == 'Life on Land (Ekosistem Daratan)' ? 'selected' : '' }}>
                                            Life on Land (Ekosistem Daratan)
                                        </option>
                                        <option
                                            value="Peace, Justice, and Strong Institutions (Perdamaian, Keadilan, dan Kelembagaan Tangguh)"
                                            {{ $aktifitas->label_detail == 'Peace, Justice, and Strong Institutions (Perdamaian, Keadilan, dan Kelembagaan Tangguh)' ? 'selected' : '' }}>
                                            Peace, Justice, and Strong Institutions (Perdamaian, Keadilan, dan Kelembagaan
                                            Tangguh)
                                        </option>
                                        <option value="Partnerships for the Goals (Kemitraan untuk Mencapai Tujuan)"
                                            {{ $aktifitas->label_detail == 'Partnerships for the Goals (Kemitraan untuk Mencapai Tujuan)' ? 'selected' : '' }}>
                                            Partnerships for the Goals (Kemitraan untuk Mencapai Tujuan)
                                        </option>
                                    </select>
                                @else
                                    <input type="text" class="form-control" id="label_detail" name="label_detail"
                                        value="{{ old('label_detail', $aktifitas->label_detail) }}"
                                        placeholder="Masukkan detail kegiatan" required>
                                @endif


                                @error('label_detail')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            @if ($aktifitas->tipe_aktifitas_mahasiswa_id == 4)
                                <div class="col-md-6" id="dosen_pembimbing">
                                    <label class="form-label">
                                        Dosen Pembimbing
                                    </label>
                                    <input type="text" class="form-control need-tipe" id="dosen_pembimbing"
                                        name="dosen_pembimbing" placeholder=""
                                        value="{{ old('dosen_pembimbing', $aktifitas->dosen_pembimbing) }}">
                                    @error('dosen_pembimbing')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6" id="mitra">
                                    <label class="form-label">
                                        Mitra
                                    </label>
                                    <input type="text" class="form-control need-tipe" id="mitra" name="mitra"
                                        placeholder="" value="{{ old('mitra', $aktifitas->mitra) }}">
                                    @error('mitra')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endif
                            <div class="col-md-4">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                    value="{{ old('tanggal_mulai', $aktifitas->tanggal_mulai) }}" required>
                                @error('tanggal_mulai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                                    value="{{ old('tanggal_selesai', $aktifitas->tanggal_selesai) }}" required>
                                @error('tanggal_selesai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                @if ($aktifitas->tipe_aktifitas_mahasiswa_id == 1)
                                    <label for="durasi" class="form-label" id="durasiName">Periode</label>
                                @else
                                    <label for="durasi" class="form-label" id="durasiName">Durasi (Jam)</label>
                                @endif
                                <input type="number" class="form-control" id="durasi" name="durasi"
                                    value="{{ old('durasi', $aktifitas->durasi) }}" placeholder="Durasi kegiatan">
                                @error('durasi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="file" class="form-label">File Pendukung (opsional)</label>
                                <input type="text" class="form-control" id="file"
                                    value="{{ old('file', $aktifitas->file) }}" name="file">
                                <small class="text-muted">Link Google Drive.</small>
                                @error('file')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"
                                    placeholder="Tambahan informasi kegiatan">{{ old('keterangan', $aktifitas->keterangan) }}</textarea>
                                @error('keterangan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('user-aktifitas-mahasiswa.index') }}"
                                    class="btn btn-outline-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .form-control[readonly] {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }
    </style>
@endpush
@push('scripts')
    <script>
        setTimeout(() => {
            document.querySelectorAll('.alert.alert-dismissible').forEach(el => {
                const alert = new bootstrap.Alert(el);
                alert.close();
            });
        }, 3000);
    </script>
    <script>
        const id = @json($aktifitas->tipe_aktifitas_mahasiswa_id ?? null);
        document.addEventListener('DOMContentLoaded', function() {
            const durasiInput = document.getElementById('durasi');
            const tipeSelect = document.getElementById('tipe');

            function handleDurasiLimit() {
                const value = parseInt(durasiInput.value);
                const maxDurasi = (id === 1) ? 1 : (id === 2 ? 6 : 12);

                if (value > maxDurasi) {
                    durasiInput.value = maxDurasi;
                }

                if (value < 1 && durasiInput.value !== '') {
                    durasiInput.value = 1;
                }
            }

            if (durasiInput) {
                durasiInput.addEventListener('input', handleDurasiLimit);
            }

            if (tipeSelect) {
                tipeSelect.addEventListener('change', function() {
                    durasiInput.value = '';
                });
            }
        });
    </script>
@endpush
