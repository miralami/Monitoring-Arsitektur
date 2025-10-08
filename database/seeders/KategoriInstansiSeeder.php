<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriInstansi;

class KategoriInstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            'Kementerian',
            'Lembaga Pemerintah Non Kementerian',
            'Lembaga Non Struktural',
            'Instansi Lainnya',
            'Pemerintah Provinsi',
            'Pemerintah Kabupaten',
            'Pemerintah Kota',
            'Kepolisian Daerah',
        ];

        foreach ($kategori as $item) {
            KategoriInstansi::create([
                'name' => $item,
            ]);
        }
    }
}