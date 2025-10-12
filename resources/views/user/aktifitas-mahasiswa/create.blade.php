@extends('layouts.app')

@section('title', 'Aktifitas Mahasiswa Management')
@section('page-heading', 'Aktifitas Mahasiswa Management')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Tambah Aktifitas Mahasiswa</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Validasi global (list semua error sekaligus) --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="fw-semibold mb-1">Periksa kembali isian kamu:</div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('user-aktifitas-mahasiswa.store') }}" method="POST"
                        enctype="multipart/form-data" id="formAktifitas">
                        @csrf

                        <div class="row g-3">
                            @php
                                $enabled = old('tipe_aktifitas_mahasiswa_id') ? true : false;
                                $disabledAttr = $enabled ? '' : 'disabled';
                            @endphp
                            <div class="col-md-6">
                                <label for="tipe_aktifitas_mahasiswa_id" class="form-label">Tipe Aktifitas <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="tipe_aktifitas_mahasiswa_id"
                                    name="tipe_aktifitas_mahasiswa_id">
                                    <option value="">-- Pilih Tipe --</option>
                                    @foreach ($tipe as $t)
                                        <option value="{{ $t->id }}"
                                            {{ (string) old('tipe_aktifitas_mahasiswa_id') === (string) $t->id ? 'selected' : '' }}>
                                            {{ $t->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipe_aktifitas_mahasiswa_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                                <select class="form-control need-tipe" id="semester" name="semester" {{ $disabledAttr }}>
                                    <option value="">Pilih Semester</option>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}"
                                            {{ (string) old('semester') === (string) $i ? 'selected' : '' }}>
                                            Semester {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('semester')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div id="after-tipe" class="mt-1">
                                <div class="row g-3">
                                    <div class="col-md-6" id="label-wrapper">
                                        <label for="label" class="form-label">
                                            <span id="label-title"></span> <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control need-tipe" id="label" name="label"
                                            placeholder="" value="{{ old('label') }}" {{ $disabledAttr }}>
                                        @error('label')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="label_detail" class="form-label">
                                            <span id="label-detail-title"></span> <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control need-tipe" id="label_detail"
                                            name="label_detail" placeholder="" value="{{ old('label_detail') }}"
                                            {{ $disabledAttr }}>
                                        @error('label_detail')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control need-tipe" id="tanggal_mulai"
                                            name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" {{ $disabledAttr }}>
                                        @error('tanggal_mulai')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control need-tipe" id="tanggal_selesai"
                                            name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                                            {{ $disabledAttr }}>
                                        @error('tanggal_selesai')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="durasi" class="form-label">Durasi (Jam)</label>
                                        <input type="number" class="form-control need-tipe" id="durasi"
                                            name="durasi" placeholder="Durasi" value="{{ old('durasi') }}"
                                            {{ $disabledAttr }}>
                                        @error('durasi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="file" class="form-label">File Pendukung (opsional)</label>
                                        <input type="file" class="form-control need-tipe" id="file"
                                            name="file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" {{ $disabledAttr }}>
                                        <small class="text-muted">PDF/JPG/PNG/DOC, max 2MB.</small>
                                        @error('file')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea class="form-control need-tipe" id="keterangan" name="keterangan" rows="3"
                                            placeholder="Tambahan informasi" {{ $disabledAttr }}>{{ old('keterangan') }}</textarea>
                                        @error('keterangan')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <a href="{{ route('user-aktifitas-mahasiswa.index') }}"
                                        class="btn btn-outline-secondary">Kembali</a>
                                    <button type="submit" id="btnSubmit" class="btn btn-primary"
                                        {{ $disabledAttr }}>Simpan</button>
                                </div>
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
        .need-tipe:disabled {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }

        #btnSubmit:disabled {
            opacity: .6;
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
        const tipeMap = @json(collect($tipe)->mapWithKeys(fn($t) => [
                    $t->id => ['label' => $t->label ?? '', 'label_detail' => $t->label_detail ?? ''],
                ]));

        const selectTipe = document.getElementById('tipe_aktifitas_mahasiswa_id');
        const labelTitle = document.getElementById('label-title');
        const labelDetailTitle = document.getElementById('label-detail-title');
        const inputLabel = document.getElementById('label');
        const inputLabelDetail = document.getElementById('label_detail');

        const needsTipeInputs = document.querySelectorAll('.need-tipe');
        const btnSubmit = document.getElementById('btnSubmit');

        const tglMulai = document.getElementById('tanggal_mulai');
        const tglSelesai = document.getElementById('tanggal_selesai');
        const durasi = document.getElementById('durasi');

        function setEnabled(enabled) {
            needsTipeInputs.forEach(el => el.disabled = !enabled);
            if (btnSubmit) btnSubmit.disabled = !enabled;
        }

        function updateDynamicLabels() {
            const id = selectTipe.value;
            const meta = tipeMap[id] || {
                label: '',
                label_detail: ''
            };

            labelTitle.textContent = meta.label || '';
            labelDetailTitle.textContent = meta.label_detail || '';

            const labelWrapper = document.getElementById('label-wrapper');
            labelWrapper.innerHTML = `
                <label for="label" class="form-label">
                    <span id="label-title">${meta.label || ''}</span> <span class="text-danger">*</span>
                </label>
            `;

            if (id === "1") {
                let selectHtml = `<select class="form-select need-tipe" id="label" name="label" ${!id ? 'disabled' : ''}>
                    <option value="">-- Pilih Organisasi --</option>
                    @foreach ($organizations as $org)
                        <option value="{{ $org->name }}" {{ old('label') == $org->name ? 'selected' : '' }}>
                            {{ $org->name }}
                        </option>
                    @endforeach
                </select>`;
                labelWrapper.innerHTML += selectHtml;
            } else {
                let inputHtml = `<input type="text" class="form-control need-tipe" id="label" name="label"
                    placeholder="${meta.label || ''}" value="{{ old('label') }}" ${!id ? 'disabled' : ''}>`;
                labelWrapper.innerHTML += inputHtml;
            }

            setEnabled(!!id);
        }

        updateDynamicLabels();

        selectTipe.addEventListener('change', updateDynamicLabels);
    </script>
@endpush
