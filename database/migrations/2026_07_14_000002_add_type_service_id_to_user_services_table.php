<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_services', function (Blueprint $table) {
            $table->foreignId('type_service_id')->nullable()->constrained('type_services')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('user_services', function (Blueprint $table) {
            $table->dropForeign(['type_service_id']);
            $table->dropColumn('type_service_id');
        });
    }
};
