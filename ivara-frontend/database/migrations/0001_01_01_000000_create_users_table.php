<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('username')->unique();
            $table->string('country_code')->default('RW - 250');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('role')->default('client');
            $table->string('password');

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

            $table->timestamps();

            // Optional unique constraint for country_code + phone
            $table->unique(['country_code', 'phone']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
