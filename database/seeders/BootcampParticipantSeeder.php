<?php

namespace Database\Seeders;

use App\Models\BootcampParticipant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BootcampParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate 100 random bootcamp participants
        BootcampParticipant::factory()->count(100)->create();
    }
}
