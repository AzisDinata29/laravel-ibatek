<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Buku Aktivitas Mahasiswa</title>

    <style>
        @page {
            margin: 24px 28px;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
        }

        h2,
        h3 {
            margin: 0;
        }

        .title {
            text-align: center;
            margin-bottom: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px 8px;
            vertical-align: top;
        }

        th {
            background: #f2c94c;
        }

        .no {
            width: 28px;
            text-align: center;
        }

        .jenis {
            width: 38%;
        }

        .tgl {
            width: 16%;
            text-align: center;
        }

        .wkt {
            width: 10%;
            text-align: center;
        }

        .ket {
            width: 18%;
        }

        .signature {
            margin-top: 16px;
            width: 100%;
        }

        .signature td {
            border: none;
        }

        /* ===== Kartu Profil ===== */
        .profile-card {
            position: relative;
            border: 1px solid #b9bec5;
            border-radius: 6px;
            padding: 12px;
            background: #fff;
            margin-bottom: 12px;
            font-size: 11px;
            color: #1b1f24;
        }

        .profile-rowwrap {
            padding-right: 28mm;
        }

        .profile-row {
            margin: 2px 0 6px;
            line-height: 1.45;
            white-space: normal;
        }

        .profile-row .col-label,
        .profile-row .col-colon,
        .profile-row .col-val {
            display: inline-block;
            vertical-align: top;
        }

        .profile-row .col-label {
            width: 36%;
            color: #606770;
            font-weight: 600;
        }

        .profile-row .col-colon {
            width: 6mm;
            text-align: center;
            color: #606770;
        }

        .profile-row .col-val {
            width: 58%;
            border-bottom: 1px dotted #999;
            padding-bottom: 6px;
            min-height: 5mm;
            word-wrap: break-word;
        }

        .photo-box {
            position: absolute;
            right: 0;
            top: 0;
            width: 20mm;
            height: 30mm;
            border: 1px solid #666;
            background: #fff;
            text-align: center;
            line-height: 30mm;
            font-size: 10px;
        }

        .photo-box img {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            max-height: 100%;
            line-height: normal;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0 6px;
            font-size: 11px;
        }

        .summary td {
            border: none;
            padding: 2px 0;
            vertical-align: top;
        }

        .summary .label {
            width: 38%;
            font-weight: 600;
            color: #606770;
        }

        .summary .colon {
            width: 6mm;
            text-align: center;
            color: #606770;
        }

        .summary .val {
            width: auto;
            border-bottom: 1px dotted #999;
        }

        /* ===== Layout per halaman semester (ramah Dompdf) ===== */
        .sem-page {
            display: table;
            width: 100%;
            table-layout: fixed;
            height: 284mm;
            /* A4 (297mm) - perkiraan margin vertikal total ≈ 12.7mm */
            page-break-after: always;
        }

        .sem-page.last {
            page-break-after: auto;
        }

        /* hindari blank page di akhir dokumen */

        .sem-body {
            display: table-row;
            height: auto;
        }

        .sem-footer {
            display: table-row;
            height: 42mm;
        }

        /* tinggi area tanda tangan, sesuaikan 38–50mm */

        @media print {
            .sem-page {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>

    <h3 style="text-align:center;margin:2px 0 10px;">PROFIL MAHASISWA</h3>
    <div class="profile-card">
        @php
            $jkRaw = strtolower($user->jenis_kelamin ?? '');
            $isMale = in_array($jkRaw, ['laki-laki', 'l', 'male'], true);
            $isFemale = in_array($jkRaw, ['perempuan', 'p', 'female'], true);
            $fotoPath = !empty($user->profile_photo) ? storage_path('app/public/' . $user->profile_photo) : null;
            $val = fn($v) => $v !== null && $v !== '' ? e($v) : '-';
        @endphp

        <div class="profile-rowwrap">
            <div class="profile-row">
                <span class="col-label">Nama</span><span class="col-colon">:</span>
                <span class="col-val">{{ $val($user->name ?? null) }}</span>
            </div>
            <div class="profile-row">
                <span class="col-label">NPM</span><span class="col-colon">:</span>
                <span class="col-val">{{ $val($user->npm ?? null) }}</span>
            </div>
            <div class="profile-row">
                <span class="col-label">Program Studi</span><span class="col-colon">:</span>
                <span class="col-val">{{ $val(optional($user->prodi_detail)->name ?? null) }}</span>
            </div>
            <div class="profile-row">
                <span class="col-label">Jenis Kelamin</span><span class="col-colon">:</span>
                <span class="col-val">
                    <span style="{{ $isMale ? 'font-weight:bold' : '' }}">Laki-Laki</span> /
                    <span style="{{ $isFemale ? 'font-weight:bold' : '' }}">Perempuan</span>
                </span>
            </div>
            <div class="profile-row">
                <span class="col-label">No Handphone / Whatsapp</span><span class="col-colon">:</span>
                <span class="col-val">{{ $val($user->nomor_telpon ?? null) }}</span>
            </div>
            <div class="profile-row">
                <span class="col-label">E-mail</span><span class="col-colon">:</span>
                <span class="col-val">{{ $val($user->email ?? null) }}</span>
            </div>
            <div class="profile-row">
                <span class="col-label">Angkatan</span><span class="col-colon">:</span>
                <span class="col-val">{{ $val($user->angkatan ?? null) }}</span>
            </div>
        </div>

        <div class="photo-box">
            @if ($fotoPath && file_exists($fotoPath))
                <img src="file://{{ $fotoPath }}" alt="Foto 2x3" />
            @endif
        </div>
    </div>

    <div style="page-break-after: always;"></div>

    @php
        // Atur kapasitas baris aman per halaman (tanpa baris kosong).
        $rowsPerPage = 20;
    @endphp

    @foreach ($semesters as $sIndex => $sem)
        @php
            // Pastikan items berupa array agar aman untuk array_chunk()
            $itemsArr = is_array($sem['items'])
                ? $sem['items']
                : (is_object($sem['items']) && method_exists($sem['items'], 'toArray')
                    ? $sem['items']->toArray()
                    : (array) $sem['items']);

            $chunks = array_chunk($itemsArr, $rowsPerPage);
            if (empty($chunks)) {
                $chunks = [[]];
            }

            // Penanda halaman terakhir di seluruh dokumen (untuk hilangkan page break terakhir)
            $isSemesterTerakhir = $sIndex === count($semesters) - 1;
        @endphp

        @foreach ($chunks as $pageIndex => $items)
            @php
                $isHalamanTerakhirSemester = $pageIndex === count($chunks) - 1;
                $isHalamanTerakhirDokumen = $isSemesterTerakhir && $isHalamanTerakhirSemester;
                $pageClass = $isHalamanTerakhirDokumen ? 'sem-page last' : 'sem-page';
            @endphp

            <div class="{{ $pageClass }}">
                <!-- ISI HALAMAN -->
                <div class="sem-body">
                    <h3 style="text-align:center;margin:2px 0 10px;">
                        Semester {{ $sem['no'] }} ({{ $sem['judul'] }})
                        @if (count($chunks) > 1)
                            – Hal. {{ $pageIndex + 1 }} / {{ count($chunks) }}
                        @endif
                    </h3>

                    <table>
                        <thead>
                            <tr>
                                <th class="no">No.</th>
                                <th class="tipe">Tipe</th>
                                <th class="jenis">Jenis Kegiatan</th>
                                <th class="tgl">Tanggal</th>
                                <th class="wkt">Waktu</th>
                                <th class="ket">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $i => $row)
                                <tr>
                                    <td class="no">{{ $pageIndex * $rowsPerPage + $i + 1 }}.</td>
                                    <td class="tipe">{{ $row['tipe'] ?? '' }}</td>
                                    <td class="jenis">{{ $row['jenis'] ?? '' }}</td>
                                    <td class="tgl">{{ $row['tgl'] ?? '' }}</td>
                                    <td class="wkt">
                                        {{ $row['waktu'] ?? '' }}
                                    </td>
                                    <td class="ket">{{ $row['ket'] ?? '' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align:center; padding:12px;">
                                        Tidak ada data pada halaman ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if ($isHalamanTerakhirSemester)
                        <!-- Ringkasan hanya di halaman terakhir semester -->
                        <table class="summary">
                            <tr>
                                <td class="label">Total Durasi Semester {{ $sem['no'] }}</td>
                                <td class="colon">:</td>
                                <td class="val">{{ $sem['total'] }} jam</td>
                            </tr>
                            <tr>
                                <td class="label">Kesimpulan</td>
                                <td class="colon">:</td>
                                <td class="val">{{ $sem['kesimpulan'] }}</td>
                            </tr>
                        </table>
                    @endif
                </div>

                <!-- FOOTER (TTD) SELALU DI BAWAH -->
                <div class="sem-footer">
                    <table class="signature">
                        <tr>
                            <td style="width:60%;">
                                <br>
                                Menyetujui,<br>Wakil Rektor III<br><br><br><br>
                                (........................................)
                            </td>
                            <td style="text-align:left;">
                                Bandar Lampung, ................ 20....<br>
                                Mengetahui,<br>Ketua Program Studi / Pengelola Beasiswa UTI<br><br><br><br>
                                (........................................)
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        @endforeach
    @endforeach

</body>

</html>
