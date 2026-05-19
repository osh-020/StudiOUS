<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE tickets DROP FOREIGN KEY tickets_user_id_foreign');
        DB::statement('ALTER TABLE tickets MODIFY user_id BIGINT UNSIGNED NULL');

        Schema::table('tickets', function (Blueprint $table) {
            $table->string('email')->nullable()->after('user_id');
        });

        DB::statement('ALTER TABLE tickets ADD CONSTRAINT tickets_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE tickets DROP FOREIGN KEY tickets_user_id_foreign');

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('email');
        });

        DB::statement('ALTER TABLE tickets MODIFY user_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE tickets ADD CONSTRAINT tickets_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE');
    }
};
