<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TulisanSeeder::class,
            PresentasiSeeder::class,
            PenguasaanSeeder::class,
            KualitasSeeder::class,
            PersyaratanSeeder::class,
            AboutSeeder::class,
            SettingSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            GiveAdminPermissionSeeder::class,
            KeilmuanSeeder::class,
            JabatanSeeder::class,
            JurusanSeeder::class,
            SumberSeeder::class,
            BerandaSeeder::class,
            TentangSeeder::class,
            LayananSeeder::class,
            ListLayananSeeder::class,
            PaketSeeder::class,
            KlienSeeder::class,
            EkosistemSeeder::class,
            BidangKeahlianSeeder::class,
            UserSeeder::class,
            MitraPenggunaSeeder::class,
        ]);
    }
}
