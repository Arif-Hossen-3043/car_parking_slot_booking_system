<?php

namespace Database\Seeders;

// use App\Models\User;
use App\Models\Slot;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
  // Seed parking slots (S1 → S16)
        for ($i = 1; $i <= 16; $i++) {
            Slot::create([
                'slot_number' => 'S' . $i,
                'is_booked' => 'false', // you can use 'available'/'booked'
            ]);
        }
        
    }
}
