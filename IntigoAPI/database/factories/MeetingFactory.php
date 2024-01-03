<?php
namespace Database\Factories;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetingFactory extends Factory
{
    protected $model = Meeting::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(100, 1000),
            'slots' => $this->faker->numberBetween(1, 20),
            'start_at' => $this->faker->dateTimeBetween('now', '+1 week'),
            'end_at' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'is_private' => $this->faker->boolean,
            'creator_id' => \App\Models\Creator::factory() // Ini mengasumsikan bahwa ada relasi dengan Creator
        ];
    }
}
