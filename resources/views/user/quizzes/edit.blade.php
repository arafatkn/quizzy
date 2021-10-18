@extends('user.layouts.master')

@section('title', "Edit Quiz: {$quiz->name}")

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Edit Quiz : <i>{{ $quiz->name }}</i></h3>
        </div>
        <div class="card-body">

            {!! BSForm::open('PUT', route('user.quizzes.update', $quiz->id)) !!}

            {!! BSForm::multi([
                    ['text', 'name', 'Quiz Name', $quiz->name],
                    ['number', 'time_limit', 'Time Limit (Second)', $quiz->time_limit],
                    ['select', 'status', ['Private', 'Available'], 'Status', $quiz->status],
                    ['number', 'total_questions', 'Total Questions', $quiz->total_questions],
                    ['number', 'total_marks', 'Total Marks', $quiz->total_marks],
                    ['checkbox', 'author_digest', 'Receive Daily Updates of Attempts on this Quiz', $quiz->author_digest],
                ]) !!}

            {!! BSForm::close(true, 'Update Quiz') !!}

        </div>
    </div>

@endsection
