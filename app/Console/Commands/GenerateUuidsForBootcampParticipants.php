<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BootcampParticipant;
use Illuminate\Support\Str;

class GenerateUuidsForBootcampParticipants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:bootcamp-participant-uuids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate UUIDs for bootcamp participants without UUIDs';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        // Get all bootcamp participants without UUIDs
        $participants = BootcampParticipant::whereNull('uuid')->get();

        foreach ($participants as $participant) {
            $participant->uuid = BootcampParticipant::generateUniqueFourDigitUuid(); // Use the same method to generate UUID
            $participant->save();
        }

        $this->info('UUIDs generated for ' . $participants->count() . ' bootcamp participants.');
    }
}
