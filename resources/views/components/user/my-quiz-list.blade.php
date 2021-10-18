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
                <td>
                    <span class="badge {{ $quiz->status ? 'bg-primary' : 'bg-danger' }}">{{ $quiz->status_as_text }}</span>
                </td>
                <td>{{ intdiv($quiz->time_limit, 60) }} Min {{ $quiz->time_limit%60 ? ($quiz->time_limit%60).' sec' : '' }}</td>
                <td>
                    @if($quiz->author_digest)
                        <i class="text-primary bi bi-check-circle-fill"></i>
                    @else
                        <i class="text-danger bi bi-x-circle-fill"></i>
                    @endif
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
