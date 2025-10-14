@extends('layouts.app')

@section('title', 'Detail Mahasiswa')
@section('page-heading', 'Detail Mahasiswa')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold text-primary">
                        <i class="bi bi-person-badge-fill me-2"></i> Detail Mahasiswa
                    </h4>
                    <a href="{{ route('aktifitas-mahasiswa.index') }}"
                        class="btn btn-outline-secondary btn-sm rounded-pill d-flex align-items-center gap-1 px-3">
                        <i class="bi bi-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center mb-4">
                        @if ($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo"
                                class="rounded-circle border border-3 border-primary mb-3"
                                style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white mb-3"
                                style="width: 120px; height: 120px;">
                                <i class="bi bi-person-fill fs-1"></i>
                            </div>
                        @endif

                        <h5 class="fw-bold mb-0 text-dark">{{ $user->name }}</h5>
                        <span class="text-muted">NPM: {{ $user->npm }}</span>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="fw-semibold text-secondary">Fakultas</label>
                            <div class="border rounded-3 p-2 bg-light">{{ $user->fakultas_detail?->name ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold text-secondary">Program Studi</label>
                            <div class="border rounded-3 p-2 bg-light">{{ $user->prodi_detail?->name ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold text-secondary">Angkatan</label>
                            <div class="border rounded-3 p-2 bg-light">{{ $user->angkatan ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold text-secondary">Email</label>
                            <div class="border rounded-3 p-2 bg-light">{{ $user->email ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rounded-4 p-3 mb-4">
                <form method="GET" action="{{ route('aktifitas-mahasiswa.cetak', $user->id) }}" class="row g-3">
                    <div class="col-12 col-md-4">
                        <label class="form-label mb-1">Semester</label>
                        <select name="semester" id="filterSemester" class="form-select form-select-sm rounded-pill">
                            <option value="">Semua</option>
                            @for ($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>
                                    Semester {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-12 col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary btn-sm rounded-pill w-100">Cetak</button>
                    </div>
                </form>
            </div>
            <div class="rounded-4 p-3 mb-4">
                <form method="GET" action="{{ route('aktifitas-mahasiswa.show', $user->id) }}" class="row g-3">
                    <div class="col-12 col-md-4">
                        <label class="form-label mb-1">Semester</label>
                        <select name="semester" id="filterSemester" class="form-select form-select-sm rounded-pill">
                            <option value="">Semua</option>
                            @for ($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>
                                    Semester {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label mb-1">Tipe Aktivitas</label>
                        <select name="tipe_id" id="filterTipe" class="form-select form-select-sm rounded-pill">
                            <option value="">Semua</option>
                            @foreach ($tipeAktifitas as $t)
                                <option value="{{ $t->id }}" {{ request('tipe_id') == $t->id ? 'selected' : '' }}>
                                    {{ $t->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary btn-sm rounded-pill w-100">Filter</button>
                    </div>
                </form>
            </div>
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold text-primary">Aktivitas Mahasiswa</h5>
                </div>
                <div class="card-body p-0">
                    @foreach ($visibleSemesters as $s)
                        @php
                            $data = $bySemester[$s] ?? [
                                'items' => collect(),
                                'total_durasi' => 0,
                                'jumlah_kegiatan' => 0,
                                'nilai' => 'Kurang / Tidak Aktif Kegiatan',
                            ];

                            $badgeClass = 'bg-secondary';
                            if ($data['nilai'] === 'Baik') {
                                $badgeClass = 'bg-success';
                            } elseif ($data['nilai'] === 'Kurang Baik') {
                                $badgeClass = 'bg-warning text-dark';
                            }
                        @endphp

                        <div class="card shadow-sm border-0 rounded-4 mb-4">
                            <div class="card-header bg-white">
                                <div
                                    class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                                    <h5 class="mb-0 fw-bold text-primary">Semester {{ $s }}
                                    </h5>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge bg-info">
                                            {{ $data['jumlah_kegiatan'] }} kegiatan
                                        </span>
                                        <span class="badge bg-primary">
                                            Total: {{ $data['total_durasi'] }} Jam
                                        </span>
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $data['nilai'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:56px">No</th>
                                                <th>Tipe</th>
                                                <th>Label</th>
                                                <th>Semester</th>
                                                <th>Durasi</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data['items'] as $i => $a)
                                                <tr>
                                                    <td class="text-center">{{ $i + 1 }}</td>
                                                    <td>{{ $a->tipe?->name ?? '-' }}</td>
                                                    <td>{{ $a->label }}</td>
                                                    <td>{{ $a->semester }}</td>
                                                    <td>
                                                        @php
                                                            $menit = (int) ($a->durasi ?? 0);
                                                            $jam = intdiv($menit, 60);
                                                            $sis = $menit % 60;
                                                        @endphp
                                                        {{ $jam }} jam{{ $sis ? " {$sis} menit" : '' }}
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($a->tanggal_mulai)->format('d M Y') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($a->tanggal_selesai)->format('d M Y') }}
                                                    </td>
                                                    <td>{{ $a->keterangan ?? '-' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted py-3">
                                                        <i class="bi bi-info-circle me-1"></i>
                                                        Tidak ada data aktivitas diterima pada semester ini.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
