<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instansi;

class InstansiSeeder extends Seeder
{
    public function run(): void
    {
        Instansi::truncate();

        // Kementerian
        $kementerian = [
            'Kementerian Dalam Negeri',
            'Kementerian Luar Negeri',
            'Kementerian Pertahanan',
            'Kementerian Agama',
            'Kementerian Hukum',
            'Kementerian Hak Asasi Manusia',
            'Kementerian Imigrasi dan Pemasyarakatan',
            'Kementerian Keuangan',
            'Kementerian Pendidikan Dasar dan Menengah',
            'Kementerian Pendidikan Tinggi, Sains, dan Teknologi',
            'Kementerian Kebudayaan'
        ];

        foreach ($kementerian as $k) {
            Instansi::create([
                'kategori' => 'Kementerian',
                'instansi' => $k,
                'proses_bisnis_as_is' => rand(3, 8),      // Random 3-8 proses
                'layanan_as_is' => rand(4, 10),           // Random 4-10 layanan
                'data_info_as_is' => rand(5, 15),         // Random 5-15 data
                'aplikasi_as_is' => rand(2, 7),           // Random 2-7 aplikasi
                'infra_as_is' => rand(1, 5),              // Random 1-5 infrastruktur
                'keamanan_as_is' => rand(1, 4),           // Random 1-4 keamanan
                'proses_bisnis_to_be' => rand(1, 4),      // Random 1-4 proses to-be
                'layanan_to_be' => rand(1, 3),            // Random 1-3 layanan to-be
                'data_info_to_be' => rand(2, 5),          // Random 2-5 data to-be
                'aplikasi_to_be' => rand(1, 3),           // Random 1-3 aplikasi to-be
                'infra_to_be' => rand(0, 2),              // Random 0-2 infrastruktur to-be
                'keamanan_to_be' => rand(0, 2),           // Random 0-2 keamanan to-be
                'peta_rencana' => false,       // Random boolean
                'clearance' => false,          // Random boolean
                'reviueval' => false,          // Random boolean
                'tingkat_kematangan' => false, // Random boolean
            ]);
        }

        // LPNK
        Instansi::create([
            'kategori' => 'LPNK',
            'instansi' => 'LPNK A',
            'proses_bisnis_as_is' => 5,
            'layanan_as_is' => 7,
            'data_info_as_is' => 10,
            'aplikasi_as_is' => 2,
            'infra_as_is' => 1,
            'keamanan_as_is' => 1,
            'proses_bisnis_to_be' => 2,
            'layanan_to_be' => 1,
            'data_info_to_be' => 3,
            'aplikasi_to_be' => 1,
            'infra_to_be' => 1,
            'keamanan_to_be' => 0,
            'clearance' => false,
            'reviueval' => true,
            'tingkat_kematangan' => false,
        ]);
        Instansi::create([
            'kategori' => 'LPNK',
            'instansi' => 'LPNK B',
            'proses_bisnis_as_is' => 8,
            'layanan_as_is' => 6,
            'data_info_as_is' => 12,
            'aplikasi_as_is' => 4,
            'infra_as_is' => 3,
            'keamanan_as_is' => 2,
            'proses_bisnis_to_be' => 4,
            'layanan_to_be' => 3,
            'data_info_to_be' => 5,
            'aplikasi_to_be' => 2,
            'infra_to_be' => 2,
            'keamanan_to_be' => 1,
            'clearance' => false,
            'reviueval' => true,
            'tingkat_kematangan' => false,
        ]);

        // LNS
        Instansi::create([
            'kategori' => 'LNS',
            'instansi' => 'LNS A',
            'proses_bisnis_as_is' => 6,
            'layanan_as_is' => 4,
            'data_info_as_is' => 9,
            'aplikasi_as_is' => 3,
            'infra_as_is' => 2,
            'keamanan_as_is' => 1,
            'proses_bisnis_to_be' => 2,
            'layanan_to_be' => 2,
            'data_info_to_be' => 3,
            'aplikasi_to_be' => 1,
            'infra_to_be' => 1,
            'keamanan_to_be' => 1,
            'peta_rencana' => false,
            'clearance' => false,
            'reviueval' => false,
            'tingkat_kematangan' => false,
        ]);
        Instansi::create([
            'kategori' => 'LNS',
            'instansi' => 'LNS B',
            'proses_bisnis_as_is' => 4,
            'layanan_as_is' => 2,
            'data_info_as_is' => 7,
            'aplikasi_as_is' => 2,
            'infra_as_is' => 1,
            'keamanan_as_is' => 0,
            'proses_bisnis_to_be' => 1,
            'layanan_to_be' => 1,
            'data_info_to_be' => 2,
            'aplikasi_to_be' => 1,
            'infra_to_be' => 0,
            'keamanan_to_be' => 0,
            'clearance' => false,
            'reviueval' => true,
            'tingkat_kematangan' => false,
        ]);

        // Instansi Lain
        Instansi::create([
            'kategori' => 'Instansi Lain',
            'instansi' => 'Instansi Lain A',
            'proses_bisnis_as_is' => 3,
            'layanan_as_is' => 2,
            'data_info_as_is' => 5,
            'aplikasi_as_is' => 1,
            'infra_as_is' => 1,
            'keamanan_as_is' => 1,
            'proses_bisnis_to_be' => 2,
            'layanan_to_be' => 1,
            'data_info_to_be' => 2,
            'aplikasi_to_be' => 1,
            'infra_to_be' => 1,
            'keamanan_to_be' => 1,
            'peta_rencana' => false,
            'clearance' => false,
            'reviueval' => false,
            'tingkat_kematangan' => false,
        ]);
        Instansi::create([
            'kategori' => 'Instansi Lain',
            'instansi' => 'Instansi Lain B',
            'proses_bisnis_as_is' => 7,
            'layanan_as_is' => 5,
            'data_info_as_is' => 11,
            'aplikasi_as_is' => 3,
            'infra_as_is' => 2,
            'keamanan_as_is' => 2,
            'proses_bisnis_to_be' => 3,
            'layanan_to_be' => 2,
            'data_info_to_be' => 4,
            'aplikasi_to_be' => 1,
            'infra_to_be' => 1,
            'keamanan_to_be' => 1,
            'clearance' => false,
            'reviueval' => true,
            'tingkat_kematangan' => false,
        ]);

        // Provinsi
        Instansi::create([
            'kategori' => 'Provinsi',
            'instansi' => 'Provinsi A',
            'proses_bisnis_as_is' => 9,
            'layanan_as_is' => 8,
            'data_info_as_is' => 15,
            'aplikasi_as_is' => 4,
            'infra_as_is' => 3,
            'keamanan_as_is' => 2,
            'proses_bisnis_to_be' => 4,
            'layanan_to_be' => 2,
            'data_info_to_be' => 5,
            'aplikasi_to_be' => 2,
            'infra_to_be' => 1,
            'keamanan_to_be' => 1,
            'clearance' => false,
            'reviueval' => true,
            'tingkat_kematangan' => false,
        ]);
        Instansi::create([
            'kategori' => 'Provinsi',
            'instansi' => 'Provinsi B',
            'proses_bisnis_as_is' => 2,
            'layanan_as_is' => 3,
            'data_info_as_is' => 6,
            'aplikasi_as_is' => 2,
            'infra_as_is' => 1,
            'keamanan_as_is' => 1,
            'proses_bisnis_to_be' => 1,
            'layanan_to_be' => 1,
            'data_info_to_be' => 2,
            'aplikasi_to_be' => 1,
            'infra_to_be' => 1,
            'keamanan_to_be' => 0,
            'peta_rencana' => false,
            'clearance' => false,
            'reviueval' => false,
            'tingkat_kematangan' => false,
        ]);

        // Kab/Kota
        Instansi::create([
            'kategori' => 'Kab/Kota',
            'instansi' => 'Kabupaten/Kota A',
            'proses_bisnis_as_is' => 6,
            'layanan_as_is' => 4,
            'data_info_as_is' => 8,
            'aplikasi_as_is' => 2,
            'infra_as_is' => 1,
            'keamanan_as_is' => 1,
            'proses_bisnis_to_be' => 1,
            'layanan_to_be' => 1,
            'data_info_to_be' => 2,
            'aplikasi_to_be' => 1,
            'infra_to_be' => 1,
            'keamanan_to_be' => 0,
            'peta_rencana' => false,
            'clearance' => false,
            'reviueval' => false,
            'tingkat_kematangan' => false,
        ]);
        Instansi::create([
            'kategori' => 'Kab/Kota',
            'instansi' => 'Kabupaten/Kota B',
            'proses_bisnis_as_is' => 4,
            'layanan_as_is' => 2,
            'data_info_as_is' => 10,
            'aplikasi_as_is' => 7,
            'infra_as_is' => 2,
            'keamanan_as_is' => 1,
            'proses_bisnis_to_be' => 3,
            'layanan_to_be' => 1,
            'data_info_to_be' => 2,
            'aplikasi_to_be' => 1,
            'infra_to_be' => 1,
            'keamanan_to_be' => 0,
            'peta_rencana' => true,
            'clearance' => false,
            'reviueval' => false,
            'tingkat_kematangan' => false,
        ]);
    }
}
