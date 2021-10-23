@extends('user.layouts.master')

@section('title', "Your Attempts")

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-center">
            <span class="h3">My Attempts</span>
        </div>
        <div class="card-body p-0 m-0">
            <x-user.my-attempt-list :attempts="$attempts" />

            @if($attempts->hasPages())
                <div class="m-4 d-flex justify-content-center text-center">{{ $attempts->links() }}</div>
            @endif

        </div>
    </div>

@endsection
