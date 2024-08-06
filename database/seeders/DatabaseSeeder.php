<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create normal users 
        $users = \App\Models\User::factory(10)->create();
        
        // create admin 
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // create tickets
        \App\Models\Ticket::factory(100)
            ->recycle($users)
            ->create();
            
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
