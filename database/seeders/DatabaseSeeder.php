<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create sample user
        $user = User::create([
            'name' => 'Sample User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Create sample ticket
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'subject' => 'Sample Ticket',
            'category' => 'Login Issue',
            'priority' => 'Medium',
            'description' => 'This is a sample ticket description.',
        ]);

        // Create sample message
        Message::create([
            'ticket_id' => $ticket->id,
            'sender_id' => $user->id,
            'message' => 'Hello, I need help with login.',
        ]);
    }
}
