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
            $table->string('names', 120)->nullable();
            $table->string('last_names', 120)->nullable();
            $table->string('company', 120)->nullable();
            $table->string('cellphone', 12)->nullable();
            $table->foreignId('service_id')->constrained('type_services');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
