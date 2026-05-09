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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('subject');
            $table->string('purpose');
            $table->string('delivery_method');
            $table->string('payment_proof')->nullable();
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium');
            $table->enum('status', ['Open', 'In Progress', 'Pending', 'Resolved'])->default('Pending');
            $table->timestamps();
        });

        DB::table('tickets')
            ->where('category', 'Document Request')
            ->orderBy('id')
            ->chunkById(100, function ($tickets) {
                foreach ($tickets as $ticket) {
                    DB::table('requests')->insert([
                        'user_id' => $ticket->user_id,
                        'subject' => $ticket->subject,
                        'purpose' => $ticket->purpose,
                        'delivery_method' => $ticket->delivery_method,
                        'payment_proof' => $ticket->payment_proof,
                        'priority' => $ticket->priority,
                        'status' => $ticket->status,
                        'created_at' => $ticket->created_at,
                        'updated_at' => $ticket->updated_at,
                    ]);
                }
            });

        DB::table('tickets')->where('category', 'Document Request')->delete();

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['purpose', 'delivery_method', 'payment_proof']);
        });

        DB::statement("ALTER TABLE `tickets` MODIFY `category` ENUM('Login Issue', 'Payment', 'Document', 'Others') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('purpose')->nullable();
            $table->string('delivery_method')->nullable();
            $table->string('payment_proof')->nullable();
        });

        DB::statement("ALTER TABLE `tickets` MODIFY `category` ENUM('Login Issue', 'Payment', 'Document', 'Document Request', 'Others') NOT NULL");

        DB::table('requests')
            ->orderBy('id')
            ->chunkById(100, function ($requests) {
                foreach ($requests as $request) {
                    DB::table('tickets')->insert([
                        'user_id' => $request->user_id,
                        'subject' => $request->subject,
                        'category' => 'Document Request',
                        'priority' => $request->priority,
                        'status' => $request->status,
                        'description' => $request->purpose,
                        'purpose' => $request->purpose,
                        'delivery_method' => $request->delivery_method,
                        'payment_proof' => $request->payment_proof,
                        'created_at' => $request->created_at,
                        'updated_at' => $request->updated_at,
                    ]);
                }
            });

        Schema::dropIfExists('requests');
    }
};
