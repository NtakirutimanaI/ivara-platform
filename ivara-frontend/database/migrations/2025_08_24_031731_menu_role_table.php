<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void
{
Schema::create('menu_role', function (Blueprint $table) {
$table->id();
$table->foreignId('menu_id')->constrained('menus')->cascadeOnDelete();
$table->unsignedBigInteger('role_id'); // spatie roles table
$table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
$table->unique(['menu_id','role_id']);
});
}


public function down(): void
{
Schema::dropIfExists('menu_role');
}
};