<form action="{{ route('verifikasi-aktifitas-mahasiswa.update', $aktifitas->id) }}" method="POST"
    enctype="multipart/form-data" id="formAktifitas">
    @csrf
    @method('PUT')
    <div class="row g-3">
        <div class="col-12">
            <div class="border rounded-3 p-3 bg-light mb-3">
                <h6 class="fw-bold text-primary mb-3"> Informasi Mahasiswa</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" value="{{ $aktifitas->user->name }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NPM</label>
                        <input type="text" class="form-control" value="{{ $aktifitas->user->npm }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Program Studi</label>
                        <input type="text" class="form-control"
                            value="{{ $aktifitas->user->prodi_detail->name ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fakultas</label>
                        <input type="text" class="form-control"
                            value="{{ $aktifitas->user->fakultas_detail->name ?? '-' }}" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label for="tipe_aktifitas_mahasiswa_id" class="form-label">Tipe Aktifitas</label>
            <input type="text" class="form-control bg-light" value="{{ $aktifitas->tipe?->name }}" readonly>
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
                    value="{{ old('label', $aktifitas->label) }}" placeholder="Masukkan label kegiatan" required>
            @endif
            @error('label')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="label_detail" class="form-label">{{ $aktifitas->tipe->label_detail }} <span
                    class="text-danger">*</span></label>
            <input type="text" class="form-control" id="label_detail" name="label_detail"
                value="{{ old('label_detail', $aktifitas->label_detail) }}" placeholder="Masukkan detail kegiatan"
                required>
            @error('label_detail')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        @if ($aktifitas->tipe_aktifitas_mahasiswa_id == 4)
            <div class="col-md-6" id="dosen_pembimbing">
                <label class="form-label">
                    Dosen Pembimbing
                </label>
                <input type="text" class="form-control need-tipe" id="dosen_pembimbing" name="dosen_pembimbing"
                    placeholder="" value="{{ old('dosen_pembimbing', $aktifitas->dosen_pembimbing) }}">
                @error('dosen_pembimbing')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6" id="mitra">
                <label class="form-label">
                    Mitra
                </label>
                <input type="text" class="form-control need-tipe" id="mitra" name="mitra" placeholder=""
                    value="{{ old('mitra', $aktifitas->mitra) }}">
                @error('mitra')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        @endif
        <div class="col-md-4">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
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
            <label for="durasi" class="form-label">Durasi</label>
            <input type="text" class="form-control" id="durasi" name="durasi"
                value="{{ old('durasi', $aktifitas->durasi) }}" placeholder="Durasi kegiatan">
            @error('durasi')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="file" class="form-label">File Pendukung </label>
            @if ($aktifitas->file)
                <div class="mt-2">
                    📎 <a href="{{ $aktifitas->file }}" target="_blank">Lihat
                        File Saat Ini</a>
                </div>
            @else
                <div class="mt-2">
                    📎 <a href="#" target="_blank">Tidak Ada File</a>
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

        <div class="col-md-6">
            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
            <select class="form-select" id="status" name="status" required>
                <option value="">-- Pilih Status --</option>
                <option value="Terima" {{ old('status', $aktifitas->status) == 'Terima' ? 'selected' : '' }}>Terima
                </option>
                <option value="Tidak Diterima"
                    {{ old('status', $aktifitas->status) == 'Tidak Diterima' ? 'selected' : '' }}>
                    Tidak Diterima
                </option>
            </select>
            @error('status')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-12" id="keteranganValidasiWrapper" style="display: none;">
            <label for="keterangan_validasi" class="form-label">Keterangan Validasi</label>
            <input type="text" class="form-control" id="keterangan_validasi" name="keterangan_validasi"
                placeholder="Alasan tidak diterima"
                value="{{ old('keterangan_validasi', $aktifitas->keterangan_validasi) }}">
            @error('keterangan_validasi')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn btn-primary">Verifikasi Data</button>
        </div>
    </div>
</form>
@push('styles')
    <style>
        .form-control[readonly] {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }
    </style>
@endpush
<script>
    // Tutup alert otomatis
    setTimeout(() => {
        document.querySelectorAll('.alert.alert-dismissible').forEach(el => {
            const alert = new bootstrap.Alert(el);
            alert.close();
        });
    }, 3000);

    // ✅ Tampilkan atau sembunyikan input keterangan_validasi
    function toggleKeteranganValidasi() {
        const status = document.getElementById('status').value;
        const wrapper = document.getElementById('keteranganValidasiWrapper');
        if (status === 'Tidak Diterima') {
            wrapper.style.display = 'block';
            wrapper.querySelector('input').setAttribute('required', 'required');
        } else {
            wrapper.style.display = 'none';
            wrapper.querySelector('input').removeAttribute('required');
        }
    }

    // Jalankan saat halaman pertama kali dimuat
    document.addEventListener('DOMContentLoaded', toggleKeteranganValidasi);
    // Jalankan saat status berubah
    document.getElementById('status').addEventListener('change', toggleKeteranganValidasi);
</script>
