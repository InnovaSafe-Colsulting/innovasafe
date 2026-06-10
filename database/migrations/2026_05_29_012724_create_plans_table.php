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
        Schema::create('plans', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->notNull();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('access', 10)->nullable();
            $table->double('prize')->nullable();
            $table->string('basic_modules', 100)->nullable();
            $table->string('additional_modules', 100)->nullable();
            $table->integer('discount')->default(0);
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
