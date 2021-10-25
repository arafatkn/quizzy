@extends('user.layouts.master')

@section('title', 'Update Profile')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Change Password</h3>
        </div>
        <div class="card-body">

            {!! BSForm::open('POST', route('user.settings.profile')) !!}

            {!! BSForm::multi([
                    ['text', 'name', 'Your Name', $user->name]
                ]) !!}

            {!! BSForm::close(true, 'Update Profile') !!}

        </div>
    </div>

@endsection
