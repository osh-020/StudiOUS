<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('barangay')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('street_details')->nullable();
            $table->string('delivery_address')->nullable();
        });
    }

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
