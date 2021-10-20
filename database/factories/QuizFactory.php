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
        $total_questions = $this->faker->randomElement([10, 20, 30, 40, 50, 60]);

        return [
            'author_id' => User::inRandomOrder()->first()->id ?? 1,
            'name' => $this->faker->text(30),
            'status' => $this->faker->boolean(),
            'total_questions' => $total_questions,
            'total_marks' => $total_questions * rand(1, 3),
            'time_limit' => $total_questions * rand(1, 2) * 60,
            'author_digest' => $this->faker->boolean(70),
        ];
    }

    /**
     * Indicates that it's a public quiz.
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
