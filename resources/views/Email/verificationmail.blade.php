@component('mail::message')
    # Verify Your Email Address

    Dear {{ $data['name'] }},

    Please click the button below to verify your email address.



    @component('mail::button', ['url' => $url])
        Verify Email Address
    @endcomponent


    If you did not create an account, no further action is required.

    Thanks
    {{ config('app.name') }}
@endcomponent
