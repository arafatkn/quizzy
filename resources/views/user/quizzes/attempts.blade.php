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
                        <th>Total Marks</th>
                        <td>{{ $quiz->total_marks }}</td>
                    </tr>
                    <tr>
                        <th>Total Questions</th>
                        <td>{{ $quiz->total_questions }}</td>
                    </tr>
                    <tr>
                        <th>Time Limit</th>
                        <td>{{ intdiv($quiz->time_limit, 60) }} Min {{ $quiz->time_limit%60 ? ($quiz->time_limit%60).' sec' : '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-2"></div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span class="h3">Attempts</span>
        </div>
        <div class="card-body p-0 m-0">
            @if ($attempts->count() > 0)
                <x-user.attempt-list :attempts="$attempts" />

                @if($attempts->hasPages())
                    <div class="m-4 d-flex justify-content-center text-center">{{ $attempts->links() }}</div>
                @endif
            @else
                <h5 class="m-4">No Attempt Yet</h5>
            @endif
        </div>
    </div>

@endsection
