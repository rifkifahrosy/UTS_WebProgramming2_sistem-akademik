<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Jurusan — Sistem Akademik</title>
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #1e293b;
            margin: 30px;
            font-size: 12px;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px double #1e293b;
            padding-bottom: 15px;
            position: relative;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #475569;
            font-size: 13px;
        }
        .meta-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            color: #475569;
            font-size: 11px;
            font-weight: 500;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #94a3b8;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f1f5f9;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            color: #1e293b;
        }
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .text-center {
            text-align: center;
        }
        .footer-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
            page-break-inside: avoid;
        }
        .signature-box {
            text-align: center;
            width: 220px;
            font-size: 11px;
        }
        .signature-box .date {
            margin-bottom: 10px;
        }
        .signature-box .title {
            margin-bottom: 65px;
            font-weight: 500;
        }
        .signature-box .name {
            font-weight: 700;
            text-decoration: underline;
            text-transform: uppercase;
        }
        @media print {
            body {
                margin: 0;
            }
            @page {
                size: A4 portrait;
                margin: 1.5cm;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <!-- Header Kop Surat -->
    <div class="header">
        <h1>SISTEM INFORMASI AKADEMIK</h1>
        <p>Laporan Data Jurusan Kampus</p>
    </div>

    <!-- Metadata Laporan -->
    <div class="meta-info">
        <div>Dicetak oleh: <strong>{{ Auth::user()->name }}</strong></div>
        <div>Tanggal: <strong>{{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</strong></div>
    </div>

    <!-- Data Table -->
    <table>
        <thead>
            <tr>
                <th style="width: 40px;" class="text-center">No</th>
                <th>Nama Jurusan</th>
                <th style="width: 120px;" class="text-center">Akreditasi</th>
                <th style="width: 120px;" class="text-center">Mahasiswa</th>
                <th style="width: 120px;" class="text-center">Mata Kuliah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jurusan as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td style="font-weight: 500;">{{ $item->nama_jurusan }}</td>
                <td class="text-center">{{ $item->akreditasi }}</td>
                <td class="text-center">{{ $item->mahasiswa_count }}</td>
                <td class="text-center">{{ $item->matakuliah_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Signature Section -->
    <div class="footer-section">
        <div class="signature-box">
            <div class="date">Jakarta, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
            <div class="title">Administrator Akademik</div>
            <div class="name">{{ Auth::user()->name }}</div>
            <div>NIP. ———————</div>
        </div>
    </div>
</body>
</html>
