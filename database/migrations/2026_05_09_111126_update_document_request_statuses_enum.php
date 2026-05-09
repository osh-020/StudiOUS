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
        DB::statement("ALTER TABLE requests MODIFY status ENUM('Pending', 'Processing', 'Ready for Release', 'Completed', 'Rejected', 'Cancelled', 'Cancellation Requested') NOT NULL DEFAULT 'Pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE requests MODIFY status ENUM('Open', 'In Progress', 'Pending', 'Resolved') NOT NULL DEFAULT 'Pending'");
    }
};
