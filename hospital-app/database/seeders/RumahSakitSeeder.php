<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RumahSakit::create([
            'nama_rumah_sakit' => 'RS Umum Pusat Jakarta',
            'alamat' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            'email' => 'info@rsjakarta.co.id',
            'telepon' => '021-1234567'
        ]);

        RumahSakit::create([
            'nama_rumah_sakit' => 'RS Siloam Hospitals',
            'alamat' => 'Jl. TB Simatupang No. 6, Jakarta Selatan',
            'email' => 'contact@siloam.co.id',
            'telepon' => '021-7654321'
        ]);

        RumahSakit::create([
            'nama_rumah_sakit' => 'RS Premier Jatinegara',
            'alamat' => 'Jl. Raya Jatinegara No. 85, Jakarta Timur',
            'email' => 'info@premier-jatinegara.co.id',
            'telepon' => '021-8901234'
        ]);

        RumahSakit::create([
            'nama_rumah_sakit' => 'RS Hermina Kemayoran',
            'alamat' => 'Jl. Kemayoran Barat No. 11, Jakarta Pusat',
            'email' => 'hermina@kemayoran.co.id',
            'telepon' => '021-5678901'
        ]);

        RumahSakit::create([
            'nama_rumah_sakit' => 'RS Fatmawati',
            'alamat' => 'Jl. RS Fatmawati No. 80, Jakarta Selatan',
            'email' => 'admin@rsfatmawati.co.id',
            'telepon' => '021-2345678'
        ]);
    }
}
