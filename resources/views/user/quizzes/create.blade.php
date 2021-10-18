@extends('user.layouts.master')

@section('title', 'Add New Quiz')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Add New Quiz</h3>
        </div>
        <div class="card-body">

            {!! BSForm::open('POST', route('user.quizzes.store')) !!}

            {!! BSForm::multi([
                    ['text', 'name', 'Quiz Name'],
                    ['number', 'time_limit', 'Time Limit (Second)'],
                    ['select', 'status', ['Private', 'Available'], 'Status', 1],
                    ['number', 'total_questions', 'Total Questions'],
                    ['number', 'total_marks', 'Total Marks'],
                    ['checkbox', 'author_digest', 'Receive Daily Updates of Attempts on this Quiz', ],
                ]) !!}

            {!! BSForm::close(true, 'Add New Quiz') !!}

        </div>
    </div>

@endsection
