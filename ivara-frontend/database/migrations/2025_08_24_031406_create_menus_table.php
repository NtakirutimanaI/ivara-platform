<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void
{
Schema::create('menus', function (Blueprint $table) {
$table->id();
$table->string('title');
$table->string('icon')->nullable(); // e.g. 'fa-solid fa-box' or 'heroicon-name'
$table->string('slug')->unique(); // used in /page/{slug}
$table->foreignId('parent_id')->nullable()->constrained('menus')->nullOnDelete();
$table->unsignedInteger('order')->default(0);
$table->boolean('is_active')->default(true);
$table->timestamps();
});
}


public function down(): void
{
Schema::dropIfExists('menus');
}
};