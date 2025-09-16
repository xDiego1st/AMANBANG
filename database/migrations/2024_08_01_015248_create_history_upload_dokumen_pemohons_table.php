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
        Schema::create('history_upload', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('pengajuan_id');
            $table->foreign('pengajuan_id')->references('id')->on('detail_pemohons')->cascadeOnUpdate()->cascadeOnDelete();
            $table->tinyInteger('status')->default('0')->comment('0 = On-Waiting | 1 - On-Checking | 2 = Need-Correction | 3 = Complete | 4 = Canceled');
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('verified_by_user_id')->nullable();
            $table->foreign('verified_by_user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->datetime('verified_at')->nullable();
            $table->unsignedBigInteger('dokumen_type_id');
            $table->foreign('dokumen_type_id')->references('id')->on('dokumen_pemohons')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->index(['pengajuan_id', 'dokumen_type_id', 'id']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_upload');
    }
};
