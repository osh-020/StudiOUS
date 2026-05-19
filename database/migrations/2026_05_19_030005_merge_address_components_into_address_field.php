<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Combine street_name, building, and house_number into the address column
        // Format: "house_number building street_name" with proper null handling
        DB::statement("UPDATE users SET address = CONCAT_WS(' ', COALESCE(house_number, ''), COALESCE(building, ''), COALESCE(street_name, '')) WHERE address IS NULL OR address = ''");

        // Update the address column to be a longer text field (nullable)
        Schema::table('users', function (Blueprint $table) {
            $table->text('address')->nullable()->change();
        });

        // Drop the three separate columns
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['street_name', 'building', 'house_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back the three columns
        Schema::table('users', function (Blueprint $table) {
            $table->string('street_name')->nullable()->after('postal_code');
            $table->string('building')->nullable()->after('street_name');
            $table->string('house_number')->nullable()->after('building');
        });

        // The data in the individual columns will be null since we cannot reliably
        // split the merged address back into the original components.

        // Revert the address column back to its original size
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable()->change();
        });
    }
};
