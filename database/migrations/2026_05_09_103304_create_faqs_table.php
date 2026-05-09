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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->timestamps();
        });

        DB::table('faqs')->insert([
            [
                'question' => 'What is StudiOUS?',
                'answer' => 'StudiOUS is a Digital Student Service Management System designed for PSU-OUS to help students access administrative and support services online through a centralized portal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'How do I submit a service request?',
                'answer' => 'Log in to your account, go to the Helpdesk page, open the ticket form, choose a category, describe your issue, and submit the ticket.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'How do I track my request?',
                'answer' => 'Go to My Tickets or My Requests to see the status of your tickets and document requests. You can also view ticket details for updates and replies.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
