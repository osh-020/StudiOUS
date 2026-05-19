<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // First, make the column nullable to avoid NOT NULL issues
        Schema::table('requests', function (Blueprint $table) {
            $table->string('delivery_address')->nullable()->change();
        });
        // Now, change the type to TEXT and keep it nullable
        Schema::table('requests', function (Blueprint $table) {
            $table->text('delivery_address')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->string('delivery_address')->nullable()->change();
        });
    }
};
