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
        Schema::create('related_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('organization_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('kepaniitiaan_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('magang_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('tridharma_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('lomba_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('fakultas_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('prodi_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('ukm_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_records');
    }
};
