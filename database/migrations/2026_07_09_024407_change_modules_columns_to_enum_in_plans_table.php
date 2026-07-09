<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE plans MODIFY basic_modules ENUM('1','0') NOT NULL DEFAULT '1'");
        DB::statement("ALTER TABLE plans MODIFY additional_modules ENUM('1','0') NOT NULL DEFAULT '1'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE plans MODIFY basic_modules VARCHAR(100) NULL DEFAULT NULL");
        DB::statement("ALTER TABLE plans MODIFY additional_modules VARCHAR(100) NULL DEFAULT NULL");
    }
};
