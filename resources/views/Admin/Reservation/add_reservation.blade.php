@extends('Admin.layout.index')


<style>
    #inputMobile::placeholder {
        color: #6c757d;
        /* Gray color */
        opacity: 1;
        /* Ensures the custom color is fully applied */
    }

    .time-slot-card.selected {
        border: 2px solid #cb982b;
        background-color: #cb982b;
        /* Blue border */
    }

    h5#pastTimeModal {
    color: red;
}
</style>


@Section('content')
    <section id="assigntable" class="assigntable">

        <div class="container">
            <div class="row">

                <div class="col-12 mb-5">

                    {{-- 
                    <div class="header_reservation">
                        <span>haiii </span>
                    </div> --}}

                </div>
                <form action="{{ route('admin.addnewreservation') }}" method="POST">

                    @csrf
                    <div class="col-12">
                        {{-- 
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}

                        <div class="row ">
                            <div class="col-6">

                                <div class="row gy-1">
                                    <div class="col-lg-12 ">

                                        <div class="row ">
                                            <label for="Mobile" class="col-4 col-form-label">Mobile</label>
                                            <div class="col-8">
                                                <input type="text"
                                                    class="form-control @error('Mobile') is-invalid @enderror"
                                                    id="inputMobile" placeholder="05X XXX XXXX" name="Mobile"
                                                    value="{{ old('Mobile') }}">
                                                @error('Mobile')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row ">
                                            <label for="Name" class="col-4 col-form-label">Name</label>
                                            <div class="col-8">
                                                <input type="text"
                                                    class="form-control @error('Name') is-invalid @enderror" id="inputName"
                                                    name="Name" value="{{ old('Name') }}">
                                                @error('Name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="Email" class="col-4 col-form-label">Email</label>
                                            <div class="col-8">
                                                <input type="email"
                                                    class="form-control @error('Email') is-invalid @enderror"
                                                    id="inputEmail" name="Email" value="{{ old('Email') }}">
                                                @error('Email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row ">
                                            <label for="Guest" class="col-4 col-form-label">No. of Guest</label>
                                            <div class="col-8">
                                                <input type="text"
                                                    class="form-control @error('Guest') is-invalid @enderror"
                                                    id="inputGuest" name="Guest" value="{{ old('Guest') }}">
                                                @error('Guest')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="row ">
                                            <label for="Mobile" class="col-4 col-form-label">Mobile</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control" id="inputMobile"
                                                    placeholder="05X XXX XXXX" name="Mobile">
                                                <div id="mobileError" style="color: red; font-size: 12px;">

                                                </div>
                                            </div>
                                        </div>
                                        <!-- resources/views/your_view.blade.php -->
                                        {{-- <input type="text" id="mobile-input" style="width: 100%;"
                                        placeholder="Enter mobile number1"> --}}


                                        {{-- 
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
                                            <label for="Guest" class="col-4 col-form-label">No. of Guest</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control" id="inputGuest" name="Guest">
                                            </div>
                                        </div> --}}

                                    </div>

                                    <div class="col-12 mt-4">
                                        <div id='calendar'></div>

                                    </div>


                                    {{-- <div class="col-12">
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
        
        
                                </div> --}}



                                </div>
                                <input type="hidden" id="timeSlotInput" name="timeSlotInput"
                                    placeholder="Selected Time Slot" />

                                <input type="hidden" id="dateInput" name="dateInput" readonly>


                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="list_reservation_table_id" id="list_reservation_table_id">

                                        </div>
                                    </div>



                                </div>

                            </div>


                        </div>
                    </div>

                </form>

            </div>

        </div>
    </section>

    <!-- Modal -->
<div class="modal fade" id="pastTimeModal" tabindex="-1" aria-labelledby="pastTimeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pastTimeModal">Please Check Date and Time</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="color: black;">
          You cannot select a past date or time for booking. Please choose a future date and time.
        </div>
        <div class="modal-footer"style="display: flex;align-items: center;justify-content: center;">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  


    <script src="{{ URL::to('https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js') }}"></script>
    {{-- <script src="{{ URL::to('https://code.jquery.com/jquery-3.7.1.js') }}"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> --}}



    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedDate = '';
            let selectedTime = '';

            // Initialize FullCalendar
            const calendarEl = document.getElementById('calendar');

            if (!calendarEl) {
                console.error('Calendar element not found.');
                return;
            }

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                dayCellDidMount: function(info) {
                    if (info.dateStr === new Date().toISOString().split('T')[0]) {
                        info.el.classList.add('highlight-today');
                    }
                },
                dateClick: function(info) {
                    handleDateClick(info.dateStr);
                },
                headerToolbar: {
                    left: 'prev',
                    center: 'title',
                    right: 'next'
                },
                dayHeaderFormat: {
                    weekday: 'narrow'
                },
            });

            calendar.render();

            function handleDateClick(dateStr) {
                document.querySelectorAll('.fc-daygrid-day').forEach(day => {
                    day.classList.remove('selected-date');
                });

                const selectedDateEl = document.querySelector(`.fc-daygrid-day[data-date="${dateStr}"]`);
                if (selectedDateEl) {
                    selectedDateEl.classList.add('selected-date');
                }

                // Format the selected date
                const selectedDate = new Date(dateStr);
                const formattedDate = formatDate(selectedDate);



                const dateInput = document.getElementById('dateInput');
                if (dateInput) {
                    dateInput.value = formattedDate;
                }


                // Call fetchTimeSlots with the formatted date
                fetchTimeSlots(formattedDate);
            }

            function formatDate(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                const day = String(date.getDate()).padStart(2, '0');
                const hours = String(date.getHours()).padStart(2, '0');
                const minutes = String(date.getMinutes()).padStart(2, '0');
                const seconds = String(date.getSeconds()).padStart(2, '0');

                return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            }

            function fetchTimeSlots(date) {
                $.ajax({
                    url: '/reservation-date',
                    method: 'POST',
                    data: {
                        Date: date,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#list_reservation_table_id').html(response);

                        // Reinitialize the event listeners for the time slot cards after updating the HTML
                        initTimeSlotCardListeners();
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error: ', error);
                    }
                });
            }

            // function initTimeSlotCardListeners() {
            //     const cards = document.querySelectorAll('.time-slot-card');

            //     cards.forEach(card => {
            //         card.addEventListener('click', function() {
            //             console.log('Card clicked:', this);

            //             // Remove 'selected' class from all cards
            //             cards.forEach(c => c.classList.remove('selected'));
            //             const selectedTimeSlot = this.dataset.time;
            //             // Add 'selected' class to the clicked card
            //             this.classList.add('selected');

            //             const timeSlotInput = document.getElementById('timeSlotInput');

            //             if (timeSlotInput) {
            //                 timeSlotInput.value = selectedTimeSlot;
            //             }
            //             alert(timeSlotInput);
            //             const new_resn_btn = document.getElementById('new_resn_btn');
            //             const newResnBtn = document.getElementById('new_resn_btn');
            //             if (newResnBtn) {
            //                 newResnBtn.style.display = 'block';
            //                 newResnBtn.style.flexDirection = 'row-reverse';
            //             }
            //         });
            //     });
            // }
            function initTimeSlotCardListeners() {
                const cards = document.querySelectorAll('.time-slot-card');

                cards.forEach(card => {
                    card.addEventListener('click', function() {
                        console.log('Card clicked:', this);

                        // Remove 'selected' class from all cards
                        cards.forEach(c => c.classList.remove('selected'));

                        // Add 'selected' class to the clicked card
                        this.classList.add('selected');

                        // Get the time slot value from the clicked card
                        const selectedTimeSlot = this.dataset
                            .time; // Assume each card has a data-time attribute with the time slot value

                        // Get the input text box by its ID
                        const timeSlotInput = document.getElementById('timeSlotInput');

                        // Set the value of the input text box to the selected time slot
                        if (timeSlotInput) {
                            timeSlotInput.value = selectedTimeSlot;
                        }


                        // Display the reservation button
                        const newResnBtn = document.getElementById('new_resn_btn');
                        if (newResnBtn) {
                            newResnBtn.style.display = 'block';
                            newResnBtn.style.flexDirection = 'row-reverse';
                        }
                    });
                });
            }

            // Initialize the time slot card listeners on initial page load
            initTimeSlotCardListeners();
            // // Initialize the time slot card listeners on initial page load
            // initTimeSlotCardListeners();
        });
    </script> --}}

    <script>
 document.addEventListener('DOMContentLoaded', function() {
    let selectedDate = '';
    let selectedTime = '';

    // Initialize FullCalendar
    const calendarEl = document.getElementById('calendar');

    if (!calendarEl) {
        console.error('Calendar element not found.');
        return;
    }

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        dayCellDidMount: function(info) {
            if (info.dateStr === new Date().toISOString().split('T')[0]) {
                info.el.classList.add('highlight-today');
            }
        },
        dateClick: function(info) {
            handleDateClick(info.dateStr);
        },
        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        dayHeaderFormat: {
            weekday: 'narrow'
        },
    });

    calendar.render();

    function handleDateClick(dateStr) {
        document.querySelectorAll('.fc-daygrid-day').forEach(day => {
            day.classList.remove('selected-date');
        });

        const selectedDateEl = document.querySelector(`.fc-daygrid-day[data-date="${dateStr}"]`);
        if (selectedDateEl) {
            selectedDateEl.classList.add('selected-date');
        }

        // Format the selected date
        const selectedDate = new Date(dateStr);
        const formattedDate = formatDate(selectedDate);

        const dateInput = document.getElementById('dateInput');
        if (dateInput) {
            dateInput.value = formattedDate;
        }

        // Call fetchTimeSlots with the formatted date
        fetchTimeSlots(formattedDate);
    }

    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');

        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }

    function fetchTimeSlots(date) {
        $.ajax({
            url: '/reservation-date',
            method: 'POST',
            data: {
                Date: date,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#list_reservation_table_id').html(response);

                // Reinitialize the event listeners for the time slot cards after updating the HTML
                initTimeSlotCardListeners();
            },
            error: function(xhr, status, error) {
                console.error('AJAX error: ', error);
            }
        });
    }

    function initTimeSlotCardListeners() {
        const cards = document.querySelectorAll('.time-slot-card');

        cards.forEach(card => {
            card.addEventListener('click', function() {
                const selectedTimeSlot = this.dataset.time; // Assume each card has a data-time attribute with the time slot value

                // Check if the selected time slot is in the past
                if (isTimeSlotInPast(selectedTimeSlot)) {
                    showPastTimeModal();
                    return;
                }

                // Remove 'selected' class from all cards
                cards.forEach(c => c.classList.remove('selected'));

                // Add 'selected' class to the clicked card
                this.classList.add('selected');

                // Get the input text box by its ID
                const timeSlotInput = document.getElementById('timeSlotInput');

                // Set the value of the input text box to the selected time slot
                if (timeSlotInput) {
                    timeSlotInput.value = selectedTimeSlot;
                }

                // Display the reservation button
                const newResnBtn = document.getElementById('new_resn_btn');
                if (newResnBtn) {
                    newResnBtn.style.display = 'block';
                    newResnBtn.style.flexDirection = 'row-reverse';
                }
            });
        });
    }

    function isTimeSlotInPast(timeStr) {
        const now = new Date();
        const selectedDate = new Date(document.getElementById('dateInput').value);
        const selectedTime = new Date(`${selectedDate.toISOString().split('T')[0]}T${timeStr}:00`);

        return selectedTime < now;
    }

    function showPastTimeModal() {
        // Show a modal indicating that booking is not allowed for past times
        const modal = new bootstrap.Modal(document.getElementById('pastTimeModal'));
        modal.show();
    }
});


