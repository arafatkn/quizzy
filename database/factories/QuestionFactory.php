<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $total_options = 4;
        $options = [];

        for ($i = 1; $i <= $total_options; $i++) {
            $options[$i] = $this->faker->text(20);
        }

        return [
            'quiz_id' => Quiz::inRandomOrder()->first()->id,
            'question' => $this->faker->text(200),
            'options' => $options,
            'answer' => rand(1, count($options)),
        ];
    }
}
