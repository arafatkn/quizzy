<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(QuestionStoreRequest $request)
    {
        $quiz = auth()->user()->quizzes()->findOrFail($request->quiz_id);

        $question = new Question();
        $question->quiz_id = $quiz->id;
        $question->fill( $request->only(['question', 'answer', 'options']) );

        if($question->save()) {
            return back()->withSuccess('Question has been added successfully.');
        }

        return back()->withErrors('Unable to add question. Please try again later.');
    }

    public function update(QuestionUpdateRequest $request, Question $question)
    {
        auth()->user()->quizzes()->findOrFail($question->quiz_id);

        $question->fill( $request->only(['question', 'answer', 'options']) );

        if($question->save()) {
            return back()->withSuccess('Question has been updated successfully.');
        }

        return back()->withErrors('Unable to update question. Please try again later.');
    }
}
