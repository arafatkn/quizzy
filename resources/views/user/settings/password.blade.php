@extends('user.layouts.master')

@section('title', 'Change Password')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Change Password</h3>
        </div>
        <div class="card-body">

            {!! BSForm::open('POST', route('user.settings.password')) !!}

            {!! BSForm::multi([
                    ['password', 'current_password', 'Current Password'],
                    ['password', 'new_password', 'New Password'],
                    ['password', 'new_password_confirmation', 'New Password Again'],
                ]) !!}

            {!! BSForm::close(true, 'Update Password') !!}

        </div>
    </div>

@endsection
