@extends('Admin.layout.index')

@Section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .Date_display {
            width: 60%;
        }

        .Date_display .card-body {
            background-color: black;
            border: 1px solid white;
            border-radius: 0px !important;

        }

        .Date_display .card {
            background-color: black;
            border: 1px solid white;
            border-radius: 0px !important;


        }

        svg.bi.bi-calendar4-week {
            color: #cb982b;
        }

        .list_reservation_table {
            padding: 20px 20px 20px 20px;
        }

        .time {
            margin-bottom: 5px;
        }




        span.display_time {
            font-size: 18px;

            font-weight: 700;
        }

        .booking_header {
            font-size: 13px;
            font-weight: 500;
            color: #bfc8c3;
        }

        .booking_number {
            font-weight: 800;
            font-size: 19px;
            color: #df282e;
        }

        .listofreservation {
            /* padding: 27px; */
            margin-top: 50px;
        }

        .list_reservation_table_details {
            padding: 20px 0px;
        }


        .list_reservation_table_details .card {
            border-radus: 0px;
            border: 1px solid white;
            border-radius: 0px !important;

        }

        .list_reservation_table_details .card-body {
            border-radus: 0px;
            border: 1px solid white;
            border-radius: 0px !important;
            height: 800px;
        }


        @media (max-width: 1200px) {
            span.display_time {
                font-size: 15px;

                font-weight: 700;

            }

            .booking_header {
                font-size: 13px;
                font-weight: 500;
                color: #bfc8c3;
            }

            .booking_number {
                font-weight: 800;
                font-size: 19px;
                color: #df282e;
            }
        }

        .time-slot-card.active {
            background-color: #cb982b;
            color: #f4d917;
        }

        .time-slot-card.clicked {
            background-color: #cb982b;
            color: #f4d917;
        }

        #list_table .card {
            border: 1px solid red;
            border-radius: 0px !important;
            height: 0px;

        }

        .list-box-number {
            Display: flex;
            justify-content: space-evenly;

        }

        .list-box-table-icon svg {
            height: 60px;
            color: #585f9c;
        }

        .list-box-table {
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .list-box-icons {
            display: flex;
            align-items: center;
            justify-content: space-around;
            align-content: space-around;
        }

        .table_list_box {
            --bs-card-spacer-y: 1rem;
            --bs-card-spacer-x: 1rem;
            --bs-card-title-spacer-y: 0.5rem;
            --bs-card-title-color: ;
            --bs-card-subtitle-color: ;
            --bs-card-border-width: var(--bs-border-width);

            --bs-card-box-shadow: ;
            --bs-card-inner-border-radius: calc(var(--bs-border-radius) -(var(--bs-border-width)));
            --bs-card-cap-padding-y: 0.5rem;
            --bs-card-cap-padding-x: 1rem;
            --bs-card-cap-bg: rgba(var(--bs-body-color-rgb), 0.03);
            --bs-card-cap-color: ;
            --bs-card-height: ;
            --bs-card-color: ;
            --bs-card-bg: var(--bs-body-bg);
            --bs-card-img-overlay-padding: 1rem;
            --bs-card-group-margin: 0.75rem;
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            height: var(--bs-card-height);
            color: var(--bs-body-color);
            word-wrap: break-word;
            background-color: var(--bs-card-bg);
            background-clip: border-box;
            border: 2px solid var(--bs-card-border-color);
            border-radius: 0px !important;
            --bs-card-border-color: #585f9c;
        }

        .table_list_box_body {
            flex: 1 1 auto;
            padding: 5px 5px;
            color: var(--bs-card-color);
        }

        .list-box-details-email {
            font-size: 12px;
            font-weight: 400;
        }

        .list-box-details-number {
            font-size: 16px;
            font-weight: 700;
        }

        .list-box-details-name {
            font-size: 12px;
            font-weight: 500;
        }

        i.bi.bi-person-vcard {
            font-size: 25px;
            color: #233c5e;
        }

        .list-box-number-count {
            margin-top: 7px;
            display: flex;
            align-items: center;
            font-size: 15px;
            font-weight: 700;
        }

        .list-box-table-button button.btn.btn-outline-secondary {
            border: 2px solid #0d6efdad;
            border-radius: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 5px;
        }
    </style>

    <section id="List" class="List section">

        <div class="container">
            <div class="row ">
                <div class="col-md-12 col-lg-6">
                    <div class="row  ">

                        <div class="col-12">

                            <div class="Date_display">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row g-x-5">
                                            <div class="col-9">
                                                <div class="row">
                                                    <div class="col-12 col-sm-12  mb-1">
                                                        <div class="date_header">
                                                            <h6 class="mb-0">TUESDAY</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12">

                                                        <div class="date_date">
                                                            <h5 class="mb-0">JULY 09, 2024</h5>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="input-group date" id="datepicker">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                                        fill="currentColor" class="bi bi-calendar4-week"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                                                        <path
                                                            d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-2 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                                                    </svg>

                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="col-12 ">
                            <div class="list_reservation_table">

                                <div class="row text-center">
                                    @for ($i = 0; $i <= 7 * 2 + 1; $i++)
                                        @php
                                            $time = \Carbon\Carbon::createFromTime(8, 0)->addMinutes($i * 60);
                                            $timeStr = $time->format('H:i');
                                            $buttonId = 'btn-' . $time->format('Hi');
                                        @endphp

                                        <div class="col-6 col-sm-4 col-md-3 p-1">
                                            <div class="card time-slot-card" id="{{ $buttonId }}"
                                                data-time="{{ $time->format('H:i') }}">
                                                <div class="card-body">
                                                    <div class="time">
                                                        <span class="display_time">{{ $time->format('h:i A') }}</span>
                                                    </div>
                                                    <div class="booking_header">
                                                        BOOKINGS
                                                    </div>
                                                    <div class="booking_number">
                                                        2
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="row  ">

                        <div class="col-12">
                            <div class="listofreservation">
                                <h4>LIST OF ONLINE RESERVATIONS</h4>
                            </div>


                        </div>
                        <div class="col-12">
                            <div class="list_reservation_table_details">


                                {{-- <div class="table-container">
                                    <div class="table-row">
                                        <div class="table-data">
                                            <span><i class="bi bi-person-fill"></i></span>
                                            <span>Christopher</span>
                                            <span>052-254-8877</span>
                                            <span>chris@gmail.com</span>
                                        </div>
                                        <div class="table-data">
                                            <span><i class="bi bi-people-fill"></i></span>
                                            <span>2</span>
                                        </div>
                                        <div class="table-actions">
                                            <span><i class="bi bi-table"></i></span>
                                            <button class="assign-table">Assign Table</button>
                                        </div>
                                    </div>
                                    <div class="table-row">
                                        <div class="table-data">
                                            <span><i class="bi bi-person-fill"></i></span>
                                            <span>Laura</span>
                                            <span>052-222-4477</span>
                                            <span>laura@gmail.com</span>
                                        </div>
                                        <div class="table-data">
                                            <span><i class="bi bi-people-fill"></i></span>
                                            <span>2</span>
                                        </div>
                                        <div class="table-actions">
                                            <span><i class="bi bi-table"></i></span>
                                            <span>Table 1</span>
                                            <button class="edit-table"><i class="bi bi-pencil-fill"></i></button>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row gap-2 ">

                                            <div class="col-12">

                                                <div class="table_list_box ">
                                                    <div class="table_list_box_body">
                                                        <div class="row"
                                                            style="
                                                        display: flex;
                                                        align-items: center;
                                                        align-content: center;
                                                    ">
                                                            <div class="col-5"
                                                                style="
                                                            display: flex;
                                                            justify-content: space-evenly;
                                                            align-items: center;
                                                        ">

                                                                <div class="list-box-icons">
                                                                    <i class="bi bi-person-vcard"></i>
                                                                </div>

                                                                <div class="list-box-details">
                                                                    <div class="list-box-details-name">
                                                                        <span>ASD</span>
                                                                    </div>
                                                                    <div class="list-box-details-number">
                                                                        <span>142536984</span>
                                                                    </div>
                                                                    <div class="list-box-details-email">
                                                                        <span>142536984<span>
                                                                    </div>




                                                                </div>

                                                            </div>
                                                            <div class="col-2">
                                                                <div class="list-box-number">

                                                                    <div class="list-box-number-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 640 512"
                                                                            style="
                                                                            margin-top: 10px;
                                                                            height: 20px;
                                                                        "><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                            <path
                                                                                d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
                                                                        </svg>
                                                                    </div>
                                                                    <div class="list-box-number-count">
                                                                        <p>2</p>
                                                                    </div>


                                                                </div>


                                                            </div>
                                                            <div class="col-5">
                                                                <div class="list-box-table">
                                                                    <div class="list-box-table-icon">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            version="1.1" x="0px" y="0px"
                                                                            viewBox="0 0 100 125"
                                                                            style="height: 65px;enable-background:new 0 0 100 100;"
                                                                            xml:space="preserve">
                                                                            <circle cx="28.1" cy="40.9" r="3" />
                                                                            <g>
                                                                                <path
                                                                                    d="M40.8,65.1c-0.3-0.5-0.8-0.7-1.3-0.7c-0.5,0-1,0-1.6,0c0-0.2,0-0.3,0-0.4c0-2.9-0.1-5.5-0.1-8.4c0-0.4-0.2-0.7-0.5-1   c-0.1,0-0.1-0.1-0.2-0.1c-0.2-0.1-0.3-0.1-0.3-0.1l0,0c0,0-0.1,0-0.1,0c-1,0-2,0-3,0c-1,0-1.9,0-2.9,0c-0.3,0-0.3-0.1-0.3-0.3   c0-0.4,0-0.8,0-1.1c0,0,0-0.1,0-0.1c0-0.3,0.1-0.4,0.4-0.4c1.6,0,3.3,0,4.9,0c0.1,0,0.2,0,0.4,0c0.4,0,0.7-0.1,0.9-0.4   c0.3-0.3,0.3-0.7,0.2-1.1c-0.2-0.4-0.6-0.6-1-0.6c-1.6,0-3.2,0-4.8,0c-0.2,0-0.4,0-0.5,0c-0.3,0-0.4,0-0.4-0.2c0-0.1,0-0.1,0-0.2   c0-0.9,0-1.8,0-2.6c0-1.4-1.1-2.5-2.5-2.5c-1.4,0-2.5,1.1-2.5,2.6c0,1,0,2.1,0,3.1c0,1,0,2,0,3c0,0.9,0,1.7,0,2.6   c0,1.3,0.9,2.3,2.2,2.5c0.4,0.1,0.9,0,1.3,0h5.8c0,1.4,0,2.8,0,4.1c0,0.7,0,1.4,0,2.2c0,0.4,0,0.7,0,1.1c0,0.5,0.4,0.9,0.9,0.9   c1.4,0,2.9,0,4.3,0C40.7,66.8,41.2,65.8,40.8,65.1z" />
                                                                            </g>
                                                                            <path
                                                                                d="M30.5,59.6h-6.3V49.4c0-0.8-0.7-1.5-1.5-1.5s-1.5,0.7-1.5,1.5v11.2v0.4v5.1c0,0.8,0.7,1.5,1.5,1.5s1.5-0.7,1.5-1.5v-3.6H29  v3.6c0,0.8,0.7,1.5,1.5,1.5s1.5-0.7,1.5-1.5v-5.1C32,60.2,31.3,59.6,30.5,59.6z" />
                                                                            <circle cx="73.3" cy="40.9" r="3" />
                                                                            <g>
                                                                                <path
                                                                                    d="M60.6,65.1c0.3-0.5,0.8-0.7,1.3-0.7c0.5,0,1,0,1.6,0c0-0.2,0-0.3,0-0.4c0-2.9,0.1-5.5,0.1-8.4c0-0.4,0.2-0.7,0.5-1   c0.1,0,0.1-0.1,0.2-0.1c0.2-0.1,0.3-0.1,0.3-0.1l0,0c0,0,0.1,0,0.1,0c1,0,2,0,3,0c1,0,1.9,0,2.9,0c0.3,0,0.3-0.1,0.3-0.3   c0-0.4,0-0.8,0-1.1c0,0,0-0.1,0-0.1c0-0.3-0.1-0.4-0.4-0.4c-1.6,0-3.3,0-4.9,0c-0.1,0-0.2,0-0.4,0c-0.4,0-0.7-0.1-0.9-0.4   c-0.3-0.3-0.3-0.7-0.2-1.1c0.2-0.4,0.6-0.6,1-0.6c1.6,0,3.2,0,4.8,0c0.2,0,0.4,0,0.5,0c0.3,0,0.4,0,0.4-0.2c0-0.1,0-0.1,0-0.2   c0-0.9,0-1.8,0-2.6c0-1.4,1.1-2.5,2.5-2.5c1.4,0,2.5,1.1,2.5,2.6c0,1,0,2.1,0,3.1c0,1,0,2,0,3c0,0.9,0,1.7,0,2.6   c0,1.3-0.9,2.3-2.2,2.5c-0.4,0.1-0.9,0-1.3,0h-5.8c0,1.4,0,2.8,0,4.1c0,0.7,0,1.4,0,2.2c0,0.4,0,0.7,0,1.1c0,0.5-0.4,0.9-0.9,0.9   c-1.4,0-2.9,0-4.3,0C60.7,66.8,60.2,65.8,60.6,65.1z" />
                                                                            </g>
                                                                            <path
                                                                                d="M70.9,59.6h6.3V49.4c0-0.8,0.7-1.5,1.5-1.5s1.5,0.7,1.5,1.5v11.2v0.4v5.1c0,0.8-0.7,1.5-1.5,1.5s-1.5-0.7-1.5-1.5v-3.6h-4.8  v3.6c0,0.8-0.7,1.5-1.5,1.5s-1.5-0.7-1.5-1.5v-5.1C69.4,60.2,70.1,59.6,70.9,59.6z" />
                                                                            <path
                                                                                d="M60.5,52.3v-1.6c0-0.4-0.3-0.7-0.7-0.7h-18c-0.4,0-0.7,0.3-0.7,0.7v1.6c0,0.4,0.3,0.7,0.7,0.7h7.5v11.3l-3,1  c-0.3,0-0.5,0.2-0.5,0.5v0.5c0,0.3,0.2,0.5,0.5,0.5h9c0.3,0,0.5-0.2,0.5-0.5v-0.5c0-0.3-0.2-0.5-0.5-0.5l-3-1V53h7.5  C60.2,53,60.5,52.7,60.5,52.3z" />

                                                                        </svg>
                                                                    </div>
                                                                    <div class="list-box-table-button">
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary"> <svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 512 512"
                                                                                style="height: 25px;
                                                                                fill: #5d7afe;"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                                <path
                                                                                    d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z" />
                                                                            </svg> ASSIGN
                                                                            TABLE</button>
                                                                    </div>


                                                                </div>

                                                            </div>


                                                        </div>

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-12">
                                                <div class="list_table" id="list_table">


                                                </div>
                                            </div>


                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>





    </section>
    <!-- jQuery -->
    {{-- <!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap Datepicker CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

<!-- Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


<script>
    $(document).ready(function(){
    $('#datepicker').datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true
    });

    // Optional: If you want the datepicker to open when clicking the calendar icon
    $('.input-group-append').click(function(){
        $('#datepicker').datepicker('show');
    });

});
$('#datepicker').on('changeDate', function() {
    var selectedDate = $(this).datepicker('getFormattedDate');
    // Do something with the selected date
    console.log("Selected Date: " + selectedDate);
});

</script> --}}



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the current time and round it to the nearest hour
            let currentTime = new Date();
            if (currentTime.getMinutes() >= 30) {
                currentTime.setHours(currentTime.getHours() + 1);
            }
            currentTime.setMinutes(0, 0, 0);

            // Format the current time as HH:mm for comparison
            const roundedTimeStr = currentTime.toTimeString().substring(0, 5);
            let activeCard = null;

            // Add the 'active' class to the matching time slot
            document.querySelectorAll('.time-slot-card').forEach(function(card) {
                const slotTime = card.getAttribute('data-time');

                if (roundedTimeStr === slotTime) {
                    card.classList.add('active');
                    activeCard = card; // Store the active card
                }

                // Add click event listener to each card
                card.addEventListener('click', function() {
                    // Remove the 'active' class from the current time slot
                    if (activeCard) {
                        activeCard.classList.remove('active');
                        activeCard = null;
                    }

                    // Toggle color change by adding/removing classes
                    if (card.classList.contains('clicked')) {
                        card.classList.remove('clicked');
                    } else {
                        // Remove 'clicked' class from all cards to ensure only one is active at a time
                        document.querySelectorAll('.time-slot-card').forEach(function(c) {
                            c.classList.remove('clicked');
                        });
                        card.classList.add('clicked');

                        // Convert the selected time to 12-hour format
                        let selectedTime = card.getAttribute('data-time');
                        let [hour, minute] = selectedTime.split(':');
                        let ampm = hour >= 12 ? 'PM' : 'AM';
                        hour = hour % 12 || 12;
                        let formattedTime = hour + ':' + minute + ' ' + ampm;

                        // Show an alert with the selected time in 12-hour format
                        alert('Selected time: ' + formattedTime);
                    }
                });
            });
        });
    </script>
    <style>

    </style>
@endSection
