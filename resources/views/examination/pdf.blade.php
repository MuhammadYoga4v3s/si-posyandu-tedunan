<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kartu Bantu Posyandu</title>

    <style>
        @php
            \Carbon\Carbon::setLocale('id');

            // Warna kertas
            $rawGender = strtolower($pemeriksaan->child->gender ?? '');
            if (in_array($rawGender, ['perempuan', 'p', 'female', 'f'])) {
                $bgColor = '#FFB6C1'; // pink
            } else {
                $bgColor = '#ADD8E6'; // biru
            }

            $displayGender = '-';
            if (in_array($rawGender, ['l', 'laki-laki', 'male', 'm'])) {
                $displayGender = 'Laki-laki';
            } elseif (in_array($rawGender, ['p', 'perempuan', 'female', 'f'])) {
                $displayGender = 'Perempuan';
            }
        @endphp

        /* PENGATURAN KERTAS & LAYOUT PDF DOMPDF - DIUBAH KE A4 AGAR PADAT */
        @page {
            size: A4 landscape;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 10px;
            margin-right: 10px;
        }

        html, body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: {{ $bgColor }} !important;
            margin: 0;
            padding: 2px;
            color: #000000;
            font-size: 7px;
            width: 100%;
            height: 100%;
        }

        table.kartu {
            width: 100%;
            border-collapse: collapse;
            background-color: transparent !important;
            table-layout: fixed;
        }

        table.kartu th, table.kartu td {
            border: 1px solid #000000;
            background-color: transparent !important;
            vertical-align: middle;
            word-wrap: break-word;
            overflow: hidden;
        }

        table.kartu th {
            text-align: center;
            font-size: 6.5px;
            line-height: 1.1;
            padding: 1px;
        }

        table.kartu td {
            text-align: center;
            height: 15px; /* Tinggi baris dirapatkan */
            font-size: 7px;
            padding: 1px;
        }

        .header-title {
            text-align: center;
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 6px;
        }

        /* SPASI IDENTITAS DIRAPATKAN MAKSIMAL */
        .identitas-table {
            width: 75%;
            margin-bottom: 6px;
            border: none;
            /* table-layout: fixed; */
        }

        .identitas-table td {
            border: none;
            text-align: left;
            padding: 0px 3px;
            font-size: 8px;
            font-weight: bold;
            vertical-align: top;
            white-space: nowrap;
        }

        .text-keterangan {
            font-size: 6px;
            text-align: left;
            padding: 2px;
            font-weight: normal;
        }

        /* TINGGI HEADER VERTIKAL DIPENDEKKAN AGAR TIDAK KOSONG */
        .th-vertikal {
            height: 180px;
            text-align: center;
            vertical-align: bottom;
            padding-bottom: 2px;
        }
        
        .text-miring {
            display: block;
            transform: rotate(-90deg);
            white-space: nowrap;
            width: 10px;
            margin: 0 auto;
        }
        
        .baris-nomor th {
            background-color: #eeeeee !important;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header-title">
        KARTU BANTU PEMERIKSAAN BAYI, BALITA, DAN ANAK PRA-SEKOLAH
    </div>

    <!-- TABEL IDENTITAS -->
    <table class="identitas-table">
        <colgroup>
            <col style="width:11%">
            <col style="width:1%">
            <col style="width:38%">
            <col style="width:11%">
            <col style="width:1%">
            <col style="width:38%">
        </colgroup>
        <tr>
            <td>Nama Balita</td>
            <td>:</td>
            <td>{{ $pemeriksaan->child->full_name ?? '-' }}</td>
            <td>Kecamatan</td>
            <td>:</td>
            <td>Tedunan</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $pemeriksaan->child->national_id ?? '-' }}</td>
            <td>Desa</td>
            <td>:</td>
            <td>Tedunan</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $displayGender }}</td>
            <td>Dusun</td>
            <td>:</td>
            <td>{{ $pemeriksaan->child->dusun ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{ isset($pemeriksaan->child->birth_date) ? \Carbon\Carbon::parse($pemeriksaan->child->birth_date)->translatedFormat('d F Y') : '-' }}</td>
            <td>Posyandu</td>
            <td>:</td>
            <td>{{ $pemeriksaan->activity->location ?? '-' }}</td>
        </tr>
        <tr>
            <td>Berat Badan Lahir</td>
            <td>:</td>
            <td>{{ isset($pemeriksaan->child->birth_weight) ? number_format($pemeriksaan->child->birth_weight, 2) . ' kg' : '-' }}</td>
            <td>Keterangan</td>
            <td>:</td>
            <td>{{ $pemeriksaan->child->notes ?? '-' }}</td>
        </tr>
        <tr>
            <td>Panjang Badan Lahir</td>
            <td>:</td>
            <td>{{ isset($pemeriksaan->child->birth_length) ? number_format($pemeriksaan->child->birth_length, 2) . ' cm' : '-' }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Nama Ibu</td>
            <td>:</td>
            <td>{{ $pemeriksaan->child->mother_name ?? $pemeriksaan->child->parent_name ?? '-' }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Nama Ayah</td>
            <td>:</td>
            <td>{{ $pemeriksaan->child->father_name ?? '-' }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>
                {{ $pemeriksaan->child->address ?? '-' }} 
                {{ isset($pemeriksaan->child->rt) ? 'RT ' . $pemeriksaan->child->rt : '' }}
                {{ isset($pemeriksaan->child->rw) ? '/ RW ' . $pemeriksaan->child->rw : '' }}
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>:</td>
            <td>{{ $pemeriksaan->child->phone ?? '-' }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

    @php
        $riwayat = \App\Models\Examination::with('activity')
            ->where('child_id', $pemeriksaan->child_id)
            ->join('activities', 'examinations.activity_id', '=', 'activities.id')
            ->orderBy('activities.activity_date', 'asc')
            ->select('examinations.*')
            ->get();

        $totalBaris = 12;
    @endphp

    <!-- TABEL UTAMA PEMERIKSAAN -->
    <table class="kartu">
        <colgroup>
            <col style="width:2.5%">
            <col style="width:5.5%">
            <col style="width:3%">
            <col style="width:3.5%">
            <col style="width:4.5%">
            <col style="width:3%">
            <col style="width:4.5%">
            <col style="width:4.5%">
            <col style="width:3%">
            <col style="width:3.5%">
            <col style="width:3%">
            <col style="width:4%">
            <col style="width:3.5%">
            <col style="width:3.5%">
            <col style="width:3.5%">
            <col style="width:3.5%">
            <col style="width:3%">
            <col style="width:4.5%">
            <col style="width:4.5%">
            <col style="width:3%">
            <col style="width:3%">
            <col style="width:4%">
            <col style="width:4%">
            <col style="width:5%">
            <col style="width:6%">
            <col style="width:5%">
        </colgroup>
        <thead>
            <tr>
                <th rowspan="3">Umur<br>(Bulan)</th>
                <th rowspan="3">Tanggal<br>Kunjungan</th>
                <th colspan="10" class="text-keterangan">
                    <b>Hasil Penimbangan/Pengukuran</b><br>
                    (Jika ditemukan anak dengan hasil Penimbangan BB tidak Naik/BGM/Atas Garis Oranye/Gizi Kurang/Gizi Buruk/Berisiko Gizi Lebih/Gizi Lebih/Obesitas atau hasil pengkuran PB/TB/Umur sangat pendek/pendek, atau hasil pengukuran lingkar kepala makrosefali/mikrosefal, atau hasil pengukuran LILA wama merah maka sasaran rujuk ke Pustu/Puskesmas)
                </th>
                <th colspan="11" class="text-keterangan">
                    <b>Hasil Pemeriksaan/Pemantauan</b><br>
                    (jika 2 gejalaTBC terpenuhi atau Checklist Perkembangan Tidak Lengkap maka dirujuk ke Pustu/Puskesmas)
                </th>
                <th rowspan="3" class="th-vertikal"><span class="text-miring">Edukasi yang diberikan</span></th>
                <th rowspan="3" class="th-vertikal"><span class="text-miring">Apakah ada gejala sakit?<br>Jika Ya, sebutkan</span></th>
                <th rowspan="3" class="th-vertikal"><span class="text-miring">Rujuk Pustu / Puskesmas / Rumah Sakit</span></th>
            </tr>
            <tr>
                <th colspan="3">Berat Badan</th>
                <th colspan="2">Tinggi Badan</th>
                <th rowspan="2" class="th-vertikal"><span class="text-miring">Gizi Buruk / Gizi Kurang /<br>Gizi Baik / Risiko Gizi Lebih /<br>Gizi Lebih / Obesitas</span></th>
                <th colspan="2">Lingkar Kepala</th>
                <th colspan="2">Lingkar Lengan Atas (cm)</th>
                <th colspan="4">Skrining TBC</th>
                <th colspan="7">Bayi / Balita Mendapatkan</th>
            </tr>
            <tr>
                <th class="th-vertikal"><span class="text-miring">BB (kg)</span></th>
                <th class="th-vertikal"><span class="text-miring">Berat Badan Naik (N) / Tidak Naik (T)</span></th>
                <th class="th-vertikal"><span class="text-miring">BB Sangat Kurang / BB Kurang /<br>BB Normal / Risiko BB Lebih</span></th>
                
                <th class="th-vertikal"><span class="text-miring">Panjang / Tinggi Badan (cm)</span></th>
                <th class="th-vertikal"><span class="text-miring">Sangat Pendek / Pendek /<br>Normal / Tinggi</span></th>

                <th class="th-vertikal"><span class="text-miring">Lingkar Kepala (cm)</span></th>
                <th class="th-vertikal"><span class="text-miring">Sangat Kecil / Kecil /<br>Normal / Makrosefali</span></th>
                
                <th class="th-vertikal"><span class="text-miring">Lingkar Lengan Atas (cm)</span></th>
                <th class="th-vertikal"><span class="text-miring">Sangat Kurus / Kurus /<br>Normal / Gizi Lebih</span></th>

                <th class="th-vertikal"><span class="text-miring">Batuk terus menerus Ya / Tidak</span></th>
                <th class="th-vertikal"><span class="text-miring">Demam &ge;2 minggu Ya / Tidak</span></th>
                <th class="th-vertikal"><span class="text-miring">BB tidak naik dalam 2 bulan<br>berturut-turut Ya / Tidak</span></th>
                <th class="th-vertikal"><span class="text-miring">Kontak Erat Dengan Pasien TB Ya/Tidak</span></th>

                <th class="th-vertikal"><span class="text-miring">ASI Eks. Ya / Tidak</span></th>
                <th class="th-vertikal"><span class="text-miring">Komposisi dan jenis MP ASI<br>sesuai? Ya / Tidak</span></th>
                <th class="th-vertikal"><span class="text-miring">Sebut jenis imunisasi yang diberikan</span></th>
                <th class="th-vertikal"><span class="text-miring">Vit. A Ya / Tidak</span></th>
                <th class="th-vertikal"><span class="text-miring">Obat Cacing Ya / Tidak</span></th>
                <th class="th-vertikal"><span class="text-miring">Mendapatkan MT pangan<br>lokal untuk pemulihan? Ya / Tidak</span></th>
                <th class="th-vertikal"><span class="text-miring">Jika nakes memberikan, sebutkan porsi</span></th>
            </tr>
            <tr class="baris-nomor">
                @for ($n = 1; $n <= 26; $n++)
                    <th>{{ $n }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < $totalBaris; $i++)
                @if(isset($riwayat[$i]))
                    @php
                        $data = $riwayat[$i];
                        $tglLahir = \Carbon\Carbon::parse($data->child->birth_date)->startOfDay();
                        $tglPeriksa = \Carbon\Carbon::parse($data->activity->activity_date)->startOfDay();

                        $umurBulan = $tglPeriksa->lessThan($tglLahir) ? 0 : max(1, (int) ceil($tglLahir->floatDiffInMonths($tglPeriksa)));

                        $status_naik = '-';
                        if ($i == 0) {
                            $prev_weight = $pemeriksaan->child->birth_weight;
                            if ($prev_weight && $data->weight) {
                                $status_naik = ($data->weight > $prev_weight) ? 'N' : 'T';
                            }
                        } else {
                            if (isset($riwayat[$i-1])) {
                                $prev_weight = $riwayat[$i-1]->weight;
                                if ($prev_weight && $data->weight) {
                                    $status_naik = ($data->weight > $prev_weight) ? 'N' : 'T';
                                }
                            }
                        }

                        // Menggabungkan Edukasi (Checkbox) dengan Catatan (Notes)
                        $edukasi_teks = '-';
                        if ($data->health_education && $data->notes) {
                            $edukasi_teks = "Ya (" . $data->notes . ")";
                        } elseif ($data->health_education) {
                            $edukasi_teks = "Ya";
                        } elseif ($data->notes) {
                            $edukasi_teks = $data->notes;
                        }

                    @endphp
                    <tr>
                        <td>{{ $umurBulan }}</td>
                        <td>{{ $tglPeriksa->translatedFormat('d/m/Y') }}</td>
                        <td>{{ $data->weight ?? '-' }}</td>
                        <td>{{ $status_naik }}</td>
                        <td>{{ $data->weight_for_age ?? '-' }}</td>
                        <td>{{ $data->height ?? '-' }}</td>
                        <td>{{ $data->height_for_age ?? '-' }}</td>
                        <td>{{ $data->weight_for_height ?? '-' }}</td>
                        <td>{{ $data->head_circumference ?? '-' }}</td>
                        <td>{{ $data->head_circumference_status ?? '-' }}</td>
                        <td>{{ $data->upper_arm_circumference ?? '-' }}</td>
                        <td>{{ $data->upper_arm_status ?? '-' }}</td>
                        <td>{{ $data->cough_two_weeks ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $data->fever_two_weeks ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $data->weight_not_increasing ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $data->tb_contact ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $data->exclusive_breastfeeding ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $data->complementary_feeding ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $data->immunization ?? '-' }}</td>
                        <td>{{ $data->vitamin_a ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $data->deworming ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $data->local_food_program ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $data->pmt_portion ?? '-' }}</td>
                        
                        <!-- Kolom Edukasi yang sudah digabung dengan Catatan -->
                        <td>{{ $edukasi_teks }}</td>
                        
                        <td>{{ $data->illness_symptoms ?? '-' }}</td>
                        <td>{{ $data->referral ?? '-' }}</td>
                    </tr>
                @else
                    <tr>
                        @for ($col = 1; $col <= 26; $col++)
                            <td>&nbsp;</td>
                        @endfor
                    </tr>
                @endif
            @endfor
        </tbody>
    </table>

</body>
</html>