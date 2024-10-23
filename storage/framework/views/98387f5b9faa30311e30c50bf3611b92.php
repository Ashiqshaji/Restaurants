<script src="<?php echo e(URL::to('https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('https://code.jquery.com/jquery-3.7.1.js')); ?>"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

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

            selectedDate = new Date(dateStr);
            updateModalDateInfo();
            fetchTimeSlots(selectedDate);
        }

        function updateModalDateInfo() {
            const modalDateEl = document.getElementById('modalDate');
            const modalMonthEl = document.getElementById('modalMonth');
            const modalYearEl = document.getElementById('modalYear');
            const modalDayEl = document.getElementById('modalDay');

            if (modalDateEl) modalDateEl.textContent = selectedDate.toISOString().split('T')[0];
            if (modalMonthEl) modalMonthEl.textContent = selectedDate.toLocaleString('default', {
                month: 'long'
            });
            if (modalYearEl) modalYearEl.textContent = selectedDate.getFullYear();
            if (modalDayEl) modalDayEl.textContent = selectedDate.toLocaleString('default', {
                weekday: 'long'
            });
        }

        function fetchTimeSlots(date) {
            // Add your AJAX call here
        }

        function handleTimeSlotSelection(event) {
            event.preventDefault();
            document.querySelectorAll('.time-slot-btn').forEach(button => {
                button.classList.remove('btn-danger-reser');
            });

            this.classList.add('btn-danger-reser');
            selectedTime = this.getAttribute('data-time');
            const selectedTimeEl = document.getElementById('selectedTime');
            if (selectedTimeEl) {
                selectedTimeEl.textContent = selectedTime;
            }
        }

        document.querySelectorAll('.time-slot-btn').forEach(btn => {
            btn.addEventListener('click', handleTimeSlotSelection);
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

        function formatTime(timeStr) {
            const time = new Date('1970-01-01T' + timeStr + 'Z'); // Create a date object using the time string
            const hours = time.getUTCHours(); // Get hours in 24-hour format
            const minutes = time.getUTCMinutes(); // Get minutes
            const ampm = hours >= 12 ? 'PM' : 'AM'; // Determine AM/PM
            const formattedHours = String(hours % 12 || 12).padStart(2,
                '0'); // Convert to 12-hour format with leading zero
            const formattedMinutes = String(minutes).padStart(2, '0'); // Format minutes with leading zero

            return `${formattedHours}:${formattedMinutes} ${ampm}`;
        }

        function updateConfirmModalContent() {
            const confirmModal = document.getElementById('ConfirmModal');
            let name = document.getElementById('inputName').value || 'No name provided';
            let email = document.getElementById('inputEmail').value || 'No email provided';
            let mobile = document.getElementById('inputMobile').value || 'No mobile number provided';
            let guests = document.getElementById('inputGuest').value || 'Number of guests not specified';

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
            if (modalBodyTime) modalBodyTime.textContent = formatTime(selectedTime);
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

        document.getElementById('ConfirmModal_Reservation').addEventListener('click', function() {
            let name = document.getElementById('inputName').value;
            let email = document.getElementById('inputEmail').value;
            let mobile = document.getElementById('inputMobile').value;
            let guests = document.getElementById('inputGuest').value;

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
                    let [selectedHour, selectedMinute] = selectedTime.split(':').map(Number);
                    let selectedDateTime = new Date(selectedDate);
                    selectedDateTime.setHours(selectedHour, selectedMinute, 0, 0);

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

        function handleSaveReservation() {
            let name = document.getElementById('inputName').value;
            let email = document.getElementById('inputEmail').value;
            let mobile = document.getElementById('inputMobile').value;
            let guests = document.getElementById('inputGuest').value;
            let reservationTime = selectedTime;
            const reservationDate = selectedDate;

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
</script>
<?php /**PATH C:\xampp\htdocs\Restaurants\resources\views/Frontend/Reservation/reservationscript.blade.php ENDPATH**/ ?>