<div class="list_reservation_table" style="padding: 0px 20px !important">
    <div class="row text-center">
        <?php for($i = 0; $i <= 7 * 2 + 1; $i++): ?>
            <?php
                $time = \Carbon\Carbon::createFromTime(8, 0)->addMinutes($i * 60);
                $timeStr = $time->format('h:i A'); // 12-hour format
                $buttonId = 'btn-' . $time->format('Hi');
                $timecheck = $time->format('H:i');
            ?>

            <div class="col-6 col-sm-4 col-md-3 p-1">
                <div class="card time-slot-card" id="<?php echo e($buttonId); ?>" data-time="<?php echo e($time->format('H:i')); ?>"
                    style="
                    height: 115px;
                ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="time">
                                    <span class="display_time"><?php echo e($time->format('h:i A')); ?></span>
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
                                                $time1 = \Carbon\Carbon::createFromFormat('H:i', $timecheck);
                                                $time2 = \Carbon\Carbon::createFromFormat('H:i', $key);
                                                $areTimesSame = $time1->eq($time2);
                                            } catch (\Carbon\Exceptions\InvalidFormatException $e) {
                                                $areTimesSame = false;
                                            }
                                        ?>

                                        <?php if($areTimesSame): ?>
                                            <?php
                                                $nullTableIdCount = $reservation['null_tableid_count'];
                                                $notNullTableIdCount = $reservation['not_null_tableid_count'];
                                            ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row mt-1">
                                        <?php if($nullTableIdCount && $nullTableIdCount): ?>
                                            <div class="col-6"
                                                style="display: flex;align-items: center;justify-content: space-evenly;">

                                                <div class="icontimeslot">
                                                    <img src="<?php echo e(URL::to('assets/img/Ellipse_1.png')); ?>" alt=""
                                                        style="height: 15px;">
                                                </div>
                                                <div class="icontimeslot_size" style="font-size: 15px; color:#288e70">
                                                    <?php echo e($nullTableIdCount); ?>

                                                </div>

                                            </div>


                                            <div class="col-6"
                                                style="display: flex;align-items: center;justify-content: space-evenly; ">
                                                <div class="icontimeslot">
                                                    <img src="<?php echo e(URL::to('assets/img/Ellipse_2.png')); ?>" alt=""
                                                        style="height: 15px;">
                                                </div>
                                                <div class="icontimeslot_size" style="font-size: 15px ;">
                                                    <?php echo e($notNullTableIdCount); ?>

                                                </div>


                                            </div>
                                        <?php else: ?>
                                            <?php if($nullTableIdCount): ?>
                                                <div class="col-12"
                                                    style="display: flex;align-items: center;justify-content: space-evenly;">

                                                    <div class="icontimeslot">
                                                        <img src="<?php echo e(URL::to('assets/img/Ellipse_1.png')); ?>"
                                                            alt="" style="height: 15px;">
                                                    </div>
                                                    <div class="icontimeslot_size"
                                                        style="font-size: 15px; color:#288e70">
                                                        <?php echo e($nullTableIdCount); ?>

                                                    </div>

                                                </div>
                                            <?php endif; ?>
                                            <?php if($notNullTableIdCount): ?>
                                                <div class="col-12"
                                                    style="display: flex;align-items: center;justify-content: space-evenly; ">
                                                    <div class="icontimeslot">
                                                        <img src="<?php echo e(URL::to('assets/img/Ellipse_2.png')); ?>"
                                                            alt="" style="height: 15px;">
                                                    </div>
                                                    <div class="icontimeslot_size" style="font-size: 15px ;">
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

<div class="row">
    <div class="col-12">
        <button type="submit" id="new_resn_btn" class="btn btn-primary mt-3 submit-btn"
            style="display: none;
            flex-direction: row-reverse">Added New Reservation</button>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\Restaurants\resources\views/Admin/Reservation/partials/timeslot.blade.php ENDPATH**/ ?>