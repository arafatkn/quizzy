@extends('user.layouts.master')

@section('title', 'Available Quizzes')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Available Quizzes</h3>
        </div>
        <div class="card-body p-0 m-0">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Quiz Title</th>
                            <th>Author</th>
                            <th>Time Limit</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($quizzes as $quiz)
                        <tr>
                            <td>{{ $quiz->name }}</td>
                            <td>
                                <a href="?author_id={{ $quiz->author->id }}">{{ $quiz->author->name }}</a>
                            </td>
                            <td>{{ intdiv($quiz->time_limit, 60) }} Min {{ $quiz->time_limit%60 ? ($quiz->time_limit%60).' sec' : '' }}</td>
                            <td class="text-end">
                                <a href="{{ route('user.index') }}" role="button" class="btn btn-secondary">Start Test</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @if($quizzes->hasPages())
            <div class="m-4 d-flex justify-content-center text-center">{{ $quizzes->links() }}</div>
            @endif

        </div>
    </div>

@endsection
