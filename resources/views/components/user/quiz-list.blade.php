<div class="table-responsive">
    <table class="table table-striped align-middle mb-0">
        <thead>
        <tr>
            <th>Quiz Title</th>
            <th class="text-center">Author</th>
            <th class="text-center">Marks</th>
            <th class="text-center">Questions</th>
            <th class="text-center">Time Limit</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($quizzes as $quiz)
            <tr>
                <td>{{ $quiz->name }}</td>
                <td class="text-center">
                    <a href="?author_id={{ $quiz->author->id }}">{{ $quiz->author->name }}</a>
                </td>
                <td class="text-center">{{ $quiz->total_marks }}</td>
                <td class="text-center">{{ $quiz->total_questions }}</td>
                <td class="text-center">{{ intdiv($quiz->time_limit, 60) }} Min {{ $quiz->time_limit%60 ? ($quiz->time_limit%60).' sec' : '' }}</td>
                <td class="text-end">
                    <a href="{{ route('user.quizzes.start', $quiz->id) }}" role="button" class="btn btn-secondary">Start Test</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
