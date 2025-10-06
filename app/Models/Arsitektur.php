<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsitektur extends Model
{
    protected $table = 'arsitektur';

    protected $fillable = [
        'instansi',
        'as_is_proses_bisnis',
        'as_is_layanan',
        'as_is_data_informasi',
        'as_is_aplikasi',
        'as_is_infrastruktur',
        'as_is_keamanan',
        'to_be_proses_bisnis',
        'to_be_layanan',
        'to_be_data_informasi',
        'to_be_aplikasi',
        'to_be_infrastruktur',
        'to_be_keamanan',
        'peta_rencana',
        'clearance',
        'reviu_evaluasi',
        'tingkat_kematangan'
    ];

    protected $casts = [
        'tingkat_kematangan' => 'float'
    ];
}
