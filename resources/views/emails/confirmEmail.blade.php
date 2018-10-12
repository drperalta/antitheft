@component('mail::message')


#Hi {{ $name }},

Thanks for signing up! Please before you begin, you must confirm your account.


@component('mail::button', ['url' => $confirmationLink])
    Confirm Email
@endcomponent


*if you're having trouble with the button above, copy and paste the URL below into your web browser:*
{{ $confirmationLink }}

@endcomponent
