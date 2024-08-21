@component('mail::message')
    # Confirmed your reservation

    Hello {{ $data['Name'] }},

    **Booked Date:** {{ $data['Date'] }}
    **Booked Time:** {{ $data['Time'] }}
    **No of Guests:** {{ $data['People'] }}

    **Table List:** {{ implode(', ', $data['Table']->pluck('table_no')->toArray()) }}

    Thanks,
    {{ config('app.name') }}
@endcomponent
