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
                        <th>Status</th>
                        <td>
                            <span class="badge {{ $quiz->status ? 'bg-primary' : 'bg-danger' }}">
                                {{ $quiz->status_as_text }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Author</th>
                        <td><a href="?author_id={{ $quiz->author_id }}">{{ $user->name }}</a></td>
                    </tr>
                    <tr>
                        <th>Author Digest</th>
                        <td>
                            @if($quiz->author_digest)
                                Yes <i class="text-primary bi bi-check-circle-fill"></i>
                            @else
                                No <i class="text-danger bi bi-x-circle-fill"></i>
                            @endif
                        </td>
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
                    <tr>
                        <th></th>
                        <td>
                            <a href="{{ route('user.quizzes.edit', $quiz->id) }}" role="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Edit</a>
                            <button onclick="gdConfirm('{{ route('user.quizzes.destroy', $quiz->id) }}')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#GDModal"><i class="bi bi-trash-fill"></i> Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-2"></div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span class="h3">Questions</span>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal">
                <i class="bi bi-plus-lg"></i>
                <span class="d-none d-sm-inline-block">Add New Question</span>
            </button>
        </div>
        <div class="card-body p-0 m-0">
            <x-user.my-quiz-question-list :questions="$questions" />

            @if($questions->hasPages())
                <div class="m-4 d-flex justify-content-center text-center">{{ $questions->links() }}</div>
            @endif

        </div>
    </div>

    <x-form-modal id="AddModal" title="Add New Question" method="POST" action="{{ route('user.questions.store') }}">
        <x-slot name="body">
            {!! BSForm::multi([
                [ 'hidden', 'quiz_id', $quiz->id ],
                [ 'textarea', 'question', 'Question' ],
                [ 'text', 'options[1]', 'Option 1' ],
                [ 'text', 'options[2]', 'Option 2' ],
                [ 'text', 'options[3]', 'Option 3' ],
                [ 'text', 'options[4]', 'Option 4' ],
                [ 'select', 'answer', [1 => 'Option 1', 'Option 2', 'Option 3', 'Option 4'], 'Select Right Answer' ],
            ]) !!}
        </x-slot>
    </x-form-modal>

    <x-form-modal id="EditModal" form-id="editForm" title="Edit Question" method="PUT" action="{{ route('user.index') }}">
        <x-slot name="body">
            {!! BSForm::multi([
                [ 'textarea', 'question', 'Question' ],
                [ 'text', 'options[1]', 'Option 1' ],
                [ 'text', 'options[2]', 'Option 2' ],
                [ 'text', 'options[3]', 'Option 3' ],
                [ 'text', 'options[4]', 'Option 4' ],
                [ 'select', 'answer', [1 => 'Option 1', 'Option 2', 'Option 3', 'Option 4'], 'Select Right Answer' ],
            ]) !!}
        </x-slot>
    </x-form-modal>

@endsection

@section('script')
<script type="text/javascript">

    var questions = @json($questions);

    function editData(id) {
        let data = questions.data.find(q => q.id == id);
        if(!data) {
            return false;
        }
        formFill( document.getElementById('editForm'), data);
        document.getElementById('editForm').action = "{{ route('user.questions.update', 0) }}".replace('0', id);
    }
</script>
@endsection
