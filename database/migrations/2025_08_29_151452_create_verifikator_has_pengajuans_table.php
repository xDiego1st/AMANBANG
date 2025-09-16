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
        Schema::create('verifikator_has_pengajuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->nullOnDelete();

            $table->unsignedBigInteger('pengajuan_id')->nullable();
            $table->foreign('pengajuan_id')->references('id')->on('detail_pemohons')->onUpdate('cascade')->nullOnDelete();

            // Status Verifikatr = Syncron dengan History Upload Dokumen Yang Terbaru
            $table->tinyInteger('status_verifikator')->default('0')->comment('0 = On-Waiting | 1 - On-Checking | 2 = Need-Correction | 3 = Complete  | 4 = TTD Diberikan | 5 = Canceled');
            $table->tinyInteger('target_hari')->default('1')->comment('Berapa Hari SOP untuk TPA/TPT Memberikan Laporan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikator_has_pengajuans');
    }
};
