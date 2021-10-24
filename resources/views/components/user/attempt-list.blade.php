<div class="table-responsive">
    <table class="table table-striped align-middle mb-0">
        <thead>
        <tr>
            <th>Date</th>
            <th class="text-center">Corrects</th>
            <th class="text-center">Wrongs</th>
            <th class="text-center">Marks</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($attempts as $attempt)
            <tr>
                <td>{{ $attempt->started_at->format('M j, Y h:i A') }}</td>
                <td class="text-center">{{ $attempt->corrects }}</td>
                <td class="text-center">{{ $attempt->wrongs }}</td>
                <td class="text-center">{{ $attempt->marks }}</td>
                <td class="text-end">
                    <div class="btn-group" role="group">
                        <a href="{{ route('user.attempts.show', $attempt->id) }}" role="button" class="btn btn-info">
                            <i class="bi bi-eye-fill"></i>
                            <span class="d-none d-sm-inline-block">Details</span>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
