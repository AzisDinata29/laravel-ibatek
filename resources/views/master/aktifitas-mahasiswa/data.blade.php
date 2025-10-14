@extends('layouts.app')

@section('title', 'Aktifitas Mahasiswa')
@section('page-heading', 'Aktifitas Mahasiswa')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Aktifitas Mahasiswa</h4>
                </div>
                <div class="card-body">
                    <div class="rounded-4 p-3 mb-4">
                        <form method="GET" action="{{ route('aktifitas-mahasiswa.index') }}" class="row g-3">
                            <div class="col-12 col-md-4">
                                <label class="form-label mb-1">Fakultas</label>
                                <select name="fakultas_id" id="filterFakultas"
                                    class="form-select form-select-sm rounded-pill" required>
                                    <option value="" selected disabled>-- Pilih Fakultas --</option>
                                    @foreach ($fakultas ?? [] as $f)
                                        <option value="{{ $f->id }}"
                                            {{ request('fakultas_id') == $f->id ? 'selected' : '' }}>
                                            {{ $f->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label mb-1">Program Studi</label>
                                <select name="prodi_id" id="filterProdi" class="form-select form-select-sm rounded-pill"
                                    required>
                                    <option value="" selected disabled>-- Pilih Prodi --</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label mb-1">Angkatan</label>
                                @php $current = now()->year; @endphp
                                <select name="angkatan" class="form-select rounded-pill" required>
                                    <option value="" {{ request('angkatan') == '' ? 'selected' : '' }}>Pilih Tahun
                                    </option>
                                    @for ($y = $current; $y >= $current - 10; $y--)
                                        <option value="{{ $y }}"
                                            {{ request('angkatan') == $y ? 'selected' : '' }}>
                                            {{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-12 col-md-1 d-flex align-items-end gap-2">
                                <button type="submit" class="btn btn-primary w-100 btn-sm rounded-pill">Filter</button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table id="dataTables" class="table table-striped table-hover align-middle nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Name</th>
                                    <th>NPM</th>
                                    <th>Fakultas</th>
                                    <th>Prodi</th>
                                    <th>Angkatan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>

                                        <td>
                                            @if ($user->profile_photo)
                                                <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                                    alt="Profile Photo"
                                                    class="rounded-circle border border-3 border-primary"
                                                    style="width: 64px; height: 64px; object-fit: cover;" />
                                            @else
                                                <span>No Photo</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->npm }}</td>
                                        <td>{{ $user->fakultas_detail?->name }}</td>
                                        <td>{{ $user->prodi_detail?->name }}</td>
                                        <td>{{ $user->angkatan }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('aktifitas-mahasiswa.show', $user->id) }}"
                                                class="btn btn-sm btn-info rounded-pill px-3 d-flex align-items-center justify-content-center gap-1">
                                                <i class="bi bi-eye-fill"></i> Detail
                                            </a>
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
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fakultasSelect = document.getElementById('filterFakultas');
            const prodiSelect = document.getElementById('filterProdi');
            const selectedProdi = "{{ request('prodi_id') ?? '' }}";

            fakultasSelect.addEventListener('change', function() {
                const fakultasId = this.value;
                prodiSelect.innerHTML = '<option value="">Pilih Prodi</option>';

                if (fakultasId) {
                    fetch(`/prodi/by-fakultas/${fakultasId}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(prodi => {
                                const opt = document.createElement('option');
                                opt.value = prodi.id;
                                opt.textContent = prodi.name;
                                if (selectedProdi == prodi.id) opt.selected = true;
                                prodiSelect.appendChild(opt);
                            });
                        });
                }
            });

            // trigger otomatis saat load pertama kali
            if (fakultasSelect.value) fakultasSelect.dispatchEvent(new Event('change'));
        });
    </script>
    <script>
        $('#dataTables').DataTable({
            responsive: true
        });
    </script>
@endpush
