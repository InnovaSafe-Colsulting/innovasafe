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
        Schema::create('documents_resources_details', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150)->nullable();
            $table->string('path', 100);
            $table->foreignId('resource_type_id')->constrained('resources_types')->onDelete('cascade');
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents_resources_details');
    }
};
