<div class="table-responsive">
    <table class="table table-striped align-middle mb-0">
        <thead>
            <tr>
                <th>Question</th>
                <th>Options</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($questions as $question)
            <tr>
                <td>{{ $question->question }}</td>
                <td>
                    @foreach($question->options as $key => $value)
                        ({{ $key }}). {{ $value }} <br/>
                    @endforeach
                    <mark>Answer: {{ $question->answer }}</mark>
                </td>
                <td class="text-end">
                    <div class="btn-group" role="group">
                        <button onclick="editData('{{ $question->id }}')" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#EditModal">
                            <i class="bi bi-pencil-square"></i>
                            <span class="d-none d-sm-inline-block">Edit</span>
                        </button>
                        <button onclick="gdConfirm('{{ route('user.quizzes.destroy', $question->id) }}')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#GDModal">
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
