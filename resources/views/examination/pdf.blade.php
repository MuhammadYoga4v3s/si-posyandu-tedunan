<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pemeriksaan Balita</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; line-height: 1.4; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0; padding: 0; font-size: 18px; }
        .header p { margin: 5px 0 0; font-size: 12px; }
        .section-title { font-weight: bold; font-size: 14px; margin-top: 20px; margin-bottom: 10px; background-color: #f2f2f2; padding: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .no-border th, .no-border td { border: none; padding: 5px 0; }
        .footer { margin-top: 40px; text-align: right; }
        .signature { margin-top: 60px; font-weight: bold; text-decoration: underline; }
    </style>
</head>
<body>

    <div class="header">
        <h2>POSYANDU DESA TEDUNAN</h2>
        <p>Laporan Hasil Pemeriksaan Kesehatan Balita</p>
    </div>

    <!-- Data Utama -->
    <table class="no-border">
        <tr>
            <td width="20%"><strong>Nama Balita</strong></td>
            <td width="30%">: {{ $pemeriksaan->child->full_name }}</td>
            <td width="20%"><strong>Tanggal Pemeriksaan</strong></td>
            <td width="30%">: {{ \Carbon\Carbon::parse($pemeriksaan->activity->activity_date)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td><strong>Lokasi Posyandu</strong></td>
            <td>: {{ $pemeriksaan->activity->location }}</td>
            <td><strong>Kader Pemeriksa</strong></td>
            <td>: {{ $pemeriksaan->staff->full_name }}</td>
        </tr>
    </table>

    <div class="section-title">A. Pengukuran Pertumbuhan</div>
    <table>
        <tr>
            <th width="25%">Berat Badan</th>
            <th width="25%">Tinggi Badan</th>
            <th width="25%">Lingkar Kepala</th>
            <th width="25%">Lingkar Lengan Atas</th>
        </tr>
        <tr>
            <td>{{ $pemeriksaan->weight }} kg</td>
            <td>{{ $pemeriksaan->height }} cm</td>
            <td>{{ $pemeriksaan->head_circumference ?? '-' }} cm</td>
            <td>{{ $pemeriksaan->upper_arm_circumference ?? '-' }} cm</td>
        </tr>
    </table>

    <div class="section-title">B. Observasi & Intervensi</div>
    <table>
        <tr>
            <td width="50%"><strong>Lulus ASI Eksklusif:</strong> {{ $pemeriksaan->exclusive_breastfeeding ? 'Ya' : 'Tidak' }}</td>
            <td width="50%"><strong>Dapat MP-ASI:</strong> {{ $pemeriksaan->complementary_feeding ? 'Ya' : 'Tidak' }}</td>
        </tr>
        <tr>
            <td><strong>Diberikan Vitamin A:</strong> {{ $pemeriksaan->vitamin_a ? 'Ya' : 'Tidak' }}</td>
            <td><strong>Diberikan Obat Cacing:</strong> {{ $pemeriksaan->deworming ? 'Ya' : 'Tidak' }}</td>
        </tr>
        <tr>
            <td><strong>Batuk > 2 Minggu:</strong> {{ $pemeriksaan->cough_two_weeks ? 'Ya' : 'Tidak' }}</td>
            <td><strong>Demam > 2 Minggu:</strong> {{ $pemeriksaan->fever_two_weeks ? 'Ya' : 'Tidak' }}</td>
        </tr>
        <tr>
            <td><strong>BB Tidak Naik:</strong> {{ $pemeriksaan->weight_not_increasing ? 'Ya' : 'Tidak' }}</td>
            <td><strong>Riwayat Imunisasi:</strong> {{ $pemeriksaan->immunization ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">C. Catatan Khusus & Rujukan</div>
    <table>
        <tr>
            <td>
                <strong>Gejala Sakit:</strong> {{ $pemeriksaan->illness_symptoms ?? '-' }}<br><br>
                <strong>Rujukan:</strong> {{ $pemeriksaan->referral ?? '-' }}<br><br>
                <strong>Catatan Kader:</strong> {{ $pemeriksaan->notes ?? '-' }}
            </td>
        </tr>
    </table>

    <div class="footer">
        <p>Tedunan, {{ \Carbon\Carbon::parse($pemeriksaan->activity->activity_date)->translatedFormat('d F Y') }}</p>
        <p>Kader Pemeriksa,</p>
        <div class="signature">{{ $pemeriksaan->staff->full_name }}</div>
    </div>

</body>
</html>