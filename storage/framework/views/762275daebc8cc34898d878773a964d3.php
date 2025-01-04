<script src="<?php echo e(URL::to('https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('https://code.jquery.com/jquery-3.7.1.js')); ?>"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<!-- jQuery (must be loaded first) -->


<!-- Bootstrap Datepicker CSS -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>




<script>
    // Populate all time slots
    const timeSlots = [
        '09:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '01:00 PM',
        '02:00 PM', '03:00 PM', '04:00 PM', '05:00 PM', '06:00 PM',
        '07:00 PM', '08:00 PM', '09:00 PM', '10:00 PM', '11:00 PM'
    ];

    // Function to populate the dropdown
    function populateTimeDropdown() {
        const dropdown = $('#timeDropdown');
        dropdown.empty(); // Clear existing content

        // Add each time slot as a clickable item
        timeSlots.forEach(time => {
            dropdown.append(
                `<div class="time-slot-card" style="padding: 10px; margin: 5px; cursor: pointer; border: 1px solid #ccc; text-align: center;" onclick="selectTime('${time}')">${time}</div>`
            );
        });

        // If no future times are available, hide the dropdown
        if (!dropdown.children().length) {
            dropdown.hide();
        }
    }

    // Function to toggle the dropdown visibility
    function toggleTimeDropdown() {
        const dropdown = $('#timeDropdown');
        if (dropdown.is(':visible')) {
            dropdown.hide();
        } else {
            populateTimeDropdown(); // Populate the dropdown when shown
            dropdown.show();
        }
    }

    // Function to update the selected time display
    function selectTime(time) {
        $('#TimeDisplay').text(time); // Update the display
        $('#timeDropdown').hide(); // Hide the dropdown
        $('#TimeDisplayvalue').val(time);
    }

    // Close the dropdown if clicked outside
    $(document).click(function(event) {
        if (!$(event.target).closest('#timeDropdown, .ms-2').length) {
            $('#timeDropdown').hide();
        }
    });

    // Trigger the time dropdown on icon click
    $('.ms-2').on('click', function() {
        toggleTimeDropdown();
    });

    function triggerDatePicker() {
        const dateInput = document.getElementById('selectedDate');
        document.getElementById('selectedDate').showPicker();
    }
    $(document).ready(function() {
        // Initialize datepicker for the input field
        $('#dateInput').datepicker({
            format: 'mm/dd/yyyy',
            todayBtn: 'linked',
            autoclose: true
        });

        // Trigger the datepicker when the calendar icon is clicked
        $('.bi-calendar4-week').click(function() {
            $('#dateInput').datepicker('show');
        });

        // Initialize the current date display
        const now = new Date();
        const optionsDay = {
            weekday: 'long'
        };
        const optionsDate = {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        };

        $('#dayDisplay').text(now.toLocaleDateString('en-US', optionsDay));
        $('#dateDisplay').text(now.toLocaleDateString('en-US', optionsDate));

        // Update date and day display when the date input changes
        $('#selectedDate').on('change', function() {
            const selectedDate = new Date(this.value);
            $('#dayDisplay').text(selectedDate.toLocaleDateString('en-US', optionsDay));
            $('#dateDisplay').text(selectedDate.toLocaleDateString('en-US', optionsDate));
        });
    });
    const guestSelect = document.getElementById('inputGuest');

    // Dynamically generate options from 1 to 7
    for (let i = 1; i <= 7; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        guestSelect.appendChild(option);
    }
    document.addEventListener('DOMContentLoaded', function() {
        let selectedDate = '';
        let selectedTime = '';


        // Call the initialization function when the page loads
        // window.onload = initializePage;
        // Confirm reservation button click event
        document.getElementById('ConfirmModal_Reservation').addEventListener('click', function() {
            let name = document.getElementById('inputName').value;
            let email = document.getElementById('inputEmail').value;
            let mobile = document.getElementById('inputMobile').value;
            let guests = document.getElementById('inputGuest').value;
            let selectedDate = new Date(document.getElementById('selectedDate')
                .value); // Convert to Date object
            let selectedTime = document.getElementById('TimeDisplayvalue').value;


            if (name && email && mobile && guests && selectedDate && selectedTime) {
                let now = new Date();
                let today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate < today) {
                    showWarningMessage('Reservation is not available for past times.',
                        'Warning Message');
                    return;
                }

                if (selectedDate.toDateString() === now.toDateString()) {
                    // Convert selectedTime to 24-hour format
                    let [time, period] = selectedTime.split(' ');
                    let [selectedHour, selectedMinute] = time.split(':').map(Number);

                    if (period === 'PM' && selectedHour !== 12) selectedHour += 12;
                    if (period === 'AM' && selectedHour === 12) selectedHour = 0;

                    let selectedDateTime = new Date(selectedDate);
                    selectedDateTime.setHours(selectedHour, selectedMinute, 0,
                        0); // Set selected time on the date

                    // Check if selected time is in the past
                    if (selectedDateTime <= now) {
                        showWarningMessage('Reservation is not available for past times.',
                            'Warning Message');
                        return;
                    }
                }


                showConfirmModal();
            } else {
                showWarningMessage('Please Enter the details', 'Details of Reservation Missing');
            }
        });

        function showConfirmModal() {
            const confirmModal = document.getElementById('ConfirmModal');
            if (confirmModal) {
                confirmModal.addEventListener('show.bs.modal', function() {
                    updateConfirmModalContent();
                });

                $('#ConfirmModal').modal('show');
            }
        }

        function updateConfirmModalContent() {
            const confirmModal = document.getElementById('ConfirmModal');
           
            let name = document.getElementById('inputName').value;
            let email = document.getElementById('inputEmail').value;
            let mobile = document.getElementById('inputMobile').value;
            let guests = document.getElementById('inputGuest').value;
            let selectedDate = new Date(document.getElementById('selectedDate')
                .value); // Convert to Date object
            let selectedTime = document.getElementById('TimeDisplayvalue').value;


            const modalTitle = confirmModal.querySelector('.modal-title');
            const modalBodyDate = confirmModal.querySelector('#modalDate');
            const modalBodyTime = confirmModal.querySelector('#selectedTime');
            const modalBodyMonth = confirmModal.querySelector('#modalMonth');
            const modalBodyYear = confirmModal.querySelector('#modalYear');
            const modalBodyDay = confirmModal.querySelector('#modalDay');
            const modalBodyName = confirmModal.querySelector('#modalName');
            const modalBodyEmail = confirmModal.querySelector('#modalEmail');
            const modalBodyMobile = confirmModal.querySelector('#modalMobile');
            const modalBodyGuests = confirmModal.querySelector('#modalGuests');

            if (modalTitle) modalTitle.textContent = 'Please re-Confirm the details for reservation';

            if (modalBodyDate) modalBodyDate.textContent =
                `${selectedDate.getDate().toString().padStart(2, '0')} ${selectedDate.getFullYear()}`;
            if (modalBodyTime) modalBodyTime.textContent = selectedTime;
            if (modalBodyMonth) modalBodyMonth.textContent = selectedDate.toLocaleString('default', {
                month: 'long'
            });
            if (modalBodyYear) modalBodyYear.textContent = selectedDate.getFullYear();
            if (modalBodyDay) modalBodyDay.textContent = selectedDate.toLocaleString('default', {
                weekday: 'long'
            });
            if (modalBodyName) modalBodyName.textContent = name;
            if (modalBodyEmail) modalBodyEmail.textContent = email;
            if (modalBodyMobile) modalBodyMobile.textContent = mobile;
            if (modalBodyGuests) modalBodyGuests.textContent = guests;
        }

        function showWarningMessage(message, title) {
            $('#WarningModal').modal('show');
            $('#WarningModal').find('.modal-body').text(message).css({
                'color': 'black',
                'font-size': '16px'
            });
            $('#WarningModal').find('.modal-header').text(title).css({
                'color': 'Red',
                'font-size': '16px'
            });
        }

        function convertTo24HourFormat(time) {
            const [hourMinute, period] = time.split(' '); // Split the time into hour and AM/PM
            let [hour, minute] = hourMinute.split(':').map(Number);

            if (period === 'PM' && hour !== 12) {
                hour += 12; // Convert PM times (except 12) to 24-hour format
            } else if (period === 'AM' && hour === 12) {
                hour = 0; // Convert 12 AM to 00 hours
            }

            
            return `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
        }

        function handleSaveReservation() {
            let name = document.getElementById('inputName').value;
            let email = document.getElementById('inputEmail').value;
            let mobile = document.getElementById('inputMobile').value;
            let guests = document.getElementById('inputGuest').value;
            let selectedDate = new Date(document.getElementById('selectedDate').value);
            let selectedTime = document.getElementById('TimeDisplayvalue').value;
            let time24Hour = convertTo24HourFormat(selectedTime);
            let reservationTime = time24Hour;
            const reservationDate = selectedDate || new Date().toISOString().split('T')[0];

            console.log('selectedDate', selectedDate);
            const year = reservationDate.getFullYear();
            const month = (reservationDate.getMonth() + 1).toString().padStart(2, '0');
            const day = reservationDate.getDate().toString().padStart(2, '0');

            const formattedDateTime = `${year}-${month}-${day}`;

            const data = {
                name: name,
                email: email,
                mobile: mobile,
                guests: guests,
                reservation_time: reservationTime,
                reservation_date: formattedDateTime
            };

            $('#modalFooter_ConfirmModal').hide();
            $('#loading').show();

            $.ajax({
                url: '/Save_Reservation',
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    console.log(response);
                    const message_title = response.status ?
                        'Email activation required: Please check your email' :
                        'Please wait booking confirmation ';
                    const message_Boody_head = response.status ? `Hi ${name}` : `Hi ${name}`;
                    const message_Boody_desc = response.status ?
                        'We sent you an email with an activation link. Please check your inbox (and spam/junk folder) to complete your table booking.' :
                        'Thank you for your booking request! We are currently processing it and you’ll receive an email from us once your booking has been confirmed.';
                    const message_Boody_desc1 = response.status ?
                        '' :
                        'If you have any questions in the meantime, feel free to reach out at (+971) 56 418 4244. We appreciate your patience and look forward to welcoming you soon!';

                    const message_Boody_footer = response.status ? 'Thank you!' : 'Thank you!';



                    const message = response.status ?
                        message_Boody_desc :
                        'Reservation was successful!';

                    $('#ConfirmModal').modal('hide');
                    $('#ConfirmReplayModal').find('.ConfirmReplay_head').text(message_Boody_head);
                    $('#ConfirmReplayModal').find('.ConfirmReplay_Message').text(
                        message_Boody_desc);
                    $('#ConfirmReplayModal').find('.ConfirmReplay_Message2').text(
                        message_Boody_desc1);
                    $('#ConfirmReplayModal').find('.modal-header').text(message_title);
                    $('#ConfirmReplayModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                },
                complete: function() {
                    $('#loading').hide();
                    $('#modalFooter_ConfirmModal').show();
                }
            });
        }

        document.getElementById('Reservation_Save').addEventListener('click', handleSaveReservation);

        function validateMobileNumber(mobile) {
            const mobilePattern = /^0\d{9}$/;
            return mobilePattern.test(mobile);
        }

        document.getElementById('inputMobile').addEventListener('input', function() {
            const inputValue = this.value;
            const errorMessageElement = document.getElementById('mobileError');
            const reservationButton = document.getElementById('ConfirmModal_Reservation');

            if (!validateMobileNumber(inputValue)) {
                errorMessageElement.textContent =
                    'Please enter a valid 10-digit mobile number [starting with 0]';
                reservationButton.disabled = true;
            } else {
                errorMessageElement.textContent = '';
                reservationButton.disabled = false;
            }
        });

        document.getElementById('reservation_close').addEventListener('click', function() {
            window.location.reload();
        });

        document.getElementById('Reservation_Modify').addEventListener('click', function() {
            // Handle modification if needed
        });
    });

    $(document).ready(function() {
        $('#ConfirmModal').modal({
            backdrop: 'static',
            keyboard: false
        });


        $('#ConfirmModal').on('click', function(event) {
            var $target = $(event.target);
            if ($target.hasClass('modal')) {
                event.stopPropagation();
            }
        });



    });
    $(document).ready(function() {
        $('#ConfirmReplayModal').modal({
            backdrop: 'static',
            keyboard: false
        });


        $('#ConfirmReplayModal').on('click', function(event) {
            var $target = $(event.target);
            if ($target.hasClass('modal')) {
                event.stopPropagation();
            }
        });



    });
    $(document).ready(function() {
        $('#WarningModal').modal({
            backdrop: 'static',
            keyboard: false
        });


        $('#WarningModal').on('click', function(event) {
            var $target = $(event.target);
            if ($target.hasClass('modal')) {
                event.stopPropagation();
            }
        });



    });
    $(document).ready(function() {
        $('#inputEmail').on('blur', function() {
            var email = $(this).val();
            var mobile = $('#inputMobile').val();

            if (email) {
                $.ajax({
                    url: '/check-email-status',
                    type: 'POST',
                    data: {
                        email: email,
                        mobile: mobile,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(response) {
                        $('#emailverified').text(response.email_status === 'verified' ?
                            'Email is verified.' : '');
                        $('#emailnotverified').text(response.email_status ===
                            'not_verified' ? 'Email is not verified.' : '');

                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#emailverified').text('');
                $('#emailnotverified').text('');
            }
        });
    });
    // document.getElementById('selectedDate').addEventListener('click', function() {
    //     document.getElementById('calendar').style.display = 'block';
    // });
</script>
<?php /**PATH C:\xampp\htdocs\Restaurants\resources\views\Frontend\Reservation\reservationscript.blade.php ENDPATH**/ ?>