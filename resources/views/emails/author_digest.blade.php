@component('mail::message')
    # Daily Digest
    ## {{ $quiz->name }}

    Here is your digest of yesterday.

    @component('mail::button', ['url' => route('user.my_quizzes')])
        View All
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
