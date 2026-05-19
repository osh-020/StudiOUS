<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE `tickets` MODIFY `category` ENUM('Login Issue', 'Payment', 'Document', 'Document Request', 'Others') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE `tickets` MODIFY `category` ENUM('Login Issue', 'Payment', 'Document', 'Others') NOT NULL");
    }
};
