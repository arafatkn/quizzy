@extends('public.layouts.master')

@section('title', 'Quizzy - Interactive Online Quiz System')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Available Quizzes</h3>
        </div>
        <div class="card-body p-0 m-0">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <tbody>
                    @foreach($quizzes as $quiz)
                        <tr>
                            <td>{{ $quiz->name }}</td>
                            <td>{{ intdiv($quiz->time_limit, 60) }} Min {{ $quiz->time_limit%60 ? ($quiz->time_limit%60).' sec' : '' }}</td>
                            <td class="text-end">
                                <a href="{{ route('user.index') }}" role="button" class="btn btn-secondary">Start Test</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @guest
        <div class="card-footer text-center">
            You must <a href="{{ route('auth.login') }}">login</a> or <a href="{{ route('auth.register') }}">create an account</a> to participate in quiz test.
        </div>
        @endguest
    </div>

@endsection
