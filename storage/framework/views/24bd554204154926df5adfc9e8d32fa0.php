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


<?php $__env->startSection('content'); ?>
    <section id="assigntable" class="assigntable">

        <div class="container">
            <div class="row">

                <div class="col-12 mb-5">

                    

                </div>
                <form action="<?php echo e(route('admin.addnewreservation')); ?>" method="POST">

                    <?php echo csrf_field(); ?>
                    <div class="col-12">
                        

                        <div class="row ">
                            <div class="col-6">

                                <div class="row gy-1">
                                    <div class="col-lg-12 ">

                                        <div class="row ">
                                            <label for="Mobile" class="col-4 col-form-label">Mobile</label>
                                            <div class="col-8">
                                                <input type="text"
                                                    class="form-control <?php $__errorArgs = ['Mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    id="inputMobile" placeholder="05X XXX XXXX" name="Mobile"
                                                    value="<?php echo e(old('Mobile')); ?>">
                                                <?php $__errorArgs = ['Mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="row ">
                                            <label for="Name" class="col-4 col-form-label">Name</label>
                                            <div class="col-8">
                                                <input type="text"
                                                    class="form-control <?php $__errorArgs = ['Name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputName"
                                                    name="Name" value="<?php echo e(old('Name')); ?>">
                                                <?php $__errorArgs = ['Name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="Email" class="col-4 col-form-label">Email</label>
                                            <div class="col-8">
                                                <input type="email"
                                                    class="form-control <?php $__errorArgs = ['Email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    id="inputEmail" name="Email" value="<?php echo e(old('Email')); ?>">
                                                <?php $__errorArgs = ['Email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="row ">
                                            <label for="Guest" class="col-4 col-form-label">No. of Guest</label>
                                            <div class="col-8">
                                                <input type="text"
                                                    class="form-control <?php $__errorArgs = ['Guest'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    id="inputGuest" name="Guest" value="<?php echo e(old('Guest')); ?>">
                                                <?php $__errorArgs = ['Guest'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        


                                        

                                    </div>

                                    <div class="col-12 mt-4">
                                        <div id='calendar'></div>

                                    </div>


                                    



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
  


    <script src="<?php echo e(URL::to('https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js')); ?>"></script>
    
    



    


    

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
                _token: '<?php echo e(csrf_token()); ?>'
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
                        url: "<?php echo e(route('autocomplete.mobile')); ?>",
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
    


    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Restaurants\resources\views/Admin/Reservation/add_reservation.blade.php ENDPATH**/ ?>