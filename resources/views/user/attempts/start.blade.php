@extends('user.layouts.master')

@section('title', "Quiz Details : {$quiz->name}")

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">{{ $quiz->name }}</h3>
        </div>
        <div class="card-body p-0 m-0">
            <table class="table table-striped align-middle mb-0">
                <tbody>
                    <tr>
                        <th>Quiz Title</th>
                        <td>{{ $quiz->name }}</td>
                    </tr>
                    <tr>
                        <th>Author</th>
                        <td><a href="?author_id={{ $quiz->author_id }}">{{ $quiz->author->name }}</a></td>
                    </tr>
                    <tr>
                        <th>Total Marks</th>
                        <td>{{ $quiz->total_marks }}</td>
                    </tr>
                    <tr>
                        <th>Total Questions</th>
                        <td>{{ $quiz->total_questions }}</td>
                    </tr>
                    <tr>
                        <th>Time Limit</th>
                        <td>{{ $quiz->time_limit_as_text }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="text-center m-3">
                <form method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg px-5">Start Quiz</button>
                </form>
            </div>
        </div>
    </div>
@endsection
