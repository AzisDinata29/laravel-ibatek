@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-heading', 'Dashboard Admin')

@section('content')
    <section class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Mahasiswa</h6>
                                    <h6 class="font-extrabold mb-0">{{ $user }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{ route('admin') }}">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Admin</h6>
                                        <h6 class="font-extrabold mb-0">{{ $admin }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Fakultas</h6>
                                    <h6 class="font-extrabold mb-0">{{ $fakultas }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Prodi</h6>
                                    <h6 class="font-extrabold mb-0">{{ $prodi }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-danger text-white text-center">
                            ⏳Aktifitas Mahasiswa Menunggu Validasi
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tipe</th>
                                        <th class="text-center">Jumlah Harus Divalidasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipe as $p)
                                        <tr>
                                            <td>{{ $p->name ?? '-' }}</td>
                                            <td class="text-center">
                                                {{ $aktifitas_mahasiswa->where('tipe_aktifitas_mahasiswa_id', $p->id)->count() }}
                                            </td>
                                            <td>
                                                <a
                                                    href="{{ route('verifikasi-aktifitas-mahasiswa.index', ['tipe' => $p->name]) }}">Check</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-white d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <h5 class="mb-0">Aktifitas Mahasiswa (Status: Terima)</h5>
                            <form method="GET" action="{{ route('dashboard') }}"
                                class="d-flex align-items-center gap-2 flex-wrap">
                                <div class="d-flex align-items-center gap-2">
                                    <label class="me-2 text-muted small mb-0">Tahun</label>
                                    @php
                                        $currentYear = now()->year;
                                        $startYear = $currentYear - 5;
                                    @endphp
                                    <select name="year" class="form-select form-select-sm rounded-pill"
                                        onchange="this.form.submit()">
                                        @for ($y = $currentYear; $y >= $startYear; $y--)
                                            <option value="{{ $y }}"
                                                {{ (int) $year === (int) $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <label class="me-2 text-muted small mb-0">Tipe</label>
                                    <select name="tipe_id" class="form-select form-select-sm rounded-pill"
                                        onchange="this.form.submit()">
                                        <option value="">Semua Tipe</option>
                                        @foreach ($tipe as $t)
                                            <option value="{{ $t->id }}"
                                                {{ request('tipe_id') == $t->id ? 'selected' : '' }}>
                                                {{ $t->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div id="chartAktifitas"></div>
                                </div>
                                <div class="col-sm-4">
                                    <div id="chartDonut"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            const barData = @json($chartData);
            const donutLabels = @json($donutLabels);
            const donutValues = @json($donutValues);
            const barOptions = {
                chart: {
                    type: 'bar',
                    height: 360,
                    toolbar: {
                        show: true
                    }
                },
                series: barData.map(s => ({
                    name: s.name,
                    data: s.data.map(v => Math.round(v))
                })),
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
                },
                dataLabels: {
                    enabled: true,
                    formatter: val => parseInt(val),
                    style: {
                        fontSize: '11px'
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        borderRadius: 6
                    }
                },
                tooltip: {
                    y: {
                        formatter: v => `${parseInt(v)} kegiatan`
                    }
                },
                legend: {
                    position: 'bottom'
                },
                colors: ['#FFA000', '#28A745', '#007BFF', '#E83E8C', '#6F42C1', '#17A2B8']
            };

            new ApexCharts(document.querySelector('#chartAktifitas'), barOptions).render();

            const donutOptions = {
                chart: {
                    type: 'donut',
                    height: 320
                },
                labels: donutLabels,
                series: donutValues.map(v => Math.round(v)),
                colors: ['#FFA000', '#28A745', '#007BFF', '#E83E8C', '#6F42C1', '#17A2B8'],
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    y: {
                        formatter: v => `${parseInt(v)} kegiatan`
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: val => `${Math.round(val)}%`
                }
            };
            new ApexCharts(document.querySelector('#chartDonut'), donutOptions).render();
        </script>
    @endpush

@endsection
