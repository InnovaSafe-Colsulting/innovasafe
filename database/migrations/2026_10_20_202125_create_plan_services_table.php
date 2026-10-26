<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_services', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('plan_id');

            $table->foreignId('service_id');

            $table->timestamps();

            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')
                ->cascadeOnDelete();

            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->cascadeOnDelete();

            $table->unique([
                'plan_id',
                'service_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_services');
    }
};