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
        Schema::create('users_bl', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['SUPER-ADMIN', 'USER'])->default('USER')->comment("SUPER-ADMIN | USER");
            $table->string('name')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('status_account')->default(0)->comment('0 = BAN | 1 ACTIVE');
            $table->string('no_wa')->nullable();
            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->timestamp('last_seen')->nullable();
            $table->datetime('active_until')->nullable();
            $table->string('hwid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_bl');
    }
};
