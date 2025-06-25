<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Rekam Medis</title>
    <style>
        @page { margin: 1.5cm 2cm; }
        body {
            font-family: Arial, sans-serif;
            font-size: 9pt;
            line-height: 1.3;
            color: #000;
        }
        .header {
            text-align: center;
            border-bottom: 2px double #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 13pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }
        .header p {
            margin: 2px 0;
            font-size: 8pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 1px 3px;
            vertical-align: top;
        }
        .section {
            margin: 8px 0;
        }
        .section-header {
            background: #f0f0f0;
            padding: 2px 5px;
            font-weight: bold;
            font-size: 9pt;
            margin-bottom: 3px;
            border-left: 3px solid #666;
        }
        .vital-signs {
            display: flex;
            justify-content: space-between;
        }
        .vital-item {
            margin-right: 15px;
        }
        .result-item {
            margin-bottom: 5px;
            padding: 0 5px;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            width: 80px;
        }
        .signature-box {
            margin-top: 20px;
            text-align: right;
            padding-right: 20px;
        }
        .sign-line {
            margin: 25px 0 3px auto;
            width: 150px;
            border-bottom: 1px solid #000;
        }
        .no-margin { margin: 0; }
        .small-text { font-size: 8pt; }
        .box {
            border: 1px solid #000;
            padding: 5px;
            margin: 3px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rekam Medis Pasien</h1>
        <p><strong>PRAKTIK DOKTER UMUM</strong></p>
        <p>Jl. Raya No. 123, Jakarta Selatan</p>
        <p>Telp: (021) 1234567 | Email: info@praktikdokter.com</p>
    </div>

    <table class="info-table">
        <tr>
            <td style="width: 60%">
                <table>
                    <tr>
                        <td style="width: 100px">No. Rekam Medis</td>
                        <td>: <strong>{{ $pemeriksaan->pasien->no_rekam_medis }}</strong></td>
                    </tr>
                    <tr>
                        <td>Nama Pasien</td>
                        <td>: <strong>{{ $pemeriksaan->pasien->nama }}</strong></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: {{ $pemeriksaan->pasien->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: {{ \Carbon\Carbon::parse($pemeriksaan->pasien->tanggal_lahir)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($pemeriksaan->pasien->tanggal_lahir)->age }} tahun)</td>
                    </tr>
                </table>
            </td>
            <td style="width: 40%; text-align: right">
                <div class="box">
                    <strong>Tanggal Pemeriksaan:</strong><br>
                    {{ \Carbon\Carbon::parse($pemeriksaan->tanggal_kunjungan)->isoFormat('dddd, D MMMM Y') }}
                </div>
            </td>
        </tr>
    </table>

    <div class="section">
        <div class="section-header">TANDA VITAL</div>
        <table>
            <tr>
                <td style="width: 33%">Tekanan Darah: {{ $pemeriksaan->tekanan_darah }} mmHg</td>
                <td style="width: 33%">Detak Jantung: {{ $pemeriksaan->detak_jantung }} bpm</td>
                <td>Suhu: {{ $pemeriksaan->suhu_tubuh }}°C</td>
            </tr>
            <tr>
                <td>Berat Badan: {{ $pemeriksaan->berat_badan }} kg</td>
                <td>Tinggi Badan: {{ $pemeriksaan->tinggi_badan }} cm</td>
                <td>BMI: {{ number_format($pemeriksaan->berat_badan / pow($pemeriksaan->tinggi_badan/100, 2), 1) }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-header">PEMERIKSAAN</div>
        <div class="box">
            <strong>Keluhan Utama:</strong><br>
            {{ $pemeriksaan->keluhan }}
        </div>
        <div class="box">
            <strong>Diagnosis:</strong><br>
            {{ $pemeriksaan->diagnosis }}
        </div>
        @if($pemeriksaan->resep_obat)
        <div class="box">
            <strong>Resep Obat:</strong><br>
            {{ $pemeriksaan->resep_obat }}
        </div>
        @endif
    </div>

    <div class="signature-box">
        <p class="no-margin">Jakarta, {{ \Carbon\Carbon::parse($pemeriksaan->tanggal_kunjungan)->isoFormat('D MMMM Y') }}</p>
        <p class="no-margin">Dokter Pemeriksa,</p>
        <div class="sign-line"></div>
        <p class="no-margin">(............................................)</p>
        <p class="small-text no-margin">Tanda tangan & Nama Lengkap</p>
    </div>
</body>
</html> 