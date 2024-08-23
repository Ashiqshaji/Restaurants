<?php $__env->startSection('content'); ?>
    <style>

    </style>

    <section id="assigntable" class="assigntable">

        <div class="container">
            <div class="row ">
                <div class="col-12">
                    <h4>EDIT ASSIGN TABLE</h4>
                </div>
                <div class="col-12">

                    <div class="assign-header-details">
                        <div class="row">
                            <div class="col-12 col-md-5"
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
                                            <?php echo e(ucwords($data_user->customer_name)); ?>

                                        </span>
                                    </div>
                                    <div class="assign-box-details-number">

                                        <?php

                                            $formattedMobileNo =
                                                substr($data_user->mobile_no, 0, 3) .
                                                '-' .
                                                substr($data_user->mobile_no, 3, 3) .
                                                '-' .
                                                substr($data_user->mobile_no, 6);
                                        ?>

                                        <span><?php echo e($formattedMobileNo); ?></span>

                                        
                                    </div>
                                    <div class="assign-box-details-email">
                                        <span><?php echo e($data_user->email); ?><span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12  col-md-3 "
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
                                        <span><?php echo e($data_user->no_of_people); ?><span>
                                    </div>


                                </div>

                            </div>




                            <div class="col-12  col-md-4"
                                style="
                        display: flex;
                        align-items: center;
                        justify-content: flex-end;
                        padding: 0px 30px 0px 0px;
                        ">
                                <div class="assign-box-date">

                                    <div class="assign-box-date-time">
                                        <span>
                                            <?php echo e($data_user->reserved_blocks); ?></span>

                                    </div>
                                    <div class="assign-box-date-day">
                                        <span>
                                            <?php echo e(\Carbon\Carbon::parse($data_user->reservation_date)->format('l')); ?>

                                        </span>
                                    </div>
                                    <div class="assign-box-date-month">
                                        <span>
                                            <?php echo e(\Carbon\Carbon::parse($data_user->reservation_date)->format('M d, Y')); ?>

                                        </span>

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
                    <form id="table_update_remove" action="<?php echo e(route('admin.removetable')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row mt-4">
                            <div class="col-6">
                                <h5> <span class="header"> Please choose the remove table</span> </h5>
                                

                            </div>
                            <div class="col-6">
                                <input type="hidden" id="table_id_update" name="table_id_update"
                                    value="<?php echo e($data_user->table_id); ?>">

                                <div class="table_assign_btn" id="table_assign_btn_update" style="display: none; ">
                                    <div class="table_assign_btn_dir">

                                        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                                            data-bs-target="#RemoveModal">Remove Table</button>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="row">


                            <div class="col-12">
                                <div class="row">
                                    <?php $__currentLoopData = $data_user_selected; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $colorClass = $result->table_id == $data_user->table_id ? '' : '';
                                            // $isSelectable = $result->table_id != $data_user->table_id;
                                        ?>
                                        <div class="col-2">
                                            <div class="card mt-3 <?php echo e($colorClass); ?>"
                                                id="cardupdate<?php echo e($result->table_id); ?>">
                                                <div class="card-body">

                                                    
                                                    <input class="form-check-input" type="checkbox"
                                                        name="selected_item_update[]" value="<?php echo e($result->table_id); ?>"
                                                        id="itemupdate<?php echo e($result->table_id); ?>"
                                                        onclick="toggleCardUpdate('<?php echo e($result->table_id); ?>')"
                                                        style="display:none">
                                                    
                                                    <label for="item_update<?php echo e($result->table_id); ?>">
                                                        <h4 class="card-title"><?php echo e(htmlspecialchars($result->table_no)); ?>

                                                        </h4>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>


                        </div>
                    </form>

                </div>


                <div class="col-12 mt-3">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                </div>

                <div class="col-12 mt-3">
                    <h5> <span class="header"> Add new Tables</span> </h5>

                </div>



                <div class="col-12">
                    <form id="table_confirm" action="<?php echo e(route('admin.selectiontable')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="section_id">

                                    <select id="section-select" class="form-select" aria-label="select Section">
                                        <option value="">Please Select Section</option>
                                        <?php $__currentLoopData = $section_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value=<?php echo e($section_id->btnOrderID); ?>><?php echo e($section_id->Name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                    </select>
                                </div>

                            </div>
                            <div class="col-6">
                                <input type="hidden" id="table_id" name="table_id" value="<?php echo e($data_user->table_id); ?>">

                                <div class="table_assign_btn" id="table_assign_btn" style="display: none; ">
                                    <div class="table_assign_btn_dir">

                                        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                                            data-bs-target="#confirmModal">Confirm Table</button>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="table_list_id" id="table_list_id">

                            </div>

                        </div>
                    </form>

                </div>







            </div>

        </div>





    </section>

    <section class="assign_table_modal" id="assign_table_modal">
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Confirm Table Selection</h5>

                    </div>
                    <div class="modal-body">
                        Are you sure you want to confirm the selected tables?
                    </div>
                    <div class="modal-footer"
                        sstyle="
                    display: flex;
                    justify-content: center;
                    border-top: 0px solid;
                ">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmButton">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="assign_table_modal" id="assign_table_modal">
        <div class="modal fade" id="RemoveModal" tabindex="-1" aria-labelledby="RemoveModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Confirm Table Remove</h5>

                    </div>
                    <div class="modal-body">
                        Are you sure you want to confirm remove tables?
                    </div>
                    <div class="modal-footer"
                        sstyle="
                    display: flex;
                    justify-content: center;
                    border-top: 0px solid;
                ">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="RemoveButton">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <style>
        .card.selected {
            border: 2px solid #cb982b;
            background-color: #cb982b;
        }
    </style>

    <?php echo $__env->make('Admin.Reservation.Scriptassign', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Restaurants\resources\views\Admin\Reservation\edittable.blade.php ENDPATH**/ ?>