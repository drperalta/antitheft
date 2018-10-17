@component('mail::message')


#Hi {{ $name }},

You are receiving this email because we received a password reset request for your account.


@component('mail::button', ['url' => $resetLink])
    Reset Password
@endcomponent

If you did not request a password reset, no further action is required.


*if you're having trouble with the button above, copy and paste the URL below into your web browser:*
{{ $resetLink }}

@endcomponent
