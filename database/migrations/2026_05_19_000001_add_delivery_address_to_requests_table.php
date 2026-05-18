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
        Schema::table('requests', function (Blueprint $table) {
            $table->string('country')->nullable()->after('delivery_method');
            $table->string('region')->nullable()->after('country');
            $table->string('province')->nullable()->after('region');
            $table->string('city')->nullable()->after('province');
            $table->string('barangay')->nullable()->after('city');
            $table->string('postal_code')->nullable()->after('barangay');
            $table->string('street_details', 1000)->nullable()->after('postal_code');
            $table->text('delivery_address')->nullable()->after('street_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropColumn([
                'country',
                'region',
                'province',
                'city',
                'barangay',
                'postal_code',
                'street_details',
                'delivery_address',
            ]);
        });
    }
};
