<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PTSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lokasi file JSON
        $filePaths = [
            'pts' => public_path('json/univ.json'),
        ];

        // Validasi keberadaan file JSON
        foreach ($filePaths as $key => $filePath) {
            if (!File::exists($filePath)) {
                $message = "File JSON {$key} tidak ditemukan di path {$filePath}";
                Log::error($message);
                echo "Error: {$message}\n";
                return; // Hentikan jika file tidak ditemukan
            }
        }

        // Mulai proses seeder
        try {
            DB::beginTransaction(); // Mulai transaksi database

            // Seeder data Perguruan Tinggi
            $this->seedData('perguruan_tinggis', $filePaths['pts'], 'Perguruan Tinggi');

            DB::commit(); // Commit transaksi
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika ada error
            Log::error("Seeder gagal dijalankan: " . $e->getMessage());
            echo "Error: Seeder gagal dijalankan. " . $e->getMessage() . "\n";
        }
    }

    /**
     * Seeder data tanpa chunking.
     */
    private function seedData(string $tableName, string $filePath, string $logPrefix): void
    {
        echo "Memulai proses seeder data {$logPrefix}...\n";

        $data = json_decode(File::get($filePath), true);

        if ($data && is_array($data)) {
            DB::table($tableName)->insert($data);
            echo "Done seeder data {$logPrefix}.\n";
        } else {
            $message = "Data {$logPrefix} tidak valid atau kosong.";
            Log::error($message);
            echo "Error: {$message}\n";
        }
    }
}
