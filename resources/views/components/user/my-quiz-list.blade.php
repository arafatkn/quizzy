<div class="table-responsive">
    <table class="table table-striped align-middle mb-0">
        <thead>
            <tr>
                <th>Quiz Title</th>
                <th class="text-center">Status</th>
                <th class="text-center">Added Questions</th>
                <th class="text-center">Digest</th>
                <th class="text-center">Attempts</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($quizzes as $quiz)
            <tr>
                <td>
                    <a href="{{ route('user.quizzes.show', $quiz->id) }}">{{ $quiz->name }}</a>
                </td>
                <td class="text-center">
                    <span class="badge {{ $quiz->status ? 'bg-primary' : 'bg-danger' }}">{{ $quiz->status_as_text }}</span>
                </td>
                <td class="text-center">{{ $quiz->questions_count }}</td>
                <td class="text-center">
                    @if($quiz->author_digest)
                        <i class="text-primary bi bi-check-circle-fill"></i>
                    @else
                        <i class="text-danger bi bi-x-circle-fill"></i>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('user.quizzes.attempts', $quiz->id) }}">{{ $quiz->attempts_count }}</a>
                </td>
                <td class="text-end">
                    <div class="btn-group" role="group">
                        <a href="{{ route('user.quizzes.edit', $quiz->id) }}" role="button" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i>
                            <span class="d-none d-sm-inline-block">Edit</span>
                        </a>
                        <button onclick="gdConfirm('{{ route('user.quizzes.destroy', $quiz->id) }}')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#GDModal">
                            <i class="bi bi-trash-fill"></i>
                            <span class="d-none d-sm-inline-block">Delete</span>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
