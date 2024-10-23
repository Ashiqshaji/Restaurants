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



<div class="list_reservation_table" style="padding: 0px 20px !important">
    <div class="row text-center">
        <?php for($i = 0; $i <= 7 * 2 + 1; $i++): ?>
            <?php
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
            ?>

            <div class="col-6 col-sm-4 col-md-3 p-1">
                <div class="card time-slot-card" id="<?php echo e($buttonId); ?>" data-time="<?php echo e($time->format('H:i')); ?>"
                    style="height: 120px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="time">
                                    <span class="display_time"><?php echo e($time->format('h:i A')); ?></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="booking_header">BOOKINGS</div>
                            </div>
                            <div class="col-12">
                                <div class="booking_number">
                                    <div class="row mt-1 "style="display: flex;justify-content: space-evenly;">
                                        <?php if($nullTableIdCount || $notNullTableIdCount || $checkedInCount): ?>
                                            <?php
                                                $total = $notNullTableIdCount + $checkedInCount;
                                                $total = $table_count - $total;
                                            ?>

                                            <?php $__currentLoopData = [
        ['count' => $nullTableIdCount, 'color' => '#585f9c', 'icon' => 'blue.png', 'tooltip' => 'Un Booked Table'],
        ['count' => $notNullTableIdCount, 'color' => '#d44a47', 'icon' => 'red.png', 'tooltip' => 'Booked Table'],
        //['count' => $checkedInCount, 'color' => '#288e70', 'icon' => 'green.png', 'tooltip' => 'Checked In Table']
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($data['count']): ?>
                                                    <div class="col-6 mt-1"
                                                        style="display: flex; align-items: center; justify-content: space-evenly;"
                                                        data-bs-toggle="tooltip" title="<?php echo e($data['tooltip']); ?>"
                                                        class="custom-tooltip">
                                                        <div class="icontimeslot">
                                                            <img src="<?php echo e(URL::to('assets/img/' . $data['icon'])); ?>"
                                                                alt="" style="height: 20px;">
                                                        </div>

                                                        <div class="icontimeslot_size"
                                                            style="font-size: 15px; color: <?php echo e($data['color']); ?>;margin-top:3px">
                                                            <?php echo e($data['count']); ?>

                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
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
            flex-direction: row-reverse">Add New Reservation</button>
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
<?php /**PATH C:\xampp\htdocs\Restaurants\resources\views\Admin\Reservation\Partials\timeslot.blade.php ENDPATH**/ ?>