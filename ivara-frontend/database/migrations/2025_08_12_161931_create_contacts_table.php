<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Full Name
            $table->string('email'); // Email
            $table->string('country_code')->nullable(); // Country code for phone
            $table->string('phone')->nullable(); // Phone number
            $table->string('subject'); // Subject
            $table->text('message'); // Message content
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
