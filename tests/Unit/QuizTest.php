<?php

namespace Tests\Unit;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Public Quizzes Test.
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
     * Filtering quizzes by author test.
     *
     * @return void
     */
    public function test_quiz_of_author_scope()
    {
        $created_quizzes = Quiz::factory()->count(10)->create([
            'author_id' => 1,
        ]);

        $quizzes = Quiz::ofAuthor(1)->get();

        $this->assertSameSize($created_quizzes, $quizzes);
        $this->assertEquals(1, $quizzes->random()->author_id);
    }

    /**
     * Filtering except author test.
     *
     * @return void
     */
    public function test_quiz_except_author_scope()
    {
        $created_quizzes = Quiz::factory()->count(10)->create([
            'author_id' => rand(2,10),
        ]);

        $quizzes = Quiz::exceptAuthor(1)->get();

        $this->assertSameSize($created_quizzes, $quizzes);
        $this->assertNotEquals(1, $quizzes->random()->author_id);
    }

    /**
     * Search by string in Quiz name test.
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

    /**
     * Quiz delete test.
     *
     * @return void
     */
    public function test_quiz_deletion()
    {
        $quiz = Quiz::factory()->hasQuestions(10)->create();

        $this->assertEquals(10, $quiz->questions()->count());

        $quiz->delete();

        $this->assertEquals(0, Question::where('quiz_id', $quiz->id)->count());
    }
}
