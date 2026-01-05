<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void
{
Schema::create('pages', function (Blueprint $table) {
$table->id();
$table->foreignId('menu_id')->constrained('menus')->cascadeOnDelete();
$table->string('title');
$table->longText('content')->nullable(); // HTML or JSON blocks
$table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
$table->timestamps();
});
}


public function down(): void
{
Schema::dropIfExists('pages');
}
};