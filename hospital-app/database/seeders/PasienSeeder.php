<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pasiens = [
            [
                'nama_pasien' => 'Ahmad Suryadi',
                'alamat' => 'Jl. Merdeka No. 45, Jakarta Pusat',
                'no_telpon' => '081234567890',
                'rumah_sakit_id' => 1
            ],
            [
                'nama_pasien' => 'Siti Nurhaliza',
                'alamat' => 'Jl. Sudirman No. 78, Jakarta Selatan',
                'no_telpon' => '082345678901',
                'rumah_sakit_id' => 2
            ],
            [
                'nama_pasien' => 'Budi Santoso',
                'alamat' => 'Jl. Gatot Subroto No. 12, Jakarta Selatan',
                'no_telpon' => '083456789012',
                'rumah_sakit_id' => 1
            ],
            [
                'nama_pasien' => 'Dewi Kartika',
                'alamat' => 'Jl. Thamrin No. 99, Jakarta Pusat',
                'no_telpon' => '084567890123',
                'rumah_sakit_id' => 3
            ],
            [
                'nama_pasien' => 'Eko Prasetyo',
                'alamat' => 'Jl. Casablanca No. 88, Jakarta Selatan',
                'no_telpon' => '085678901234',
                'rumah_sakit_id' => 2
            ],
            [
                'nama_pasien' => 'Fitri Handayani',
                'alamat' => 'Jl. Kemayoran No. 33, Jakarta Pusat',
                'no_telpon' => '086789012345',
                'rumah_sakit_id' => 4
            ],
            [
                'nama_pasien' => 'Gunawan Wijaya',
                'alamat' => 'Jl. Fatmawati No. 55, Jakarta Selatan',
                'no_telpon' => '087890123456',
                'rumah_sakit_id' => 5
            ],
            [
                'nama_pasien' => 'Henny Kusuma',
                'alamat' => 'Jl. Jatinegara No. 77, Jakarta Timur',
                'no_telpon' => '088901234567',
                'rumah_sakit_id' => 3
            ],
            [
                'nama_pasien' => 'Ivan Setiawan',
                'alamat' => 'Jl. Pancoran No. 22, Jakarta Selatan',
                'no_telpon' => '089012345678',
                'rumah_sakit_id' => 1
            ],
            [
                'nama_pasien' => 'Julia Permata',
                'alamat' => 'Jl. Kelapa Gading No. 44, Jakarta Utara',
                'no_telpon' => '090123456789',
                'rumah_sakit_id' => 4
            ]
        ];

        foreach ($pasiens as $pasien) {
            Pasien::create($pasien);
        }
    }
}
