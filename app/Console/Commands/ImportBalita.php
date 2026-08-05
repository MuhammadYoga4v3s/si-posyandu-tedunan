<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Child;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImportBalita extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'import:balita';

    /**
     * The console command description.
     */
    protected $description = 'Import data balita dari file CSV ke database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = storage_path('app/BalitaData.csv');

        if (!file_exists($filePath)) {
            $this->error("File BalitaData.csv tidak ditemukan di storage/app/!");
            return;
        }

        $this->info("Memulai proses import data balita...");

        // Membuka file CSV
        $file = fopen($filePath, 'r');
        
        // Membaca baris pertama (header kolom)
        $header = fgetcsv($file, 1000, ',');

        $count = 0;
        $errors = 0;

        DB::beginTransaction();

        try {
            // Membaca data baris demi baris
            while (($row = fgetcsv($file, 1000, ',')) !== false) {
                // Menggabungkan header sebagai key dan row sebagai value
                $data = array_combine($header, $row);

                // Skip jika NIK kosong (data tidak valid)
                if (empty($data['nik'])) {
                    continue;
                }

                // Normalisasi Gender (Database minta 'Male'/'Female')
                $gender = strtolower(trim($data['sex'])) == 'laki-laki' ? 'Male' : 'Female';
                
                // Normalisasi NIK dan No KK (Mencegah format scientific e+15)
                $nik = preg_replace('/[^0-9]/', '', $data['nik']);
                $no_kk = preg_replace('/[^0-9]/', '', $data['no_kk']);

                // Insert atau Update jika NIK sudah ada (mencegah duplikat)
                Child::updateOrCreate(
                    ['national_id' => $nik], // Kondisi pencarian
                    [
                        'full_name' => $data['nama'],
                        'address' => $data['alamat'] ?? 'Tedunan',
                        'rt' => $data['rt'] ?? null,
                        'rw' => $data['rw'] ?? null,
                        'family_card_number' => $no_kk,
                        'gender' => $gender,
                        'birth_place' => $data['tempatlahir'],
                        'birth_date' => $data['tanggallahir'],
                        'religion' => $data['agama_id'],
                        'education' => $data['pendidikan_kk_id'],
                        'occupation' => $data['pekerjaan_id'],
                        'marital_status' => $data['status_kawin'],
                        'family_relationship' => $data['kk_level'],
                        'father_name' => $data['nama_ayah'],
                        'mother_name' => $data['nama_ibu'],
                        'is_resident' => true // Default warga menetap
                    ]
                );
                
                $count++;
                
                // Tampilkan progress setiap 50 baris
                if ($count % 50 == 0) {
                    $this->info("Berhasil memproses {$count} data...");
                }
            }

            DB::commit();
            fclose($file);

            $this->info("✅ Sukses! Total {$count} data balita berhasil di-import ke database.");

        } catch (\Exception $e) {
            DB::rollBack();
            fclose($file);
            $this->error("❌ Terjadi kesalahan saat proses baris ke-" . ($count + 1) . ": " . $e->getMessage());
        }
    }
}