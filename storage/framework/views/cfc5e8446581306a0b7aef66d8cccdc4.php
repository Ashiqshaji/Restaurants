<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                                        <?php
                                            use Carbon\Carbon;
                                            $currentDateTime = Carbon::now();
                                        ?>

                                        <div class="row g-x-5">
                                            <div class="col-9">
                                                <div class="row">
                                                    <div class="col-12 col-sm-12  mb-1">
                                                        <div class="date_header">
                                                            <h6 class="mb-0"> <?php echo e($date->format('l')); ?></h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12">

                                                        <input type="hidden" id='page_date' name="page_date"
                                                            value=<?php echo e($date->format('d-m-Y')); ?>>
                                                        <div class="date_date">
                                                            <h5 class="mb-0"><?php echo e($date->format('M d, Y')); ?></h5>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="input-group date" id="datePicker">

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
                        <div class="col-12">
                            

                            <div class="list_reservation_table" style="padding: 20px 20px !important">
                                <div class="row text-center">
                                    <?php for($i = 0; $i <= 7 * 2 + 1; $i++): ?>
                                        <?php
                                            $time = \Carbon\Carbon::createFromTime(8, 0)->addMinutes($i * 60);
                                            $timeStr = $time->format('h:i A'); // 12-hour format
                                            $buttonId = 'btn-' . $time->format('Hi');
                                            $timecheck = $time->format('H:i');
                                        ?>

                                        <div class="col-6 col-sm-4 col-md-3 p-1">
                                            <div class="card time-slot-card" id="<?php echo e($buttonId); ?>"
                                                data-time="<?php echo e($time->format('H:i')); ?>"
                                                style="
                                                height: 115px;
                                            ">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="time">
                                                                <span
                                                                    class="display_time"><?php echo e($time->format('h:i A')); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="booking_header">
                                                                BOOKINGS
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="booking_number">
                                                                <?php
                                                                    $nullTableIdCount = 0;
                                                                    $notNullTableIdCount = 0;
                                                                ?>

                                                                <?php $__currentLoopData = $groupedReservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        try {
                                                                            $time1 = \Carbon\Carbon::createFromFormat(
                                                                                'H:i',
                                                                                $timecheck,
                                                                            );
                                                                            $time2 = \Carbon\Carbon::createFromFormat(
                                                                                'H:i',
                                                                                $key,
                                                                            );
                                                                            $areTimesSame = $time1->eq($time2);
                                                                        } catch (\Carbon\Exceptions\InvalidFormatException $e) {
                                                                            $areTimesSame = false;
                                                                        }
                                                                    ?>

                                                                    <?php if($areTimesSame): ?>
                                                                        <?php
                                                                            $nullTableIdCount =
                                                                                $reservation['null_tableid_count'];
                                                                            $notNullTableIdCount =
                                                                                $reservation['not_null_tableid_count'];
                                                                        ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="row mt-1">
                                                                    <?php if($nullTableIdCount && $nullTableIdCount): ?>
                                                                        <div class="col-6"
                                                                            style="display: flex;align-items: center;justify-content: space-evenly;"
                                                                            data-bs-toggle="tooltip" title="Un Booked Table"
                                                                            class="custom-tooltip">

                                                                            <div class="icontimeslot">
                                                                                <img src="<?php echo e(URL::to('assets/img/Ellipse_3.png')); ?>"
                                                                                    alt="" style="height: 15px;">
                                                                            </div>
                                                                            <div class="icontimeslot_size"
                                                                                style="font-size: 15px; color:#288e70">
                                                                                <?php echo e($nullTableIdCount); ?>

                                                                            </div>

                                                                        </div>


                                                                        <div class="col-6"
                                                                            style="display: flex;align-items: center;justify-content: space-evenly; "
                                                                            data-bs-toggle="tooltip" title="Booked Table"
                                                                            class="custom-tooltip">
                                                                            <div class="icontimeslot">
                                                                                <img src="<?php echo e(URL::to('assets/img/Ellipse_4.png')); ?>"
                                                                                    alt="" style="height: 15px;">
                                                                            </div>
                                                                            <div class="icontimeslot_size"
                                                                                style="font-size: 15px ;">
                                                                                <?php echo e($notNullTableIdCount); ?>

                                                                            </div>


                                                                        </div>
                                                                    <?php else: ?>
                                                                        <?php if($nullTableIdCount): ?>
                                                                            <div class="col-12"
                                                                                style="display: flex;align-items: center;justify-content: space-evenly;"
                                                                                data-bs-toggle="tooltip"
                                                                                title="Un Booked Table"
                                                                                class="custom-tooltip">

                                                                                <div class="icontimeslot">
                                                                                    <img src="<?php echo e(URL::to('assets/img/Ellipse_3.png')); ?>"
                                                                                        alt=""
                                                                                        style="height: 15px;">
                                                                                </div>
                                                                                <div class="icontimeslot_size"
                                                                                    style="font-size: 15px; color:#288e70">
                                                                                    <?php echo e($nullTableIdCount); ?>

                                                                                </div>

                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <?php if($notNullTableIdCount): ?>
                                                                            <div class="col-12"
                                                                                style="display: flex;align-items: center;justify-content: space-evenly; "
                                                                                data-bs-toggle="tooltip"
                                                                                title="Booked Table" class="custom-tooltip">
                                                                                <div class="icontimeslot">
                                                                                    <img src="<?php echo e(URL::to('assets/img/Ellipse_4.png')); ?>"
                                                                                        alt=""
                                                                                        style="height: 15px;">
                                                                                </div>
                                                                                <div class="icontimeslot_size"
                                                                                    style="font-size: 15px ;">
                                                                                    <?php echo e($notNullTableIdCount); ?>

                                                                                </div>


                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Add a hidden submit button -->

                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="row  ">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-10">
                                    <div class="listofreservation">
                                        <h4>LIST OF ONLINE RESERVATIONS</h4>
                                    </div>
                                </div>
                                <div class="col-2"
                                    style="display: flex; flex-direction: row-reverse;     margin-top: -7px; ">
                                    <div class="listofreservation">
                                        <a href="<?php echo e(route('admin.addreservation')); ?>">
                                            <i class="bi bi-plus-square" data-bs-toggle="tooltip"
                                                title="Add New Rerservation" class="custom-tooltip"></i>


                                        </a>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="col-12">
                            <div class="row ">
                                <div class="col-12"
                                    style="
                                display: flex;
                                flex-direction: row-reverse;
                            ">
                                    <div class="search_mobile">
                                        <input type="text" class="form-control <?php $__errorArgs = ['Mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="inputMobile" placeholder="Mobile or Name" name="Mobile"
                                            value="<?php echo e(old('Mobile')); ?>">
                                    </div>

                                </div>



                            </div>
                        </div>
                        <div class="col-12">
                            <div class="list_reservation_table_details">


                                


                                




                                <div id="list_date_reservation" class="card">
                                    <div class="card-body" style="overflow: auto;">

                                        <div id="preloader1" style="display: none;">
                                            <div class="spinner-border" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        <div class="row gap-2 ">



                                            <?php $__currentLoopData = $isNulltable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table_list_null): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-12">

                                                    <div class="table_list_box ">
                                                        <div class="table_list_box_body">
                                                            <div class="row"
                                                                style="display: flex;align-items: center;align-content: center;">
                                                                <div class="col-5"
                                                                    style="display: flex;padding: 20px 20px;align-items: center;">

                                                                    <div class="list-box-icons">
                                                                        <i class="bi bi-person-vcard"></i>
                                                                    </div>

                                                                    <div class="list-box-details">
                                                                        <div class="list-box-details-name">
                                                                            <span><?php echo e(ucwords($table_list_null->customer_name)); ?></span>
                                                                        </div>
                                                                        <div class="list-box-details-number">

                                                                            <?php

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
                                                                            ?>

                                                                            <span><?php echo e($formattedMobileNo); ?></span>

                                                                            
                                                                        </div>
                                                                        <div class="list-box-details-email">
                                                                            <span><?php echo e($table_list_null->email); ?><span>
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
                                                                            <p><?php echo e($table_list_null->no_of_people); ?></p>
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
                                                                                <circle cx="28.1" cy="40.9"
                                                                                    r="3" />
                                                                                <g>
                                                                                    <path
                                                                                        d="M40.8,65.1c-0.3-0.5-0.8-0.7-1.3-0.7c-0.5,0-1,0-1.6,0c0-0.2,0-0.3,0-0.4c0-2.9-0.1-5.5-0.1-8.4c0-0.4-0.2-0.7-0.5-1   c-0.1,0-0.1-0.1-0.2-0.1c-0.2-0.1-0.3-0.1-0.3-0.1l0,0c0,0-0.1,0-0.1,0c-1,0-2,0-3,0c-1,0-1.9,0-2.9,0c-0.3,0-0.3-0.1-0.3-0.3   c0-0.4,0-0.8,0-1.1c0,0,0-0.1,0-0.1c0-0.3,0.1-0.4,0.4-0.4c1.6,0,3.3,0,4.9,0c0.1,0,0.2,0,0.4,0c0.4,0,0.7-0.1,0.9-0.4   c0.3-0.3,0.3-0.7,0.2-1.1c-0.2-0.4-0.6-0.6-1-0.6c-1.6,0-3.2,0-4.8,0c-0.2,0-0.4,0-0.5,0c-0.3,0-0.4,0-0.4-0.2c0-0.1,0-0.1,0-0.2   c0-0.9,0-1.8,0-2.6c0-1.4-1.1-2.5-2.5-2.5c-1.4,0-2.5,1.1-2.5,2.6c0,1,0,2.1,0,3.1c0,1,0,2,0,3c0,0.9,0,1.7,0,2.6   c0,1.3,0.9,2.3,2.2,2.5c0.4,0.1,0.9,0,1.3,0h5.8c0,1.4,0,2.8,0,4.1c0,0.7,0,1.4,0,2.2c0,0.4,0,0.7,0,1.1c0,0.5,0.4,0.9,0.9,0.9   c1.4,0,2.9,0,4.3,0C40.7,66.8,41.2,65.8,40.8,65.1z" />
                                                                                </g>
                                                                                <path
                                                                                    d="M30.5,59.6h-6.3V49.4c0-0.8-0.7-1.5-1.5-1.5s-1.5,0.7-1.5,1.5v11.2v0.4v5.1c0,0.8,0.7,1.5,1.5,1.5s1.5-0.7,1.5-1.5v-3.6H29  v3.6c0,0.8,0.7,1.5,1.5,1.5s1.5-0.7,1.5-1.5v-5.1C32,60.2,31.3,59.6,30.5,59.6z" />
                                                                                <circle cx="73.3" cy="40.9"
                                                                                    r="3" />
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
                                                                        <div id="list-box-table-button"
                                                                            class="list-box-table-button">
                                                                            <a
                                                                                href="<?php echo e(route('admin.assigntable', ['id' => Crypt::encrypt($table_list_null->table_id)])); ?>">

                                                                                <button type="button"
                                                                                    class="btn btn-outline-secondary"> <svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        viewBox="0 0 512 512"
                                                                                        style="height: 25px;
                                                                                    fill: #5d7afe;"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                                        <path
                                                                                            d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z" />
                                                                                    </svg> ASSIGN
                                                                                    TABLE
                                                                                </button>
                                                                            </a>
                                                                        </div>


                                                                    </div>

                                                                </div>


                                                            </div>

                                                        </div>
                                                    </div>


                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php $__currentLoopData = $notNulltable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table_list_notnull): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-12">

                                                    <div class="table_list_box ">
                                                        <div class="table_list_box_body">
                                                            <div class="row"
                                                                style="display: flex;align-items: center;align-content: center;">
                                                                <div class="col-5"
                                                                    style="display: flex;padding: 20px 20px;align-items: center;">
                                                                    <div class="list-box-icons">
                                                                        <i class="bi bi-person-vcard"></i>
                                                                    </div>

                                                                    <div class="list-box-details">
                                                                        <div class="list-box-details-name">
                                                                            <span><?php echo e(ucwords($table_list_notnull->customer_name)); ?></span>
                                                                        </div>
                                                                        <div class="list-box-details-number">

                                                                            <?php

                                                                                $formattedMobileNo =
                                                                                    substr(
                                                                                        $table_list_notnull->mobile_no,
                                                                                        0,
                                                                                        3,
                                                                                    ) .
                                                                                    '-' .
                                                                                    substr(
                                                                                        $table_list_notnull->mobile_no,
                                                                                        3,
                                                                                        3,
                                                                                    ) .
                                                                                    '-' .
                                                                                    substr(
                                                                                        $table_list_notnull->mobile_no,
                                                                                        6,
                                                                                    );
                                                                            ?>

                                                                            <span><?php echo e($formattedMobileNo); ?></span>

                                                                            
                                                                        </div>
                                                                        <div class="list-box-details-email">
                                                                            <span><?php echo e($table_list_notnull->email); ?><span>
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
                                                                            <p><?php echo e($table_list_notnull->no_of_people); ?></p>
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
                                                                                <circle cx="28.1" cy="40.9"
                                                                                    r="3" />
                                                                                <g>
                                                                                    <path
                                                                                        d="M40.8,65.1c-0.3-0.5-0.8-0.7-1.3-0.7c-0.5,0-1,0-1.6,0c0-0.2,0-0.3,0-0.4c0-2.9-0.1-5.5-0.1-8.4c0-0.4-0.2-0.7-0.5-1   c-0.1,0-0.1-0.1-0.2-0.1c-0.2-0.1-0.3-0.1-0.3-0.1l0,0c0,0-0.1,0-0.1,0c-1,0-2,0-3,0c-1,0-1.9,0-2.9,0c-0.3,0-0.3-0.1-0.3-0.3   c0-0.4,0-0.8,0-1.1c0,0,0-0.1,0-0.1c0-0.3,0.1-0.4,0.4-0.4c1.6,0,3.3,0,4.9,0c0.1,0,0.2,0,0.4,0c0.4,0,0.7-0.1,0.9-0.4   c0.3-0.3,0.3-0.7,0.2-1.1c-0.2-0.4-0.6-0.6-1-0.6c-1.6,0-3.2,0-4.8,0c-0.2,0-0.4,0-0.5,0c-0.3,0-0.4,0-0.4-0.2c0-0.1,0-0.1,0-0.2   c0-0.9,0-1.8,0-2.6c0-1.4-1.1-2.5-2.5-2.5c-1.4,0-2.5,1.1-2.5,2.6c0,1,0,2.1,0,3.1c0,1,0,2,0,3c0,0.9,0,1.7,0,2.6   c0,1.3,0.9,2.3,2.2,2.5c0.4,0.1,0.9,0,1.3,0h5.8c0,1.4,0,2.8,0,4.1c0,0.7,0,1.4,0,2.2c0,0.4,0,0.7,0,1.1c0,0.5,0.4,0.9,0.9,0.9   c1.4,0,2.9,0,4.3,0C40.7,66.8,41.2,65.8,40.8,65.1z" />
                                                                                </g>
                                                                                <path
                                                                                    d="M30.5,59.6h-6.3V49.4c0-0.8-0.7-1.5-1.5-1.5s-1.5,0.7-1.5,1.5v11.2v0.4v5.1c0,0.8,0.7,1.5,1.5,1.5s1.5-0.7,1.5-1.5v-3.6H29  v3.6c0,0.8,0.7,1.5,1.5,1.5s1.5-0.7,1.5-1.5v-5.1C32,60.2,31.3,59.6,30.5,59.6z" />
                                                                                <circle cx="73.3" cy="40.9"
                                                                                    r="3" />
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
                                                                        <div id="list-box-table-button"
                                                                            class="list-box-table-button"
                                                                            style="
                                                                            display: flex;
                                                                            justify-content: flex-end;
                                                                            align-items: center;
                                                                        ">

                                                                            <div class="edit-list-table"
                                                                                style="
                                                                            padding: 0px 5px;
                                                                        ">
                                                                                <span><?php echo e($table_list_notnull->table_no); ?></span>


                                                                            </div>
                                                                            <div class="edit-list-table-icon"
                                                                                style="padding: 0px 0px 5px 5px;">
                                                                                <div class="btn-group">
                                                                                    <button class="btn  " type="button"
                                                                                        data-bs-toggle="dropdown"
                                                                                        data-bs-auto-close="true"
                                                                                        aria-expanded="false">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            style="fill: black ;height:25px"
                                                                                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                                            <path
                                                                                                d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z" />
                                                                                        </svg>


                                                                                    </button>
                                                                                    <ul class="dropdown-menu">
                                                                                        <li><a class="dropdown-item"
                                                                                                href="<?php echo e(route('admin.checkin', ['id' => Crypt::encrypt($table_list_notnull->table_id)])); ?>">Check
                                                                                                In
                                                                                            </a></li>

                                                                                         <li><a class="dropdown-item"
                                                                                                href="<?php echo e(route('admin.canceldtable', ['id' => Crypt::encrypt($table_list_notnull->table_id)])); ?>">Cancel</a>
                                                                                        </li> 
                                                                                        
                                                                                        <li><a class="dropdown-item"
                                                                                                href="<?php echo e(route('admin.assigntableedit', ['id' => Crypt::encrypt($table_list_notnull->table_id)])); ?>">Edit
                                                                                                Table</a></li>
                                                                                    </ul>
                                                                                </div>








                                                                            </div>



                                                                        </div>


                                                                    </div>

                                                                </div>


                                                            </div>

                                                        </div>
                                                    </div>


                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

    



    <?php echo $__env->make('Admin.Reservation.Scriptreservation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Restaurants\resources\views/Admin/Reservation/list.blade.php ENDPATH**/ ?>