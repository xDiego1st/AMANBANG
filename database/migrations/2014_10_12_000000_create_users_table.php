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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nip')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('role')->comment("SUPER-ADMIN | ADMIN | VALIDATOR | USER=PEMOHON");
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            //Additional Information for Verifikator
            $table->enum('jenis_user',['TPA','TPT'])->nullable()->comment('TPT | TPA');
            $table->tinyInteger('type_validator')->nullable()->comment('1 = Tim Ahli Arsitektur |  2 = Ahli Struktur | 3 =  Ahli Utilitas & Electrical ( MEP ) | 4 = Pemeriksa Tata Bangunan | 5 = ALLFORSLF');
            // For Status Online
            $table->boolean('status_account')->default('0')->comment('0 | 1 KRK DONE | ');
            $table->string('no_wa')->nullable();
            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->timestamp('last_seen')->nullable();
            $table->tinyInteger('pin_id_pengajuan')->nullable();
            $table->softDeletes();
            $table->string('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
