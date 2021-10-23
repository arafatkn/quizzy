<?php

namespace Tests\Unit;

use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_quiz_public_scope()
    {
        $created_quizzes = Quiz::factory()->count(10)->public()->create();

        $quizzes = Quiz::public()->get();

        $this->assertSameSize($created_quizzes, $quizzes);

        $this->assertEquals(1, $quizzes->random()->status);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_quiz_searchBy_scope()
    {
        $created_quizzes = Quiz::factory()->count(10)->create();

        $quizzes = Quiz::searchBy('a')->get();

        $filtered = $created_quizzes->filter(function ($item, $key) {
            return stripos($item->name, 'a') !== false; // Case in-sensitive search
        });

        $this->assertSameSize($filtered, $quizzes);
    }
}
