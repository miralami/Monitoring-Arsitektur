<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsitekturTable extends Migration
{
    public function up()
    {
        Schema::create('arsitektur', function (Blueprint $table) {
            $table->id();
            $table->string('instansi');

            // As-Is Architecture
            $table->integer('as_is_proses_bisnis')->default(0);
            $table->integer('as_is_layanan')->default(0);
            $table->integer('as_is_data_informasi')->default(0);
            $table->integer('as_is_aplikasi')->default(0);
            $table->integer('as_is_infrastruktur')->default(0);
            $table->integer('as_is_keamanan')->default(0);

            // To-Be Architecture
            $table->integer('to_be_proses_bisnis')->default(0);
            $table->integer('to_be_layanan')->default(0);
            $table->integer('to_be_data_informasi')->default(0);
            $table->integer('to_be_aplikasi')->default(0);
            $table->integer('to_be_infrastruktur')->default(0);
            $table->integer('to_be_keamanan')->default(0);

            // Additional Fields
            $table->integer('peta_rencana')->default(0);
            $table->enum('clearance', ['Pending', 'In Review', 'Approved', 'Rejected'])->default('Pending');
            $table->enum('reviu_evaluasi', ['Not Started', 'In Progress', 'Completed'])->default('Not Started');
            $table->decimal('tingkat_kematangan', 3, 1)->default(0.0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('arsitektur');
    }
}
