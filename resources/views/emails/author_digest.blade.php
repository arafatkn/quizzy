@component('mail::message')
    # Daily Digest

    Hi {{ strstr($user->name, ' ', true) }},
    Here is your digest of yesterday.

    @foreach ($quizzes as $quiz)
        ## {{ $quiz->name }}
        @if ($quiz->attempts)
            @foreach ($quiz->attempts as $attempt)
                ### By {{ \App\Models\User::find($attempt->user_id)->name }}, Attempted: {{ $attempt->attempts_count }} times, Max: {{ $attempt->max_marks }}, Min: {{ $attempt->min_marks }}, Avg: {{ $attempt->avg_marks }}
            @endforeach
        @else
            ### No Attempts
        @endif
    @endforeach

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
