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
        Schema::table('users', function (Blueprint $table) {
            $table->string('country')->nullable()->after('address');
            $table->string('region')->nullable()->after('country');
            $table->string('province')->nullable()->after('region');
            $table->string('city')->nullable()->after('province');
            $table->string('barangay')->nullable()->after('city');
            $table->string('postal_code')->nullable()->after('barangay');
            $table->string('street_name')->nullable()->after('postal_code');
            $table->string('building')->nullable()->after('street_name');
            $table->string('house_number')->nullable()->after('building');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'country',
                'region',
                'province',
                'city',
                'barangay',
                'postal_code',
                'street_name',
                'building',
                'house_number',
            ]);
        });
    }
};
