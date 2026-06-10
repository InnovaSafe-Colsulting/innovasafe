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
        Schema::create('type_services_detail', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->enum('type_module', ['Basico', 'Adicional'])->nullable();
            $table->unsignedBigInteger('type_service_id');
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamps();
            
            $table->foreign('type_service_id')->references('id')->on('type_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_services_detail');
    }
};