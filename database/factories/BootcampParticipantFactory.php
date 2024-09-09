<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BootcampParticipant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BootcampParticipant>
 */
class BootcampParticipantFactory extends Factory
{
    protected $model = BootcampParticipant::class;

    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'name_en' => $this->faker->name,
            'name_ar' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'age' => $this->faker->numberBetween(18, 60),
            'phone_number' => $this->faker->phoneNumber,
            'educational_institute' => $this->faker->company,
            'graduation_year' => $this->faker->year,
            'position' => $this->faker->jobTitle,
            'national' => $this->faker->unique()->numerify('NAT#######'),
            'is_participated' => $this->faker->randomElement(['0', '1']),
            'participated_year' => $this->faker->optional()->year,
            'is_attend_formation_activity' => $this->faker->randomElement(['0', '1']),
            'why_this_workshop' => $this->faker->sentence,
            'is_have_team' => $this->faker->randomElement(['0', '1', '2']),
            'comment' => $this->faker->optional()->text,
            'year' => $this->faker->year,

            // Default Foreign Keys
            'educational_level_id' => 2,  // Fixed value
            'field_of_study_id' => 1,  // Fixed value
            'first_priority_id' => 1,  // Fixed value
            'second_priority_id' => 1,  // Fixed value
            'third_priority_id' => 1,  // Fixed value
            'created_by_id' => 1,  // Fixed value

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
