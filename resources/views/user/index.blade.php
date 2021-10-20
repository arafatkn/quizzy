@extends('user.layouts.master')

@section('title', 'Dashboard')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Available Quizzes</h3>
        </div>
        <div class="card-body p-0 m-0">
            <x-user.quiz-list :quizzes="$quizzes" />

            <div class="text-center m-3">
                <a href="{{ route('user.quizzes.index') }}" role="button" class="btn btn-info">Show All Available Quizzes</a>
            </div>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-header">
            <h3 class="text-center">My Quizzes</h3>
        </div>
        <div class="card-body p-0 m-0">
            <x-user.my-quiz-list :quizzes="$my_quizzes" />

            <div class="text-center m-3">
                <a href="{{ route('user.my_quizzes') }}" role="button" class="btn btn-info">Show All of My Quizzes</a>
            </div>
        </div>
    </div>

@endsection
