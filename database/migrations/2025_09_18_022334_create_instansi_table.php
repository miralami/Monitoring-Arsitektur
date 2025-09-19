<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_instansi_table.php
    public function up()
    {
        Schema::create('instansi', function (Blueprint $table) {
            $table->id();
            $table->string('kategori'); // contoh: Kementerian, LPNK, dll
            $table->string('instansi');
            $table->integer('proses_bisnis_as_is')->default(0);
            $table->integer('layanan_as_is')->default(0);
            $table->integer('data_info_as_is')->default(0);
            $table->integer('aplikasi_as_is')->default(0);
            $table->integer('infra_as_is')->default(0);
            $table->integer('keamanan_as_is')->default(0);

            $table->integer('proses_bisnis_to_be')->default(0);
            $table->integer('layanan_to_be')->default(0);
            $table->integer('data_info_to_be')->default(0);
            $table->integer('aplikasi_to_be')->default(0);
            $table->integer('infra_to_be')->default(0);
            $table->integer('keamanan_to_be')->default(0);

            $table->boolean('peta_rencana')->default(false);
            $table->boolean('clearance')->default(false);
            $table->boolean('reviueval')->default(false);
            $table->boolean('tingkat_kematangan')->default(false);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instansi');
    }
};
