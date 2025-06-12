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
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('is_admin')->default(0)->comment('1=>admin, 0=>User');
            $table->string('phome_number')->nullable();
            $table->string('country_code')->nullable();
            $table->string('currency')->default('inr')->default('inr or usd');
            $table->integer('is_verified')->default(0)->comment('0=>unverified, 1=>verified');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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