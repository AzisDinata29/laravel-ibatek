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
                                    <div class="col-md-6" id="dosen_pembimbing">
                                        <label class="form-label">
                                            Dosen Pembimbing
                                        </label>
                                        <input type="text" class="form-control need-tipe" id="dosen_pembimbing"
                                            name="dosen_pembimbing" placeholder="" value="{{ old('dosen_pembimbing') }}">
                                        @error('dosen_pembimbing')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6" id="mitra">
                                        <label class="form-label">
                                            Mitra
                                        </label>
                                        <input type="text" class="form-control need-tipe" id="mitra" name="mitra"
                                            placeholder="" value="{{ old('mitra') }}">
                                        @error('mitra')
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
                                        <label for="durasi" class="form-label" id="durasiName">Durasi (Jam)</label>
                                        <input type="number" class="form-control need-tipe" id="durasi"
                                            name="durasi" value="{{ old('durasi') }}" {{ $disabledAttr }}>
                                        @error('durasi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="file" class="form-label">File Pendukung (opsional)</label>
                                        <input type="text" required class="form-control need-tipe" id="file"
                                            value="{{ old('file') }}" name="file" {{ $disabledAttr }}>
                                        <small class="text-muted">Link Google Drive.</small>
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

        const mitra = document.getElementById('mitra');
        const dosen_pembimbing = document.getElementById('dosen_pembimbing');

        const durasiName = document.getElementById('durasiName');

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

            if (id === '1') {
                durasiName.textContent = 'Periode (Tahun)';
            } else {
                durasiName.textContent = 'Durasi (Jam)';
            }
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

            const labelDetailWrapper = document.getElementById('label_detail').parentElement;
            labelDetailWrapper.innerHTML = `
                <label for="label_detail" class="form-label">
                    <span id="label-detail-title">${meta.label_detail || ''}</span> <span class="text-danger">*</span>
                </label>
            `;

            if (id === "1") {
                let selectDetailHtml = `
            <select class="form-select need-tipe" id="label_detail" name="label_detail" ${!id ? 'disabled' : ''}>
                <option value="">-- Pilih Jabatan --</option>
                <option value="Ketua" {{ old('label_detail') == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                <option value="Wakil Ketua" {{ old('label_detail') == 'Wakil Ketua' ? 'selected' : '' }}>Wakil Ketua</option>
                <option value="Sekretaris" {{ old('label_detail') == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                <option value="Bendahara 1" {{ old('label_detail') == 'Bendahara 1' ? 'selected' : '' }}>Bendahara 1</option>
                <option value="Bendahara 2" {{ old('label_detail') == 'Bendahara 2' ? 'selected' : '' }}>Bendahara 2</option>
                <option value="ketua divisi" {{ old('label_detail') == 'ketua divisi' ? 'selected' : '' }}>ketua divisi</option>
                <option value="Anggota" {{ old('label_detail') == 'Anggota' ? 'selected' : '' }}>Anggota</option>
            </select>`;
                labelDetailWrapper.innerHTML += selectDetailHtml;

            } else if (id === "2") {
                let selectDetailHtml = `
            <select class="form-select need-tipe" id="label_detail" name="label_detail" ${!id ? 'disabled' : ''}>
                <option value="">-- Pilih Jabatan --</option>
                <option value="Ketua Pelaksana" {{ old('label_detail') == 'Ketua Pelaksana' ? 'selected' : '' }}>Ketua Pelaksana</option>
                <option value="Sekretaris Pelaksana" {{ old('label_detail') == 'Sekretaris Pelaksana' ? 'selected' : '' }}>Sekretaris Pelaksana</option>
                <option value="Bendahara Pelaksana" {{ old('label_detail') == 'Bendahara Pelaksana' ? 'selected' : '' }}>Bendahara Pelaksana</option>
                <option value="PJ Acara" {{ old('label_detail') == 'PJ Acara' ? 'selected' : '' }}>PJ Acara</option>
                <option value="PJ Konsumsi" {{ old('label_detail') == 'PJ Konsumsi' ? 'selected' : '' }}>PJ Konsumsi</option>
                <option value="PJ Korlap" {{ old('label_detail') == 'PJ Korlap' ? 'selected' : '' }}>PJ Korlap</option>
                <option value="PJ Medis" {{ old('label_detail') == 'PJ Medis' ? 'selected' : '' }}>PJ Medis</option>
                <option value="PJ Perlengkapan" {{ old('label_detail') == 'PJ Perlengkapan' ? 'selected' : '' }}>PJ Perlengkapan</option>
                <option value="Anggota" {{ old('label_detail') == 'Anggota' ? 'selected' : '' }}>Anggota</option>
            </select>`;
                labelDetailWrapper.innerHTML += selectDetailHtml;
            } else if (id === "4") {
                let selectDetailHtml = `<select class="form-select need-tipe" id="label_detail" name="label_detail" ${!id ? 'disabled' : ''}>
                    <option value="">-- Pilih Tujuan SDGs --</option>
                    <option value="No Poverty (Tanpa Kemiskinan)" {{ old('label_detail') == 'No Poverty (Tanpa Kemiskinan)' ? 'selected' : '' }}>
                        No Poverty (Tanpa Kemiskinan)
                    </option>
                    <option value="Zero Hunger (Tanpa Kelaparan)" {{ old('label_detail') == 'Zero Hunger (Tanpa Kelaparan)' ? 'selected' : '' }}>
                        Zero Hunger (Tanpa Kelaparan)
                    </option>
                    <option value="Good Health and Well-being (Kehidupan Sehat dan Sejahtera)" {{ old('label_detail') == 'Good Health and Well-being (Kehidupan Sehat dan Sejahtera)' ? 'selected' : '' }}>
                        Good Health and Well-being (Kehidupan Sehat dan Sejahtera)
                    </option>
                    <option value="Quality Education (Pendidikan Berkualitas)" {{ old('label_detail') == 'Quality Education (Pendidikan Berkualitas)' ? 'selected' : '' }}>
                        Quality Education (Pendidikan Berkualitas)
                    </option>
                    <option value="Gender Equality (Kesetaraan Gender)" {{ old('label_detail') == 'Gender Equality (Kesetaraan Gender)' ? 'selected' : '' }}>
                        Gender Equality (Kesetaraan Gender)
                    </option>
                    <option value="Clean Water and Sanitation (Air Bersih dan Sanitasi Layak)" {{ old('label_detail') == 'Clean Water and Sanitation (Air Bersih dan Sanitasi Layak)' ? 'selected' : '' }}>
                        Clean Water and Sanitation (Air Bersih dan Sanitasi Layak)
                    </option>
                    <option value="Affordable and Clean Energy (Energi Bersih dan Terjangkau)" {{ old('label_detail') == 'Affordable and Clean Energy (Energi Bersih dan Terjangkau)' ? 'selected' : '' }}>
                        Affordable and Clean Energy (Energi Bersih dan Terjangkau)
                    </option>
                    <option value="Decent Work and Economic Growth (Pekerjaan Layak dan Pertumbuhan Ekonomi)" {{ old('label_detail') == 'Decent Work and Economic Growth (Pekerjaan Layak dan Pertumbuhan Ekonomi)' ? 'selected' : '' }}>
                        Decent Work and Economic Growth (Pekerjaan Layak dan Pertumbuhan Ekonomi)
                    </option>
                    <option value="Industry, Innovation, and Infrastructure (Industri, Inovasi, dan Infrastruktur)" {{ old('label_detail') == 'Industry, Innovation, and Infrastructure (Industri, Inovasi, dan Infrastruktur)' ? 'selected' : '' }}>
                        Industry, Innovation, and Infrastructure (Industri, Inovasi, dan Infrastruktur)
                    </option>
                    <option value="Reduced Inequalities (Berkurangnya Ketimpangan)" {{ old('label_detail') == 'Reduced Inequalities (Berkurangnya Ketimpangan)' ? 'selected' : '' }}>
                        Reduced Inequalities (Berkurangnya Ketimpangan)
                    </option>
                    <option value="Sustainable Cities and Communities (Kota dan Permukiman Berkelanjutan)" {{ old('label_detail') == 'Sustainable Cities and Communities (Kota dan Permukiman Berkelanjutan)' ? 'selected' : '' }}>
                        Sustainable Cities and Communities (Kota dan Permukiman Berkelanjutan)
                    </option>
                    <option value="Responsible Consumption and Production (Konsumsi dan Produksi yang Bertanggung Jawab)" {{ old('label_detail') == 'Responsible Consumption and Production (Konsumsi dan Produksi yang Bertanggung Jawab)' ? 'selected' : '' }}>
                        Responsible Consumption and Production (Konsumsi dan Produksi yang Bertanggung Jawab)
                    </option>
                    <option value="Climate Action (Penanganan Perubahan Iklim)" {{ old('label_detail') == 'Climate Action (Penanganan Perubahan Iklim)' ? 'selected' : '' }}>
                        Climate Action (Penanganan Perubahan Iklim)
                    </option>
                    <option value="Life Below Water (Ekosistem Lautan)" {{ old('label_detail') == 'Life Below Water (Ekosistem Lautan)' ? 'selected' : '' }}>
                        Life Below Water (Ekosistem Lautan)
                    </option>
                    <option value="Life on Land (Ekosistem Daratan)" {{ old('label_detail') == 'Life on Land (Ekosistem Daratan)' ? 'selected' : '' }}>
                        Life on Land (Ekosistem Daratan)
                    </option>
                    <option value="Peace, Justice, and Strong Institutions (Perdamaian, Keadilan, dan Kelembagaan Tangguh)" {{ old('label_detail') == 'Peace, Justice, and Strong Institutions (Perdamaian, Keadilan, dan Kelembagaan Tangguh)' ? 'selected' : '' }}>
                        Peace, Justice, and Strong Institutions (Perdamaian, Keadilan, dan Kelembagaan Tangguh)
                    </option>
                    <option value="Partnerships for the Goals (Kemitraan untuk Mencapai Tujuan)" {{ old('label_detail') == 'Partnerships for the Goals (Kemitraan untuk Mencapai Tujuan)' ? 'selected' : '' }}>
                        Partnerships for the Goals (Kemitraan untuk Mencapai Tujuan)
                    </option>
                </select>
                `;
                labelDetailWrapper.innerHTML += selectDetailHtml;
            } else {
                // Default input text
                let inputDetailHtml =
                    `<input type="text" class="form-control need-tipe" id="label_detail"
            name="label_detail" placeholder="${meta.label_detail || ''}" value="{{ old('label_detail') }}" ${!id ? 'disabled' : ''}>`;
                labelDetailWrapper.innerHTML += inputDetailHtml;
            }
            const mitra = document.getElementById('mitra');
            const dosen_pembimbing = document.getElementById('dosen_pembimbing');

            if (mitra && dosen_pembimbing) {
                if (id === "4") {
                    mitra.classList.remove('d-none');
                    mitra.classList.add('d-block');
                    dosen_pembimbing.classList.remove('d-none');
                    dosen_pembimbing.classList.add('d-block');
                } else {
                    mitra.classList.remove('d-block');
                    mitra.classList.add('d-none');
                    dosen_pembimbing.classList.remove('d-block');
                    dosen_pembimbing.classList.add('d-none');
                }
            }

            const durasiInput = document.getElementById('durasi');
            if (durasiInput) {
                durasiInput.value = '';
                durasiInput.removeEventListener('input', handleDurasiInput);
                if (id) {
                    durasiInput.dataset.idTipe = id; // simpan id agar bisa diakses di fungsi
                    durasiInput.addEventListener('input', handleDurasiInput);
                }
            }
            setEnabled(!!id);
        }

        function handleDurasiInput(event) {
            const value = parseInt(this.value);
            const id = this.dataset.idTipe || '';

            let maxDurasi = null;
            if (id === '1') {
                maxDurasi = 1;
            } else if (id === '2') {
                maxDurasi = 6;
            } else if (id !== '1') {
                maxDurasi = 12;
            }

            if (maxDurasi !== null) {
                if (value > maxDurasi) {
                    this.value = maxDurasi;
                }
                if (value < 1 && this.value !== '') {
                    this.value = 1;
                }
            } else {
                if (value < 0 && this.value !== '') {
                    this.value = 0;
                }
            }
        }

        updateDynamicLabels();

        selectTipe.addEventListener('change', updateDynamicLabels);
    </script>
@endpush
