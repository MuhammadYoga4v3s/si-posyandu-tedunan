<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Kegiatan Posyandu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        /* Menggunakan tabel untuk Kop Surat agar logo dan teks sejajar di PDF */
        .kop-surat {
            width: 100%;
            text-align: center;
        }
        .kop-surat td {
            vertical-align: middle;
        }
        .logo-kiri { width: 80px; }
        .logo-kanan { width: 80px; }
        .teks-kop h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }
        .teks-kop p {
            margin: 2px 0;
            font-size: 12px;
        }
        .judul-laporan {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .info-kegiatan {
            width: 100%;
            margin-bottom: 15px;
        }
        .info-kegiatan td {
            padding: 3px;
        }
        table.data-tabel {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table.data-tabel th, table.data-tabel td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        table.data-tabel th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .text-center { text-align: center; }
        .ttd-container {
            width: 100%;
            margin-top: 30px;
        }
        .ttd-kiri {
            float: left;
            width: 50%;
        }
        .ttd-kanan {
            float: right;
            width: 40%;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- KOP SURAT -->
    <div class="header">
        <table class="kop-surat">
            <tr>
                <!-- Pastikan path gambarnya benar. Karena ini merender PDF di server, lebih baik path absolut atau base64 -->
                <!-- Jika error, kamu bisa menghapus elemen img ini -->
                <td class="logo-kiri">
                    <img src="{{ public_path('images/logo.png') }}" width="70" alt="Logo Posyandu">
                </td>
                <td class="teks-kop">
                    <h1>POSYANDU DESA TEDUNAN</h1>
                    <p>Kecamatan Wedung, Kabupaten Demak, Provinsi Jawa Tengah</p>
                    <p>Sistem Informasi Posyandu Integrasi • Support by TIM KKN-T UNDIP 88</p>
                </td>
                <td class="logo-kanan">
                    <img src="{{ public_path('images/logoKKN.png') }}" width="90" alt="Logo KKN">
                </td>
            </tr>
        </table>
    </div>

    <!-- JUDUL -->
    <div class="judul-laporan">
        LAPORAN HASIL PELAKSANAAN POSYANDU BALITA
    </div>

    <!-- INFO KEGIATAN -->
    <table class="info-kegiatan">
        <tr>
            <td width="150"><strong>Tanggal Pelaksanaan</strong></td>
            <td width="10">:</td>
            <td>{{ \Carbon\Carbon::parse($kegiatan->activity_date)->locale('id')->translatedFormat('l, d F Y') }}</td>
        </tr>
        <tr>
            <td><strong>Lokasi Kegiatan</strong></td>
            <td>:</td>
            <td>{{ $kegiatan->location }}</td>
        </tr>
        <tr>
            <td><strong>Periode</strong></td>
            <td>:</td>
            <td>
                @php
                    $namaBulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                @endphp
                {{ $namaBulan[$kegiatan->month] }} {{ $kegiatan->year }}
            </td>
        </tr>
        <tr>
            <td><strong>Total Balita Terdata</strong></td>
            <td>:</td>
            <td>{{ $kegiatan->examinations->count() }} Balita</td>
        </tr>
    </table>

    <!-- TABEL DATA -->
    <table class="data-tabel">
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Nama Balita</th>
                <th width="30">JK</th>
                <th>Nama Ibu</th>
                <th>Alamat (RT/RW)</th>
                <th width="50">BB (kg)</th>
                <th width="50">TB (cm)</th>
                <th>Layanan Diberikan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kegiatan->examinations as $idx => $exam)
                <tr>
                    <td class="text-center">{{ $idx + 1 }}</td>
                    <td><strong>{{ $exam->child->full_name }}</strong></td>
                    <td class="text-center">
                        {{ in_array(strtolower($exam->child->gender), ['l', 'laki-laki', 'male']) ? 'L' : 'P' }}
                    </td>
                    <td>{{ $exam->child->mother_name ?? '-' }}</td>
                    <td>
                        {{ $exam->child->address ?? 'Tedunan' }} 
                        @if($exam->child->rt || $exam->child->rw)
                            (RT {{ $exam->child->rt }}/RW {{ $exam->child->rw }})
                        @endif
                    </td>
                    <td class="text-center"><strong>{{ $exam->weight }}</strong></td>
                    <td class="text-center"><strong>{{ $exam->height }}</strong></td>
                    <td>
                        @php
                            $layanan = [];
                            if($exam->vitamin_a) $layanan[] = 'Vit A';
                            if($exam->deworming) $layanan[] = 'Obat Cacing';
                            if($exam->local_food_program) $layanan[] = 'PMT';
                            if($exam->immunization) $layanan[] = 'Imunisasi (' . $exam->immunization . ')';
                        @endphp
                        {{ count($layanan) > 0 ? implode(', ', $layanan) : 'Pemeriksaan Rutin' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data pemeriksaan balita yang dicatat pada kegiatan posyandu ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TANDA TANGAN -->
    <div class="ttd-container">
        <div class="ttd-kiri">
            <strong>Catatan Pelaksanaan:</strong><br>
            <i>{{ $kegiatan->description ?? 'Pelaksanaan kegiatan Posyandu berjalan dengan lancar.' }}</i>
        </div>
        <div class="ttd-kanan">
            Tedunan, {{ \Carbon\Carbon::parse($kegiatan->activity_date)->locale('id')->translatedFormat('d F Y') }}<br>
            <strong>Ketua Kader Posyandu Desa Tedunan</strong>
            <br><br><br><br><br><br>
            <span style="text-decoration: underline;">( _______________________ )</span>
        </div>
    </div>

</body>
</html>