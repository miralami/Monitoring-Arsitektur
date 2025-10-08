<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Daerah;

class DaerahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daerah = [
            'Pusat',
            'Aceh',
            'Sumatera Utara',
            'Riau',
            'Sumatera Barat',
            'Jambi',
            'Sumatera Selatan',
            'Bengkulu',
            'Lampung',
            'Kepulauan Riau',
            'Kepulauan Bangka Belitung',
            'Banten',
            'Jakarta',
            'Jawa Barat',
            'Jawa Tengah',
            'Jawa Timur',
            'Yogyakarta',
            'Kalimantan Barat',
            'Kalimantan Tengah',
            'Kalimantan Timur',
            'Kalimantan Selatan',
            'Kalimantan Utara',
            'Bali',
            'Nusa Tenggara Barat',
            'Nusa Tenggara Timur',
            'Sulawesi Utara',
            'Gorontalo',
            'Sulawesi Barat',
            'Sulawesi Tengah',
            'Sulawesi Selatan',
            'Sulawesi Tenggara',
            'Maluku',
            'Papua Barat',
            'Papua',
            'Kepolisian Daerah',
            'Maluku Utara',
            'Papua Selatan',
            'Papua Tengah',
            'Papua Pegunungan',
            'Papua Barat Daya',
        ];

        foreach ($daerah as $item) {
            Daerah::create([
                'desc' => $item,
            ]);
        }
    }
}