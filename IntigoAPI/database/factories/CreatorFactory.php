<?php
namespace Database\Factories;

use App\Models\Creator;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreatorFactory extends Factory
{
    protected $model = Creator::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            // Contoh atribut tambahan, sesuaikan dengan model Creator Anda
            //'email' => $this->faker->unique()->safeEmail,
            'username' => $this->faker->userName,
            'profile_photo' => $this->faker->imageUrl(640, 480, 'people'),
            'is_verified' => $this->faker->boolean
        ];
    }
}
