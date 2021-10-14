<?php

namespace Database\Factories;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quiz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'author_id' => User::inRandomOrder()->first()->id ?? 1,
            'name' => $this->faker->text(30),
            'time_limit' => $this->faker->randomElement([600, 1200, 1800, 2400, 3000, 3600]),
            'author_digest' => $this->faker->boolean(70),
            'status' => $this->faker->boolean(),
        ];
    }

    /**
     * Indicates that it's a public quiz
     */
    public function public()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 1,
            ];
        });
    }
}
