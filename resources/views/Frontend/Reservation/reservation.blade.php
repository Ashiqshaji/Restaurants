@extends('Frontend.Layout.index')

@Section('content')
    <style>
        /* Custom styles for the calendar */
        .ConfirmReplay_Message {
            color: black;
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
                                <label for="Email" class="col-4 col-form-label">Email</label>
                                <div class="col-8">
                                    <input type="email" class="form-control" id="inputEmail" name="Email">
                                </div>
                            </div>
                            <div class="row ">
                                <label for="Mobile" class="col-4 col-form-label">Mobile</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="inputMobile" name="Mobile">
                                    <div id="mobileError" style="color: red; font-size: 12px;"></div>
                                </div>
                            </div>
                            <div class="row ">
                                <label for="Guest" class="col-4 col-form-label">No. of Guest</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="inputGuest" name="Guest">
                                </div>
                            </div>

                        </div>

                        <div class="col-12">
                            <div id='calendar'></div>

                        </div>


                        <div class="col-12">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-touch="false"
                                data-bs-interval="false">
                                <div class="row text-center">
                                    @for ($i = 0; $i <= 7 * 2 + 1; $i++)
                                        @php
                                            $time = \Carbon\Carbon::createFromTime(8, 0)->addMinutes($i * 60);
                                            $timeStr = $time->format('H:i');
                                            $buttonId = 'btn-' . $time->format('Hi');
                                        @endphp
                                        <div class="col-3 p-1">
                                            <a id="{{ $buttonId }}" href="#" class="btn btn-primary time-slot-btn"
                                                tabindex="-1" role="button"
                                                data-time="{{ $timeStr }}">{{ $time->format('h:i a') }}</a>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div id="timeSlotsContainer" class="row">
                                <!-- Time slots will be added dynamically here -->
                            </div>


                            <div class="row" style="text-align: center;" id="timeSlots"></div>
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
                                                id="modalDate"></span> {{ ' ' }} at <span
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
                        <div class="ConfirmReplay_data">
                            Thank you for Being a Valuable Customer
                        </div>
                        <div class="ConfirmReplay_Message">
                            <!-- Message will be inserted here -->
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





    @include('Frontend.Reservation.reservationscript')
@endSection
