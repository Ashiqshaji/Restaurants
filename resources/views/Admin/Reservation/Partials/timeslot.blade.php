<style>
    /* Custom tooltip style */
    .tooltip.custom-tooltip .tooltip-inner {
        background-color: #ce972c;
        /* Change background color to red */
        color: white;
        /* Optional: Change text color to white for better contrast */
    }

    .tooltip.custom-tooltip .tooltip-arrow {
        border-top-color: #ce972c;
        /* Change the arrow color to match the tooltip background */
    }

    .search_mobile {
        width: 100%;
        margin: 10px 0px;
    }

    .border-red {
        border: 2px solid red;
    }

    .border-green {
        border: 2px solid green;
    }
</style>
{{-- <div class="list_reservation_table" style="padding: 0px 20px !important">
    <div class="row text-center">
        @for ($i = 0; $i <= 7 * 2 + 1; $i++)
            @php
                $time = \Carbon\Carbon::createFromTime(8, 0)->addMinutes($i * 60);
                $timeStr = $time->format('h:i A'); // 12-hour format
                $buttonId = 'btn-' . $time->format('Hi');
                $timecheck = $time->format('H:i');
            @endphp

            <div class="col-6 col-sm-4 col-md-3 p-1">
                <div class="card time-slot-card" id="{{ $buttonId }}" data-time="{{ $time->format('H:i') }}"
                    style="
                    height: 115px;
                ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="time">
                                    <span class="display_time">{{ $time->format('h:i A') }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="booking_header">
                                    BOOKINGS
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="booking_number">
                                    @php
                                        $nullTableIdCount = 0;
                                        $notNullTableIdCount = 0;
                                    @endphp

                                    @foreach ($groupedReservations as $key => $reservation)
                                        @php
                                            try {
                                                $time1 = \Carbon\Carbon::createFromFormat('H:i', $timecheck);
                                                $time2 = \Carbon\Carbon::createFromFormat('H:i', $key);
                                                $areTimesSame = $time1->eq($time2);
                                            } catch (\Carbon\Exceptions\InvalidFormatException $e) {
                                                $areTimesSame = false;
                                            }
                                        @endphp

                                        @if ($areTimesSame)
                                            @php
                                                $nullTableIdCount = $reservation['null_tableid_count'];
                                                $notNullTableIdCount = $reservation['not_null_tableid_count'];
                                            @endphp
                                        @endif
                                    @endforeach
                                    <div class="row mt-1">
                                        @if ($nullTableIdCount && $nullTableIdCount)
                                            <div class="col-6"
                                                style="display: flex;align-items: center;justify-content: space-evenly;">

                                                <div class="icontimeslot">
                                                    <img src="{{ URL::to('assets/img/Ellipse_3.png') }}" alt=""
                                                        style="height: 15px;">
                                                </div>
                                                <div class="icontimeslot_size" style="font-size: 15px; color:#288e70">
                                                    {{ $nullTableIdCount }}
                                                </div>

                                            </div>


                                            <div class="col-6"
                                                style="display: flex;align-items: center;justify-content: space-evenly; ">
                                                <div class="icontimeslot">
                                                    <img src="{{ URL::to('assets/img/Ellipse_4.png') }}" alt=""
                                                        style="height: 15px;">
                                                </div>
                                                <div class="icontimeslot_size" style="font-size: 15px ;">
                                                    {{ $notNullTableIdCount }}
                                                </div>


                                            </div>
                                        @else
                                            @if ($nullTableIdCount)
                                                <div class="col-12"
                                                    style="display: flex;align-items: center;justify-content: space-evenly;">

                                                    <div class="icontimeslot">
                                                        <img src="{{ URL::to('assets/img/Ellipse_3.png') }}"
                                                            alt="" style="height: 15px;">
                                                    </div>
                                                    <div class="icontimeslot_size"
                                                        style="font-size: 15px; color:#288e70">
                                                        {{ $nullTableIdCount }}
                                                    </div>

                                                </div>
                                            @endif
                                            @if ($notNullTableIdCount)
                                                <div class="col-12"
                                                    style="display: flex;align-items: center;justify-content: space-evenly; ">
                                                    <div class="icontimeslot">
                                                        <img src="{{ URL::to('assets/img/Ellipse_4.png') }}"
                                                            alt="" style="height: 15px;">
                                                    </div>
                                                    <div class="icontimeslot_size" style="font-size: 15px ;">
                                                        {{ $notNullTableIdCount }}
                                                    </div>


                                                </div>
                                            @endif
                                        @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add a hidden submit button -->

                    </div>
                </div>
            </div>
        @endfor
    </div>
</div> --}}
{{-- 
<div class="list_reservation_table" style="padding: 0px 20px !important">
    <div class="row text-center">
        @for ($i = 0; $i <= 7 * 2 + 1; $i++)
            @php
                $time = \Carbon\Carbon::createFromTime(8, 0)->addMinutes($i * 60);
                $timeStr = $time->format('h:i A'); // 12-hour format
                $buttonId = 'btn-' . $time->format('Hi');
                $timecheck = $time->format('H:i');
            @endphp

            <div class="col-6 col-sm-4 col-md-3 p-1">
                <div class="card time-slot-card" id="{{ $buttonId }}" data-time="{{ $time->format('H:i') }}"
                    style="height: 115px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="time">
                                    <span class="display_time">{{ $time->format('h:i A') }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="booking_header">
                                    BOOKINGS
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="booking_number">
                                    @php
                                        $nullTableIdCount = 0;
                                        $notNullTableIdCount = 0;
                                        $checkedInCount = 0;
                                        $total=0;
                                    @endphp

                                    @foreach ($groupedReservations as $key => $reservation)
                                        @php
                                            try {
                                                $time1 = \Carbon\Carbon::createFromFormat('H:i', $timecheck);
                                                $time2 = \Carbon\Carbon::createFromFormat('H:i', $key);
                                                $areTimesSame = $time1->eq($time2);
                                            } catch (\Carbon\Exceptions\InvalidFormatException $e) {
                                                $areTimesSame = false;
                                            }
                                        @endphp

                                        @if ($areTimesSame)
                                            @php
                                                $nullTableIdCount = $reservation['null_tableid_count'];
                                                $notNullTableIdCount = $reservation['not_null_tableid_reserved_count'];
                                                $checkedInCount = $reservation['checked_in_count'];
                                            @endphp
                                        @endif
                                    @endforeach

                                    <div class="row mt-1">
                                        @if ($nullTableIdCount && $notNullTableIdCount)
                                            <div class="col-3"
                                                style="display: flex;align-items: center;justify-content: space-evenly;">
                                                <div class="icontimeslot">
                                                    <img src="{{ URL::to('assets/img/Ellipse_3.png') }}" alt=""
                                                        style="height: 15px;">
                                                </div>
                                                <div class="icontimeslot_size" style="font-size: 15px; color:#288e70">
                                                    {{ $nullTableIdCount }}
                                                    @php
                                                         $total=+$nullTableIdCount;
                                                    @endphp
                                                </div>
                                            </div>

                                            <div class="col-3"
                                                style="display: flex;align-items: center;justify-content: space-evenly;">
                                                <div class="icontimeslot">
                                                    <img src="{{ URL::to('assets/img/Ellipse_4.png') }}" alt=""
                                                        style="height: 15px;">
                                                </div>
                                                <div class="icontimeslot_size" style="font-size: 15px;">
                                                    {{ $notNullTableIdCount }}
                                                    @php
                                                         $total=+$notNullTableIdCount;
                                                    @endphp
                                                </div>
                                            </div>

                                            <div class="col-3"
                                                style="display: flex;align-items: center;justify-content: space-evenly;">
                                                <div class="icontimeslot">
                                                    <img src="{{ URL::to('assets/img/Ellipse_5.png') }}" alt=""
                                                        style="height: 15px;">
                                                </div>
                                                <div class="icontimeslot_size" style="font-size: 15px;">
                                                    {{ $checkedInCount }}
                                                    @php
                                                    $total=+$checkedInCount;
                                                    @endphp
                                                </div>
                                            </div>
                                            <div class="col-3"
                                                style="display: flex;align-items: center;justify-content: space-evenly;">
                                                <div class="icontimeslot">
                                                    <img src="{{ URL::to('assets/img/Ellipse_5.png') }}" alt=""
                                                        style="height: 15px;">
                                                </div>
                                                <div class="icontimeslot_size" style="font-size: 15px;">
                                                   
                                                    @php
                                                    $total=+$table_count;
                                                    @endphp
                                                    {{  $total}}
                                                </div>
                                            </div>

                                        @else
                                            @if ($nullTableIdCount)
                                                <div class="col-12"
                                                    style="display: flex;align-items: center;justify-content: space-evenly;">
                                                    <div class="icontimeslot">
                                                        <img src="{{ URL::to('assets/img/Ellipse_3.png') }}"
                                                            alt="" style="height: 15px;">
                                                    </div>
                                                    <div class="icontimeslot_size"
                                                        style="font-size: 15px; color:#288e70">
                                                        {{ $nullTableIdCount }}
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($notNullTableIdCount)
                                                <div class="col-12"
                                                    style="display: flex;align-items: center;justify-content: space-evenly;">
                                                    <div class="icontimeslot">
                                                        <img src="{{ URL::to('assets/img/Ellipse_4.png') }}"
                                                            alt="" style="height: 15px;">
                                                    </div>
                                                    <div class="icontimeslot_size" style="font-size: 15px;">
                                                        {{ $notNullTableIdCount }}
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($checkedInCount)
                                                <div class="col-12"
                                                    style="display: flex;align-items: center;justify-content: space-evenly;">
                                                    <div class="icontimeslot">
                                                        <img src="{{ URL::to('assets/img/Ellipse_5.png') }}"
                                                            alt="" style="height: 15px;">
                                                    </div>
                                                    <div class="icontimeslot_size" style="font-size: 15px;">
                                                        {{ $checkedInCount }}
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div> --}}

<div class="list_reservation_table" style="padding: 0px 20px !important">
    <div class="row text-center">
        @for ($i = 0; $i <= 7 * 2 + 1; $i++)
            @php
                $time = \Carbon\Carbon::createFromTime(8, 0)->addMinutes($i * 60);
                $timeStr = $time->format('h:i A'); // 12-hour format
                $buttonId = 'btn-' . $time->format('Hi');
                $timecheck = $time->format('H:i');
                $nullTableIdCount = 0;
                $notNullTableIdCount = 0;
                $checkedInCount = 0;

                // Retrieve counts from grouped reservations
                foreach ($groupedReservations as $key => $reservation) {
                    $areTimesSame = $timecheck === $key;

                    if ($areTimesSame) {
                        $nullTableIdCount = $reservation['null_tableid_count'];
                        $notNullTableIdCount = $reservation['not_null_tableid_reserved_count'];
                        $checkedInCount = $reservation['checked_in_count'];
                        break; // Exit loop once matching time is found
                    }
                }
            @endphp

            <div class="col-6 col-sm-4 col-md-3 p-1">
                <div class="card time-slot-card" id="{{ $buttonId }}" data-time="{{ $time->format('H:i') }}"
                    style="height: 120px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="time">
                                    <span class="display_time">{{ $time->format('h:i A') }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="booking_header">BOOKINGS</div>
                            </div>
                            <div class="col-12">
                                <div class="booking_number">
                                    <div class="row mt-1 "style="display: flex;justify-content: space-evenly;">
                                        @if ($nullTableIdCount || $notNullTableIdCount || $checkedInCount)
                                            @php
                                                $total = $notNullTableIdCount + $checkedInCount;
                                                $total = $table_count - $total;
                                            @endphp

                                            @foreach ([['count' => $nullTableIdCount, 'color' => '#585f9c', 'icon' => 'blue.png', 'tooltip' => 'Un Booked Table'], ['count' => $notNullTableIdCount, 'color' => '#d44a47', 'icon' => 'red.png', 'tooltip' => 'Booked Table'], 
                                            //['count' => $checkedInCount, 'color' => '#288e70', 'icon' => 'green.png', 'tooltip' => 'Checked In Table']
                                            ] as $data)
                                                @if ($data['count'])
                                                    <div class="col-6 mt-1"
                                                        style="display: flex; align-items: center; justify-content: space-evenly;"
                                                        data-bs-toggle="tooltip" title="{{ $data['tooltip'] }}"
                                                        class="custom-tooltip">
                                                        <div class="icontimeslot">
                                                            <img src="{{ URL::to('assets/img/' . $data['icon']) }}"
                                                                alt="" style="height: 20px;">
                                                        </div>

                                                        <div class="icontimeslot_size"
                                                            style="font-size: 15px; color: {{ $data['color'] }};margin-top:3px">
                                                            {{ $data['count'] }}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>


<div class="row">
    <div class="col-12">
        <button type="submit" id="new_resn_btn" class="btn btn-primary mt-3 submit-btn"
            style="display: none;
            flex-direction: row-reverse">Added New Reservation</button>
    </div>

</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                customClass: 'custom-tooltip'
            });
        });
    });
</script>
