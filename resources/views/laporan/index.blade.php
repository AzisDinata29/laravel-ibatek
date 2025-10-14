@extends('layouts.app')
@section('title', 'Laporan Aktivitas Mahasiswa')
@section('page-heading', 'Laporan Aktivitas Mahasiswa')

@section('content')
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Filter Laporan</h5>
        </div>
        <div class="card-body">
            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-2">
                    <label class="form-label mb-1 fw-semibold text-secondary">Status</label>
                    <select name="status" class="form-select rounded-pill">
                        <option value="" {{ request('status') == '' ? 'selected' : '' }}>Pilih Status</option>
                        <option value="Terima" {{ request('status') == 'Terima' ? 'selected' : '' }}>Terima</option>
                        <option value="Tidak Diterima" {{ request('status') == 'Tidak Diterima' ? 'selected' : '' }}>Tidak
                            Diterima</option>
                        <option value="Menunggu Validasi" {{ request('status') == 'Menunggu Validasi' ? 'selected' : '' }}>
                            Menunggu Validasi</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label mb-1 fw-semibold text-secondary">Tahun</label>
                    @php $current = now()->year; @endphp
                    <select name="year" class="form-select rounded-pill" required>
                        <option value="" {{ request('year') == '' ? 'selected' : '' }}>Pilih Tahun</option>
                        @for ($y = $current; $y >= $current - 10; $y--)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                {{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label mb-1 fw-semibold text-secondary">Angkatan</label>
                    <select name="angkatan" class="form-select rounded-pill">
                        <option value="" {{ request('angkatan') == '' ? 'selected' : '' }}>Pilih Angkatan</option>
                        @for ($a = $current; $a >= $current - 10; $a--)
                            <option value="{{ $a }}" {{ request('angkatan') == $a ? 'selected' : '' }}>
                                {{ $a }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label mb-1 fw-semibold text-secondary">Program Studi</label>
                    <select name="prodi" class="form-select rounded-pill">
                        <option value="" {{ request('prodi') == '' ? 'selected' : '' }}>Pilih Program Studi</option>
                        @foreach ($prodis as $p)
                            <option value="{{ $p->id }}" {{ request('prodi') == $p->id ? 'selected' : '' }}>
                                {{ $p->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label mb-1 fw-semibold text-secondary">Tipe Aktivitas</label>
                    <select name="tipe_id" class="form-select rounded-pill">
                        <option value="" {{ request('tipe_id') == '' ? 'selected' : '' }}>Pilih Tipe</option>
                        @foreach ($tipe as $t)
                            <option value="{{ $t->id }}" {{ request('tipe_id') == $t->id ? 'selected' : '' }}>
                                {{ $t->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 text-end">
                    <button class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-search"></i> Tampilkan Data
                    </button>

                    @php
                        $hasFilter =
                            request()->filled('status') ||
                            request()->filled('year') ||
                            request()->filled('angkatan') ||
                            request()->filled('prodi') ||
                            request()->filled('tipe_id');
                    @endphp

                    <a href="{{ $hasFilter ? route('laporan.cetak', request()->all()) : '#' }}"
                        class="btn btn-danger rounded-pill {{ $hasFilter ? '' : 'disabled' }}"
                        @if (!$hasFilter) aria-disabled="true" tabindex="-1" @endif>
                        <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                            <th>Tipe</th>
                            <th>Kegiatan</th>
                            <th>Semester</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $i => $row)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $row->user->npm ?? '-' }}</td>
                                <td>
                                    {{ $row->user->name ?? '-' }}
                                </td>
                                <td>{{ $row->user->prodi_detail->name ?? '-' }}</td>
                                <td>{{ $row->user->angkatan ?? '-' }}</td>
                                <td>{{ $row->tipe->name ?? '-' }}</td>
                                <td>
                                    {{ $row->label }}
                                    <br> {{ $row->label_detail }}
                                </td>
                                <td>{{ $row->semester }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y') }}</td>
                                <td>
                                    <span
                                        class="badge 
                                    @if ($row->status == 'Terima') bg-success 
                                    @elseif($row->status == 'Tidak Diterima') bg-danger 
                                    @else bg-warning text-dark @endif">
                                        {{ $row->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
