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
                        <th>Author</th>
                        <td><a href="?author_id={{ $quiz->author->id }}">{{ $quiz->author->name }}</a></td>
                    </tr>
                    <tr>
                        <th>Time Limit</th>
                        <td>{{ intdiv($quiz->time_limit, 60) }} Min {{ $quiz->time_limit%60 ? ($quiz->time_limit%60).' sec' : '' }}</td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <a href="{{ route('user.quizzes.edit', $quiz->id) }}" role="button" class="btn btn-warning">Edit</a>
                            <button onclick="gdConfirm('{{ route('user.quizzes.destroy', $quiz->id) }}')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#GDModal">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
