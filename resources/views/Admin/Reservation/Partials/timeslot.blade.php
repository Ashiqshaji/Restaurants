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
                                                    <img src="{{ URL::to('assets/img/Ellipse_1.png') }}" alt=""
                                                        style="height: 15px;">
                                                </div>
                                                <div class="icontimeslot_size" style="font-size: 15px; color:#288e70">
                                                    {{ $nullTableIdCount }}
                                                </div>

                                            </div>


                                            <div class="col-6"
                                                style="display: flex;align-items: center;justify-content: space-evenly; ">
                                                <div class="icontimeslot">
                                                    <img src="{{ URL::to('assets/img/Ellipse_2.png') }}" alt=""
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
                                                        <img src="{{ URL::to('assets/img/Ellipse_1.png') }}"
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
                                                        <img src="{{ URL::to('assets/img/Ellipse_2.png') }}"
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
</div>

<div class="row">
    <div class="col-12">
        <button type="submit" id="new_resn_btn" class="btn btn-primary mt-3 submit-btn"
            style="display: none;
            flex-direction: row-reverse">Added New Reservation</button>
    </div>

</div>
