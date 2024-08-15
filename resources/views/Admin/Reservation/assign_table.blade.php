@extends('Admin.layout.index')

@Section('content')
    <section id="assigntable" class="asigntable">

        <div class="container">
            <div class="row ">
                <div class="col-12">
                    <h4>ASSIGN TABLE</h4>
                </div>
                <div class="col-12">

                    <div class="assign-header-details">
                        <div class="row">
                            <div class="col-5">

                                <div class="assign-box-icons">
                                    <i class="bi bi-person-vcard"></i>
                                </div>

                                <div class="assign-box-details">
                                    <div class="list-box-details-name">
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
                            <div class="col-3">

                                <div class="assign-box-number">

                                    <div class="assign-box-number-icon">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                            style="
                                            margin-top: 10px;
                                            height: 20px; fill=white;
                                        "><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
                                        </svg>
                                    </div>
                                    <div class="assign-box-number-count">
                                        <p>3</p>
                                    </div>


                                </div>

                            </div>
                            <div class="col-4">
                                <div class="assign-box-date">
                                    <h3>06:00 PM</h3>
                                    <h6>Tuesday</h6>
                                    <h3>JULY 09,2024

                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="table_list_box ">
                        <div class="table_list_box_body">
                            <div class="row" style="display: flex;align-items: center;align-content: center;">
                                <div class="col-5" style="display: flex;padding: 20px 20px;align-items: center;">

                                    <div class="list-box-icons">
                                        <i class="bi bi-person-vcard"></i>
                                    </div>

                                    <div class="list-box-details">
                                        <div class="list-box-details-name">
                                            <span>
                                                {{-- {{ ucwords($table_list_null->customer_name) }}  --}}
                                                ASDDD</span>
                                        </div>
                                        <div class="list-box-details-number">

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
                                        <div class="list-box-details-email">
                                            <span>Asd@gmail.com<span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-2">
                                    <div class="list-box-number">

                                        <div class="list-box-number-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                                style="
                                                margin-top: 10px;
                                                height: 20px;
                                            "><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
                                            </svg>
                                        </div>
                                        <div class="list-box-number-count">
                                            <p>3</p>
                                        </div>


                                    </div>


                                </div>
                                <div class="col-5">
                                    <div class="list-box-table">
                                        <div class="list-box-table-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px"
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
                                        <div id="list-box-table-button" class="list-box-table-button">
                                            <button type="button" class="btn btn-outline-secondary"> <svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                    style="height: 25px;
                                                    fill: #5d7afe;"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                    <path
                                                        d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z" />
                                                </svg> ASSIGN
                                                TABLE
                                            </button>
                                        </div>


                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12">

                </div>
            </div>

        </div>





    </section>
@endSection
