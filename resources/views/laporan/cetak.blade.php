<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Aktivitas Mahasiswa</title>
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

        .filter-info {
            font-size: 9pt;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            padding: 8px;
            border-radius: 4px;
        }

        .filter-info b {
            display: inline-block;
            min-width: 80px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 8px 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        thead th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
            border-bottom: 2px solid #666;
            font-size: 9.5pt;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .text-center {
            text-align: center;
        }

        .no-data {
            padding: 20px;
            font-style: italic;
            color: #777;
        }

        .footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 40px;
            font-size: 9pt;
            border-top: 1px solid #ccc;
            padding-top: 5px;
        }

        .footer .page-number:before {
            content: "Halaman " counter(page);
        }

        .footer .print-date {
            float: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 9pt;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            vertical-align: top;
        }

        thead th {
            background-color: #f2f2f2;
            font-weight: bold;
            border-bottom: 2px solid #666;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .no-wrap {
            white-space: nowrap;
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
                <h4>Laporan Aktivitas Mahasiswa</h4>
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
                <th class="text-center" style="width: 4%;">No</th>
                <th class="text-left" style="width: 24%;">Mahasiswa</th>
                <th class="text-center" style="width: 15%;">Tipe Aktivitas</th>
                <th class="text-center no-wrap" style="width: 8%;">Semester</th>
                <th class="text-center no-wrap" style="width: 10%;">Tanggal</th>
                <th class="text-left" style="width: 39%;">Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $i => $row)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-left">
                        <b>{{ $row->user->name ?? '-' }}</b> <br>
                        NPM: {{ $row->user->npm ?? '-' }} <br>
                        Prodi: {{ $row->user->prodi_detail->name ?? '-' }} <br>
                        Angkatan: {{ $row->user->angkatan ?? '-' }}
                    </td>
                    <td class="text-center">{{ $row->tipe->name ?? '-' }}</td>
                    <td class="text-center no-wrap">{{ $row->semester }}</td>
                    <td class="text-center no-wrap">{{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d-m-Y') }}
                    </td>
                    <td class="text-left">
                        <b>{{ $row->label }}</b>
                        <br> {{ $row->label_detail }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center no-data">Tidak ada data yang sesuai dengan filter yang
                        dipilih.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <span class="page-number"></span>
        <span class="print-date">
            Dicetak pada: {{ now()->translatedFormat('d F Y, H:i') }}
        </span>
    </div>

</body>

</html>
