@component('mail::message')
    # Verify Your Email Address

    Dear {{ $data['name'] }},

    Please click the button below to verify your email address.

    {{-- @component('mail::button', ['url' => $url])
        Verify Email Address
    @endcomponent --}}

    {{-- @component('components.new-button', ['url' => $url, 'background' => '#28a745', 'color' => '#ffffff'])
        Verify Email Address
    @endcomponent --}}

    <a href="{{ $url }}">Click To Verify Email Address</a>

    If you did not create an account, no further action is required.

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
