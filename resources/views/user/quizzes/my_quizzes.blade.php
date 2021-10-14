@extends('user.layouts.master')

@section('title', 'My Quizzes')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">My Quizzes</h3>
        </div>
        <div class="card-body p-0 m-0">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                    <tr>
                        <th>Quiz Title</th>
                        <th>Status</th>
                        <th>Time Limit</th>
                        <th>Digest</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quizzes as $quiz)
                        <tr>
                            <td>
                                <a href="{{ route('user.quizzes.show', $quiz->id) }}">{{ $quiz->name }}</a>
                            </td>
                            <td>{{ $quiz->status_as_text }}</td>
                            <td>{{ intdiv($quiz->time_limit, 60) }} Min {{ $quiz->time_limit%60 ? ($quiz->time_limit%60).' sec' : '' }}</td>
                            <td>{{ $quiz->author_digest_as_text }}</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('user.quizzes.edit', $quiz->id) }}" role="button" class="btn btn-warning">Edit</a>
                                    <button onclick="gdConfirm('{{ route('user.quizzes.destroy', $quiz->id) }}')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#GDModal">Delete</button>
                                </div>
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
