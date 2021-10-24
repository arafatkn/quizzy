@component('mail::message')
    # Welcome to {{ config('app.name') }}

    Hi {{ strstr($user->name, ' ', true) }},
    Welcome to {{ config('app.name') }}. Hope, you will enjoy this.
    Create and attempt as many as quiz you want. It's totally free!

    @component('mail::button', ['url' => config('app.url')])
        Visit {{ config('app.name') }}
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
