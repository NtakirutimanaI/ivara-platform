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
        Schema::table('activities', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->string('status')->default('active')->change();
            
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('activities', 'message')) {
                $table->string('message')->nullable();
            }
            if (!Schema::hasColumn('activities', 'icon')) {
                $table->string('icon')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            //
        });
    }
};
