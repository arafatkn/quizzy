@component('mail::message')

Hi {{ strstr($user->name, ' ', true) }},

Here is your digest of yesterday {{ today()->subDay()->format('F j, Y') }}.

@foreach ($quizzes as $quiz)

@component('mail::panel')
**Quiz Title: *{{ $quiz->name }}***

@if (count($quiz->attempts) == 0)
No Attempts Yesterday
@endif
@endcomponent

@if (count($quiz->attempts) > 0)
@component('mail::table')
| User             | Attempted        | Max Marks    | Min Marks        | Average          |
| ---------------- |:----------------:|:------------:|:----------------:|:----------------:|
@foreach ($quiz->attempts as $attempt)
| {{ $attempt->user->name }} | {{ $attempt->attempts_count }} | {{ round($attempt->max_marks, 2) }} | {{ round($attempt->min_marks, 2) }} | {{ round($attempt->avg_marks, 2) }} |
@endforeach
@endcomponent
@endif

@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
