@extends('Admin.layout.index')

@Section('content')
    <style>
        .assigntable .assign-box-icons {
            font-size: 24px;
            font-weight: 700;
            padding: 20px;
        }

        .assigntable .assign-box-details-name {
            font-size: 18px;
            font-weight: 600;
        }

        .assigntable .assign-box-details-number {
            font-size: 24px;
            font-weight: 700;
        }

        .assigntable i.bi.bi-person-vcard {
            font-size: 40px;
            color: #233c5e;
        }

        .assigntable .assign-box-number {
            display: flex;
            align-items: center;

        }



        .assigntable .assign-box-number-count {
            margin-top: 5px;
        }

        .assigntable .assign-box-date {
            padding: 0px 20px;
        }

        .assigntable .assign-box-date-time {
            font-weight: 700;
            font-size: 20px;
        }

        .assigntable .assign-box-date-month {
            font-weight: 700;
            font-size: 20px;
        }

        .progress {
            height: 0.2rem;
        }
    </style>
    <section id="assigntable" class="assigntable">

        <div class="container">
            <div class="row ">
                <div class="col-12">
                    <h4>ASSIGN TABLE</h4>
                </div>
                <div class="col-12">

                    <div class="assign-header-details">
                        <div class="row">
                            <div class="col-5"
                                style="
                            display: flex;
                            align-items: center;
                            justify-content: flex-start;
                            align-content: center;
                        ">

                                <div class="assign-box-icons">
                                    <i class="bi bi-person-vcard"></i>
                                </div>

                                <div class="assign-box-details">
                                    <div class="assign-box-details-name">
                                        <span>
                                            {{-- {{ ucwords($table_list_null->customer_name) }}  --}}
                                            ASDDD</span>
                                    </div>
                                    <div class="assign-box-details-number">

                                        {{-- @php

                                            $formattedMobileNo =
                                                substr(
                                                    $table_list_null->mobile_no,
                                                    0,
                                                    3,
                                                ) .
                                                '-' .
                                                substr(
                                                    $table_list_null->mobile_no,
                                                    3,
                                                    3,
                                                ) .
                                                '-' .
                                                substr(
                                                    $table_list_null->mobile_no,
                                                    6,
                                                );
                                        @endphp --}}

                                        <span>14785695396</span>

                                        {{-- <span>{{ $table_list_null->mobile_no }}</span> --}}
                                    </div>
                                    <div class="assign-box-details-email">
                                        <span>Asd@gmail.com<span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-3"
                                style="
                            display: flex;
                            align-items: center;
                        ">

                                <div class="assign-box-number">

                                    <div class="assign-box-number-icon" style="  padding: 0px 20px 0px 0px;">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="40"
                                            height="40"
                                            style="
                                        margin-top: 10px;
                                        stroke-width: 40px;
                                        stroke: #678fd1;
                                        fill: #000;
                                        ">
                                            <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
                                        </svg>

                                    </div>
                                    <div class="assign-box-number-count">
                                        <span>3<span>
                                    </div>


                                </div>

                            </div>
                            <div class="col-4"
                                style="
                            display: flex;
                            align-items: center;
                            justify-content: flex-end;
                            padding: 0px 30px 0px 0px;
                            ">
                                <div class="assign-box-date">

                                    <div class="assign-box-date-time">
                                        <span>
                                            06:00 PM</span>
                                    </div>
                                    <div class="assign-box-date-day">
                                        <span>

                                            Tuesday</span>
                                    </div>
                                    <div class="assign-box-date-month">
                                        <span>
                                            JULY 09,2024</span>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12 mt-3">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                </div>
                <div class="col-12">

                </div>



            </div>

        </div>





    </section>
@endSection
