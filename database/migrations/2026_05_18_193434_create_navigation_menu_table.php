<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('navigation_menu', function (Blueprint $table) {
            $table->id();
            $table->string('label', 150)->nullable();
            $table->text('url')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->enum('status', ['1', '0'])->default('0');
            $table->foreignId('parent_id')->nullable()->constrained('navigation_menu')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigation_menu');
    }
};
