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
        Schema::table('clients', function (Blueprint $table) {
            // Add unique constraints to prevent duplicates
            $table->unique('phone');
            $table->unique('email');
            $table->unique('national_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            // Drop unique constraints
            $table->dropUnique(['phone']);
            $table->dropUnique(['email']);
            $table->dropUnique(['national_id']);
        });
    }
};
