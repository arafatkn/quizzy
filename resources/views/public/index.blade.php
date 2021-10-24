@extends('public.layouts.master')

@section('title', 'Quizzy - Interactive Online Quiz System')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Available Quizzes</h3>
        </div>
        <div class="card-body p-0 m-0">
            <x-user.quiz-list :quizzes="$quizzes" />

            @if($quizzes->hasPages())
                <div class="m-4 d-flex justify-content-center text-center">{{ $quizzes->links() }}</div>
            @endif
        </div>
        @guest
        <div class="card-footer text-center">
            You must <a href="{{ route('auth.login') }}">login</a> or <a href="{{ route('auth.register') }}">create an account</a> to participate in quiz test.
        </div>
        @endguest
    </div>

@endsection
