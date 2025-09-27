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
        Schema::table('related_records', function (Blueprint $table) {
            $table->string('bukti_file')->nullable()->after('ukm_id');
            $table->boolean('is_verified')->default(false)->after('bukti_file');
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null')->after('is_verified');
            $table->timestamp('verified_at')->nullable()->after('verified_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('related_records', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropColumn(['bukti_file', 'is_verified', 'verified_by', 'verified_at']);
        });
    }
};
