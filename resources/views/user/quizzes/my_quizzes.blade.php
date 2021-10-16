@extends('user.layouts.master')

@section('title', 'My Quizzes')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span class="h3">My Quizzes</span>
            <a role="button" class="btn btn-primary" href="{{ route('user.quizzes.create') }}">
                <i class="bi bi-plus-lg"></i>
                <span class="d-none d-sm-inline-block">Add New Quiz</span>
            </a>
        </div>
        <div class="card-body p-0 m-0">
            <x-user.my-quiz-list :quizzes="$quizzes" />

            @if($quizzes->hasPages())
                <div class="m-4 d-flex justify-content-center text-center">{{ $quizzes->links() }}</div>
            @endif

        </div>
    </div>

@endsection
