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
                                <input type="text" class="form-control" id="label_detail" name="label_detail"
                                    value="{{ old('label_detail', $aktifitas->label_detail) }}"
                                    placeholder="Masukkan detail kegiatan" required>
                                @error('label_detail')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
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
                                <label for="durasi" class="form-label">Durasi (Jam)</label>
                                <input type="number" class="form-control" id="durasi" name="durasi"
                                    value="{{ old('durasi', $aktifitas->durasi) }}" placeholder="Durasi kegiatan">
                                @error('durasi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="file" class="form-label">File Pendukung (opsional)</label>
                                <input type="file" class="form-control" id="file" name="file"
                                    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                <small class="text-muted">PDF/JPG/PNG/DOC, max 2MB.</small>

                                @if ($aktifitas->file)
                                    <div class="mt-2">
                                        📎 <a href="{{ asset('storage/' . $aktifitas->file) }}" target="_blank">Lihat
                                            File Saat Ini</a>
                                    </div>
                                @endif

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
@endpush
