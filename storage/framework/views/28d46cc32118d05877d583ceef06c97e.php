<?php $__env->startSection('content'); ?>
    <style>
        /* Custom styles for the calendar */
        .ConfirmReplay_Message {
            color: black;
        }

        #ConfirmReplayModal .modal-header {
            border-bottom: 0px solid red !important;
            color: black;
            font-size: 15px;
            font-weight: 700;
            text-align: center;
            border-bottom: 1px solid #ce972c;
        }

        .ConfirmReplay_head {
            color: #ce972c;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .ConfirmReplay_Message2 {
            color: black;

        }

        #timeDropdown {
            display: none;

            width: 100%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);

            gap: 10px;

            padding: 10px;
        }

        .time-slot-card {
            color: #ce972c;
            font-size: 16px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            box-sizing: border-box;
        }

        .time-slot-card:hover {
            background-color: #e9e9e9;
        }

        .ms-2 {
            cursor: pointer;
            display: inline-block;
            padding: 10px;
        }

        @media (max-width: 768px) {
            #timeDropdown {
                grid-template-columns: repeat(2, 1fr) !important;
                /* 2 columns for mobile */
            }
        }

        /* For extra small screens (max-width: 480px), display 1 column */
        @media (max-width: 480px) {
            #timeDropdown {
                grid-template-columns: repeat(2, 1fr) !important;
                /* 1 column for small mobile screens */
            }
        }
    </style>



    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-6 content d-none d-lg-block" data-aos="fade-up" data-aos-delay="100">

                </div>

                <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">


                    <div class="row gy-1">
                        <div class="col-lg-12 ">

                            <div class="row ">
                                <label for="Name" class="col-4 col-form-label">Name</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="inputName" name="Name">
                                </div>
                            </div>
                            <div class="row ">
                                <label for="Mobile" class="col-4 col-form-label">Mobile</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="inputMobile" placeholder="05X XXX XXXX"
                                        name="Mobile">
                                    <div id="mobileError" style="color: red; font-size: 12px;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="Email" class="col-4 col-form-label">Email</label>
                                <div class="col-8">
                                    <input type="email" class="form-control" id="inputEmail" name="Email"
                                        placeholder="example@gmail.com" aria-describedby="emailStatus">
                                    <div id="emailverified" style="color: green; font-size: 12px;"></div>
                                    <div id="emailnotverified" style="color: red; font-size: 12px;"></div>
                                </div>
                            </div>


                            <div class="row">
                                <label for="Guest" class="col-4 col-form-label">No. of Guest</label>
                                <div class="col-8">
                                    <select class="form-control" id="inputGuest" name="Guest">
                                        <option value="">Select number of guests</option>
                                        <!-- Dynamically generated options will be inserted here -->
                                    </select>
                                </div>
                            </div>
                        </div>

                        

                        <div class="col-12">
                            <div class="form-group row">
                                <!-- Date of Birth Input -->
                                <label for="Guest" class="col-4 col-form-label">Booking Date</label>
                                <div class="col-8">
                                    <div class="d-flex align-items-center border pe-1 ps-1">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0" id="dayDisplay" style="font-size: 12px">Monday</h6>
                                            <h5 class="mb-0" id="dateDisplay" style="font-size: 16px">01 Jan 2025</h5>
                                            <input type="hidden" id='page_date' name="page_date">
                                        </div>
                                        <!-- Hidden Date Input -->
                                        <input type="date" id="selectedDate" class="form-control"
                                            style="position: absolute; opacity: 0; width: 1px; height: 1px;"
                                            value="<?php echo e(\Carbon\Carbon::now()->format('Y-m-d')); ?>">
                                        <div class="ms-2" onclick="triggerDatePicker()" style="cursor: pointer;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                fill="currentColor" class="bi bi-calendar4-week" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                                                <path
                                                    d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-2 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 mt-2">
                            <div class="form-group row">
                                <!-- Time Input -->
                                <label for="Time" class="col-4 col-form-label">Time</label>
                                <div class="col-8">
                                    <div class="d-flex align-items-center border  pe-1 ps-1">
                                        <div class="flex-grow-1">
                                            <!-- Display the selected time here -->
                                            <h6 class="mb-0" id="TimeDisplay" style="font-size: 16px">Select Time</h6>
                                            <input type="hidden" id="TimeDisplayvalue" class="form-control">
                                        </div>
                                        <!-- Clock Icon -->
                                        <div class="ms-2" style="cursor: pointer;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="512"
                                                height="512" x="0" y="0" viewBox="0 0 512 512"
                                                style="enable-background:new 0 0 512 512" xml:space="preserve"
                                                class="">
                                                <g>
                                                    <path
                                                        d="M437.02 74.98C388.667 26.628 324.38 0 256 0S123.333 26.628 74.98 74.98 0 187.62 0 256s26.628 132.667 74.98 181.02S187.62 512 256 512s132.667-26.628 181.02-74.98S512 324.38 512 256s-26.628-132.667-74.98-181.02zm-11.314 350.726C380.376 471.036 320.106 496 256 496s-124.376-24.964-169.706-70.294C40.964 380.376 16 320.106 16 256S40.964 131.624 86.294 86.294C131.624 40.964 191.894 16 256 16s124.376 24.964 169.706 70.294C471.036 131.624 496 191.894 496 256s-24.964 124.376-70.294 169.706z"
                                                        fill="#cb982b" opacity="1" data-original="#000000"
                                                        class="" />
                                                    <path
                                                        d="M48 256c0-114.691 93.309-208 208-208 41.368 0 81.326 12.111 115.555 35.024a8 8 0 0 0 11.098-2.198 8 8 0 0 0-2.198-11.098C343.584 45.046 300.548 32 256 32c-59.833 0-116.084 23.3-158.392 65.608C55.3 139.916 32 196.167 32 256c0 55.2 20.254 108.232 57.032 149.328a7.98 7.98 0 0 0 5.964 2.665 7.966 7.966 0 0 0 5.332-2.039 8 8 0 0 0 .626-11.296C66.807 356.5 48 307.257 48 256zM442.273 131.547a8 8 0 0 0-13.296 8.9C451.889 174.675 464 214.633 464 256c0 114.691-93.309 208-208 208-47.583 0-94.096-16.479-130.969-46.401a8 8 0 1 0-10.082 12.424C154.664 462.251 204.757 480 256 480c59.833 0 116.084-23.3 158.392-65.608C456.7 372.084 480 315.833 480 256c0-44.547-13.046-87.583-37.727-124.453zM394.658 100.955a209.82 209.82 0 0 1 15.414 15.308 7.98 7.98 0 0 0 5.927 2.624 8.002 8.002 0 0 0 5.922-13.377 226.283 226.283 0 0 0-16.593-16.478 8 8 0 0 0-10.67 11.923z"
                                                        fill="#cb982b" opacity="1" data-original="#000000"
                                                        class="" />
                                                    <path
                                                        d="M256 104a8 8 0 0 0 8-8V72a8 8 0 0 0-16 0v24a8 8 0 0 0 8 8zM248 416v24a8 8 0 0 0 16 0v-24a8 8 0 0 0-16 0zM104 256a8 8 0 0 0-8-8H72a8 8 0 0 0 0 16h24a8 8 0 0 0 8-8zM408 256a8 8 0 0 0 8 8h24a8 8 0 0 0 0-16h-24a8 8 0 0 0-8 8zM182.928 113.436l-12-20.785a8 8 0 0 0-13.856 8l12 20.785a7.998 7.998 0 0 0 10.929 2.928 8 8 0 0 0 2.927-10.928zM342.928 390.564a8 8 0 0 0-13.856 8l12 20.785a7.998 7.998 0 0 0 10.929 2.928 8 8 0 0 0 2.928-10.928l-12.001-20.785zM96.659 356.001a7.97 7.97 0 0 0 3.993-1.073l20.785-12a8 8 0 0 0-8-13.856l-20.785 12a8 8 0 0 0 4.007 14.929zM394.571 184.001a7.97 7.97 0 0 0 3.993-1.073l20.785-12a8 8 0 0 0-8-13.856l-20.785 12a8 8 0 0 0 4.007 14.929zM352 89.723a7.998 7.998 0 0 0-10.928 2.928l-12 20.785a8 8 0 0 0 13.857 8l12-20.785A8.001 8.001 0 0 0 352 89.723zM180 387.636a8 8 0 0 0-10.928 2.928l-12 20.785a8 8 0 0 0 13.857 8l12-20.785A8.001 8.001 0 0 0 180 387.636zM390.564 342.928l20.785 12A7.998 7.998 0 0 0 422.278 352a8 8 0 0 0-2.928-10.928l-20.785-12A8 8 0 0 0 387.637 332a7.999 7.999 0 0 0 2.927 10.928zM121.436 169.072l-20.785-12a8 8 0 0 0-8 13.856l20.785 12A7.998 7.998 0 0 0 124.365 180a8.001 8.001 0 0 0-2.929-10.928zM311.692 360.451a8 8 0 0 0 6.921-12.001l-44.38-76.869C277.824 267.384 280 261.943 280 256c0-10.429-6.689-19.322-16-22.624V128a8 8 0 0 0-16 0v105.376c-9.311 3.302-16 12.195-16 22.624 0 13.234 10.766 24 24 24 1.497 0 2.961-.145 4.383-.408l44.374 76.858a7.998 7.998 0 0 0 6.935 4.001zM248 256c0-4.411 3.589-8 8-8s8 3.589 8 8-3.589 8-8 8-8-3.589-8-8z"
                                                        fill="#cb982b" opacity="1" data-original="#000000"
                                                        class="" />
                                                </g>
                                            </svg>

                                        </div>
                                    </div>

                                    <div id="timeDropdown"
                                        style="display:none;overflow-y: auto;  display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
                                        <!-- Time slots will be populated here dynamically -->
                                    </div>


                                </div>
                            </div>
                        </div>










                        <div class="row mb-2" style="text-align: center;" id="timeSlots"></div>
                        <div class="col-12">
                            <div class="submit_button">
                                <button type="button" class="btn btn-primary btn-lg" id="ConfirmModal_Reservation">Make
                                    a
                                    Reservation</button>
                            </div>
                        </div>


                    </div>



                </div>

            </div>

        </div>

        </div>
    </section>


    <section class="">
        <div class="modal fade" id="ConfirmModal" tabindex="-1" aria-labelledby="ConfirmModalLabel" aria-hidden="true"
            role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ConfirmModalLabel">Please re-Confirm the details for reservation
                        </h1>

                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Your Booking is scheduled On :</label>


                                <div class="booking_date">
                                    <p><strong><span id="modalDay"></span>,<span id="modalMonth"></span> , <span
                                                id="modalDate"></span> <?php echo e(' '); ?> at <span
                                                id="selectedTime"></span> </strong> </p>

                                </div>
                                <div class="booking_details">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="booking_details_data">
                                                Name
                                            </div>

                                        </div>
                                        <div class="col-9">
                                            <span id="modalName">No name provided</span>
                                        </div>
                                        <div class="col-3">
                                            <div class="booking_details_data">
                                                Email
                                            </div>

                                        </div>
                                        <div class="col-9">
                                            <span id="modalEmail">No email provided</span>
                                        </div>
                                        <div class="col-3">
                                            <div class="booking_details_data">
                                                Mobile
                                            </div>

                                        </div>
                                        <div class="col-9">
                                            <span id="modalMobile">No mobile number provided</span>
                                        </div>
                                        <div class="col-3">
                                            <div class="booking_details_data">
                                                Guests
                                            </div>

                                        </div>
                                        <div class="col-9">
                                            <span id="modalGuests">Number of guests not specified</span>
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </form>
                    </div>
                    <div class="modal-footer" id="modalFooter_ConfirmModal"
                        style="display: flex;justify-content: space-around;align-items: center;">


                        <button type="button" class="btn btn-reservation" id="Reservation_Save">Confirm</button>
                        <button type="button" class="btn btn-reservation" id="Reservation_Modify"
                            data-bs-dismiss="modal">Modify</button>
                    </div>

                    <div class="modal-footer" id="loading"
                        style="display: None;justify-content: space-around;align-items: center;">
                        <div class="spinner-border" role="status" style="color: #654c15;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="ConfirmReplayModal" aria-hidden="true" aria-labelledby="ConfirmReplayModalLabel"
            tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">


                    </div>
                    <div class="modal-body">
                        

                        <div class="ConfirmReplay_head">
                            <!-- Message will be inserted here -->
                        </div>

                        <div class="ConfirmReplay_Message">
                            <!-- Message will be inserted here -->
                        </div>
                        <br>
                        <div class="ConfirmReplay_Message2">
                            <!-- Message will be inserted here -->
                        </div>
                        <br>

                        <div class="ConfirmReplay_data" style="text-align: center">
                            Thank you
                        </div>

                    </div>
                    <div class="modal-footer">


                        <button type="button" class="btn btn-reservation" id="reservation_close"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="WarningModalSection">


        <div class="modal fade" id="WarningModal" tabindex="-1" aria-labelledby="WarningModalLabel" aria-hidden="true"
            role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">


                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer" style="display: flex;justify-content: space-around;align-items: center;">


                        <button type="button" class="btn btn-reservation" id="reservation_close"
                            data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </section>





    <?php echo $__env->make('Frontend.Reservation.reservationscript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Frontend.Layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Restaurants\resources\views\Frontend\Reservation\reservation.blade.php ENDPATH**/ ?>