</script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script type="text/javascript">
        $(document).ready(function() {
            $("#inputMobile").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('autocomplete.mobile') }}",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            // Transform the response into an array of objects suitable for the autocomplete
                            response($.map(data, function(item) {
                                return {
                                    label:'Mobile :' + item.mobile_no + ' - Name :' + item.customer_name,
                                    value: item.mobile_no,
                                    name: item.customer_name,
                                    email: item.email
                                };
                            }));
                        }
                    });
                },
                minLength: 2, // Minimum characters before autocomplete starts
                select: function(event, ui) {
                    $('#inputMobile').val(ui.item.value); // Set the value of the input field to the selected mobile number
                    $('#inputName').val(ui.item.name); // Set the name field
                    $('#inputEmail').val(ui.item.email); // Set the email field
                    return false; // Prevent default action
                }
            });
        });
    </script>
    


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
                let selectedDate = '';
                let selectedTime = '';

                // Initialize FullCalendar
                const calendarEl = document.getElementById('calendar');

                if (!calendarEl) {
                    console.error('Calendar element not found.');
                    return;
                }
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    dayCellDidMount: function(info) {
                        if (info.dateStr === new Date().toISOString().split('T')[0]) {
                            info.el.classList.add('highlight-today');
                        }
                    },
                    dateClick: function(info) {
                        handleDateClick(info.dateStr);
                    },
                    headerToolbar: {
                        left: 'prev',
                        center: 'title',
                        right: 'next'
                    },
                    dayHeaderFormat: {
                        weekday: 'narrow'
                    },
                });

                calendar.render();

                function handleDateClick(dateStr) {
                    document.querySelectorAll('.fc-daygrid-day').forEach(day => {
                        day.classList.remove('selected-date');
                    });

                    const selectedDateEl = document.querySelector(`.fc-daygrid-day[data-date="${dateStr}"]`);
                    if (selectedDateEl) {
                        selectedDateEl.classList.add('selected-date');
                    }

                    // Format the selected date
                    const selectedDate = new Date(dateStr);
                    const formattedDate = formatDate(selectedDate);

                    // Call fetchTimeSlots with the formatted date
                    fetchTimeSlots(formattedDate);
                }

                function formatDate(date) {
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                    const day = String(date.getDate()).padStart(2, '0');
                    const hours = String(date.getHours()).padStart(2, '0');
                    const minutes = String(date.getMinutes()).padStart(2, '0');
                    const seconds = String(date.getSeconds()).padStart(2, '0');

                    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
                }

                function fetchTimeSlots(date) {
                    $.ajax({
                        url: '/reservation-date', // URL to send the request to
                        method: 'POST', // HTTP method
                        data: {
                            Date: date, // Data to be sent to the server
                            _token: '{{ csrf_token() }}' // CSRF token for security
                        },
                        success: function(response) {
                            // Update the HTML of the element with ID 'list_reservation_table_id' with the response
                            $('#list_reservation_table_id').html(response);
                        },
                        error: function(xhr, status, error) {
                            // Log any errors that occur
                            console.error('AJAX error: ', error);
                        }
                    });
                }


            }

        );
        // document.addEventListener('DOMContentLoaded', function() {
        //     const cards = document.querySelectorAll('.time-slot-card');

        //     cards.forEach(card => {
        //         card.addEventListener('click', function() {
        //             // Remove 'selected' class from all cards
        //             cards.forEach(c => c.classList.remove('selected'));

        //             // Add 'selected' class to the clicked card
        //             this.classList.add('selected');

        //             // Hide all submit buttons
        //             document.querySelectorAll('.submit-btn').forEach(btn => btn.style.display =
        //                 'none');

        //             // Show submit button for the clicked card
        //             const submitBtn = this.querySelector('.submit-btn');
        //             if (submitBtn) {
        //                 submitBtn.style.display = 'block';
        //             }
        //         });
        //     });
        // });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.time-slot-card');

            const card1= document.getElementById('list_reservation_table_id');
            cards.forEach(card => {
                card.addEventListener('click', function() {
                    alert("hai");
                    console.log('Card clicked:', this); // Debugging

                    // Remove 'selected' class from all cards
                    cards.forEach(c => c.classList.remove('selected'));

                    // Add 'selected' class to the clicked card
                    this.classList.add('selected');

                    // Hide all submit buttons
                    document.querySelectorAll('.submit-btn').forEach(btn => {
                        console.log('Hiding submit button:', btn); // Debugging
                        btn.style.display = 'none';
                    });

                    // Show submit button for the clicked card
                    const submitBtn = this.querySelector('.submit-btn');
                    if (submitBtn) {
                        console.log('Showing submit button:', submitBtn); // Debugging
                        submitBtn.style.display = 'block';
                    }
                });
            });
        });
    </script> --}}
@endsection
