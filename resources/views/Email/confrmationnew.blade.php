@component('mail::message')
    # QUINCE New  Booking 

    Dear Teams,

    Booking Details:
    Name :  {{ $data['Name'] }} 
    Date : {{ $data['Date'] }}
    Time : {{ $data['Time'] }}
    No of Guests : {{ $data['People'] }}

    Thanks,
    {{ config('app.name') }}
@endcomponent
