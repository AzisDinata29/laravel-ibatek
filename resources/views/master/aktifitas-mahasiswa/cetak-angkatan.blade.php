<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Aktifitas Mahasiswa</title>
    <style>
        @page {
            margin: 25px 35px;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            color: #333;
        }

        .header {
            width: 100%;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header .logo {
            width: 80px;
            height: auto;
            vertical-align: middle;
        }

        .header .title-container {
            width: calc(100% - 100px);
            text-align: center;
            vertical-align: middle;
        }

        .header h3,
        .header h4,
        .header p {
            margin: 0;
            padding: 0;
        }

        .header h3 {
            font-size: 16pt;
            font-weight: bold;
        }

        .header h4 {
            font-size: 14pt;
        }

        .header p {
            font-size: 9pt;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        h3 {
            text-align: center;
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <table class="header">
        <tr>
            <td style="width: 90px; border: none; padding: 0;">
                <img src="{{ $logo }}" alt="Logo" class="logo">
            </td>
            <td class="title-container" style="border: none; padding: 0;">
                <h3>UNIVERSITAS TEKNOKRAT INDONESIA</h3>
                <h4>Rekapitulasi Aktifitas Mahasiswa</h4>
                @if (!empty($filters['year']))
                    <p class="subtitle-year">TAHUN {{ $filters['year'] ?? now()->year }}</p>
                @endif
                <p>Jl. ZA. Pagar Alam No.9 -11, Labuhan Ratu, Kec. Kedaton, Kota Bandar Lampung, Lampung 35132</p>
            </td>
            <td style="width: 90px; border: none; padding: 0;">
                <img src="{{ $logo_ibatek }}" alt="Logo" class="logo">
            </td>
        </tr>
    </table>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>Nama Mahasiswa</th>
                <th>Fakultas</th>
                <th>Program Studi</th>
                <th>Total Durasi</th>
                <th>Kesimpulan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $i => $u)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $u->npm }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->fakultas_detail->name ?? '-' }}</td>
                    <td>{{ $u->prodi_detail->name ?? '-' }}</td>
                    <td>{{ $u->total_durasi_diterima ?? 0 }}</td>
                    <td>
                        @php
                            $total = $u->total_durasi_diterima ?? 0;
                            if ($total >= 70) {
                                $kesimpulan = 'Baik';
                            } elseif ($total >= 50) {
                                $kesimpulan = 'Cukup';
                            } else {
                                $kesimpulan = 'Kurang / Tidak Aktif Kegiatan';
                            }
                        @endphp
                        {{ $kesimpulan }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
