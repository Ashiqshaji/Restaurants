@component('mail::message')
    # QUINCE Booking confirmation



    Dear {{ $data['Name'] }},

    We are pleased to confirm your booking as follows:

    Booking Details:

    Date : {{ $data['Date'] }}
    Time : {{ $data['Time'] }}
    No of Guests : {{ $data['People'] }}

    Table Number(s) : {{ implode(', ', $data['Table']->pluck('table_no')->filter()->toArray()) }}


    If you have any questions or need to make changes to your booking,
    please do not hesitate to contact us at (+971) 56 418 4244.

    We look forward to serving you!


    Thanks,
    {{ config('app.name') }}
@endcomponent
