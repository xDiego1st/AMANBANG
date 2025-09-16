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
        Schema::create('detail_ket_history_dok', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_keterangan');
            $table->foreign('jenis_keterangan')->references('id')->on('jenis_keterangan_pemohons')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('dokumen_upload_id');
            $table->foreign('dokumen_upload_id')->references('id')->on('history_upload')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('catatan')->nullable();
            $table->boolean('kesesuaian');
            $table->unsignedBigInteger('checked_by_user_id')->nullable();
            $table->foreign('checked_by_user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keterangan_detail_upload_pemohons');
    }
};
