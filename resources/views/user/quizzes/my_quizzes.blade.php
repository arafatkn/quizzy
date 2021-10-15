@extends('user.layouts.master')

@section('title', 'My Quizzes')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">My Quizzes</h3>
        </div>
        <div class="card-body p-0 m-0">
            <x-user.my-quiz-list :quizzes="$quizzes" />

            @if($quizzes->hasPages())
                <div class="m-4 d-flex justify-content-center text-center">{{ $quizzes->links() }}</div>
            @endif

        </div>
    </div>

@endsection
