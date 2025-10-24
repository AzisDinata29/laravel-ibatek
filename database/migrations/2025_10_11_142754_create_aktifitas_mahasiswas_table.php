<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aktifitas_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tipe_aktifitas_mahasiswa_id');
            $table->text('label');
            $table->text('label_detail');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('semester');
            $table->string('durasi')->nullable();
            $table->string('file')->nullable();
            $table->string('dosen_pembimbing')->nullable();
            $table->string('mitra')->nullable();
            $table->string('keterangan')->nullable();
            $table->enum('status', ['Terima', 'Tidak Diterima', 'Menunggu Validasi'])->default("Menunggu Validasi");
            $table->unsignedBigInteger('validasi_user_id')->nullable();
            $table->string('keterangan_validasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktifitas_mahasiswas');
    }
};
