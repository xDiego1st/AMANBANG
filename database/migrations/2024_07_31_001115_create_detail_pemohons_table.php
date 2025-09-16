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
        Schema::create('detail_pemohons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascade();
            $table->string('nomor_registrasi_simbg')->nullable();
            $table->string('nama'); // KRK
            $table->string('no_wa');
            $table->enum('jenis_pengajuan', ['PBG', 'SLF'])->nullable();
            // $table->string('jenis_permohonan')->nullable()->comment('Bangunan Gedung Baru | Bangunan Gedung Perubahan | Bangunan Gedung Kolektif | Bangunan Gedung Prasarana | Bangunan Gedung Cagar Budaya | SPBU Mikro 3 Kilo Liter | Bangunan Bertahap');
            $table->enum('team_penilai_ba', ['TPA', 'TPT'])->default('TPA');
            //Data Pendukung
            //$table->string('nik')->nullable();
            $table->string('alamat')->nullable(); // KRK
            $table->string('pekerjaan')->nullable();
            $table->string('bertindak_atas_nama')->nullable(); // KRK
            $table->string('jabatan')->nullable();
            //Data  Bangunan
            $table->string('lokasi_bangunan_jalan')->nullable(); // KRK
            $table->string('lokasi_bangunan_kelurahan')->nullable(); // KRK
            $table->string('lokasi_bangunan_Kecamatan')->nullable(); // KRK
            $table->string('jenis_konsultasi_bangunan')->nullable();
            $table->string('fungsi_bangunan')->nullable()->comment('Fungsi Hunian | Fungsi Usaha | Fungsi Sosial dan Budaya | Fungsi Campuran | Fungsi Keagamaan | Fungsi Khusus | ');
            $table->string('nama_bangunan')->nullable();
            $table->string('jumlah_unit_kavling')->nullable();
            $table->string('unit_bangunan')->nullable()->comment('RTT | Gedung | ');
            $table->tinyInteger('jumlah_lantai')->nullable(); // KRK
            $table->Integer('luas_lahan')->nullable(); // KRK
            $table->string('koordinat_lokasi')->nullable(); // KRK
            $table->string('rencana_jenis_kegiatan')->nullable(); // KRK
            $table->string('permanensi_bangunan')->default('Permanen')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0 KRK Sedang Di Proses | 1 = KRK Sudah Di Upload Oleh Operator Menunggu Validasi Dokumen | 2 = Clear / Menunggu Proses Pengabsahan BA | 3 = Finish BA ');
            $table->datetime('verified_operator_at')->nullable()->comment('Kinerja Operator - Created_at | Untuk Memonitoring Kinerja Operator Dalam Memberikan KTK Pada Pengaju PBG / SLF');
            $table->datetime('finish_at')->nullable()->comment('Timestamp dari awal pengajuan - Selesai BA diberikan');
            $table->text('nomor_surat_ba')->nullable()->comment('Ex: 640/BAHK-TPA/PBG-PUPR/ 10 / 2025');
            $table->boolean('has_checked_ba')->default(false); // KRK
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pemohons');
    }
};
