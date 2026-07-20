<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_services', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'status']);
            $table->dropColumn('user_id');
        });

        Schema::table('user_services', function (Blueprint $table) {
            $table->dropForeign(['contact_id']);
            $table->dropColumn('contact_id');
        });

        Schema::table('user_services', function (Blueprint $table) {
            $table->foreignId('contact_id')->nullable()->after('id')->constrained('contacts')->nullOnDelete();
            $table->index(['contact_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::table('user_services', function (Blueprint $table) {
            $table->dropIndex(['contact_id', 'status']);
            $table->dropForeign(['contact_id']);
            $table->dropColumn('contact_id');
            $table->unsignedBigInteger('user_id')->after('id');
            $table->index(['user_id', 'status']);
        });
    }
};
