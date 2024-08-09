<script src="{{URL::to('https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js')}}"></script>
<script src="{{URL::to('https://code.jquery.com/jquery-3.7.1.js')}}" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var selectedDate = '';
    var selectedTime = '';

    var calendarEl = document.getElementById('calendar');

    if (!calendarEl) {
      console.error('Calendar element not found.');
      return;
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      dayCellDidMount: function(info) {
        // Highlight today's date
        if (info.dateStr === new Date().toISOString().split('T')[0]) {
          info.el.classList.add('highlight-today');
        }
      },
      dateClick: function(info) {
        // Clear previously selected date
        document.querySelectorAll('.fc-daygrid-day').forEach(day => {
          day.classList.remove('selected-date');
        });

        // Add class to the selected date
        const selectedDateEl = document.querySelector(`.fc-daygrid-day[data-date="${info.dateStr}"]`);
        if (selectedDateEl) {
          selectedDateEl.classList.add('selected-date');
        }

        selectedDate = new Date(info.dateStr);
        const selectedDateValue = info.dateStr;
        const dayOfWeek = selectedDate.toLocaleString('default', {
          weekday: 'long'
        }); // Get the day of the week
        const month = selectedDate.toLocaleString('default', {
          month: 'long'
        });
        const year = selectedDate.getFullYear();
        const dayOfMonth = selectedDate.getDate().toString().padStart(2, '0'); // Get day of the month, padded to 2 digits



        // Check if modal elements exist and update their content
        const modalDateEl = document.getElementById('modalDate');
        const modalMonthEl = document.getElementById('modalMonth');
        const modalYearEl = document.getElementById('modalYear');
        const modalDayEl = document.getElementById('modalDay');

        if (modalDateEl) modalDateEl.textContent = selectedDateValue;
        if (modalMonthEl) modalMonthEl.textContent = month;
        if (modalYearEl) modalYearEl.textContent = year;
        if (modalDayEl) modalDayEl.textContent = dayOfWeek;

        fetchTimeSlots(selectedDate);
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

    function getWeekNumber(date) {
      const startOfYear = new Date(date.getFullYear(), 0, 1);
      const pastDaysOfYear = (date - startOfYear) / 86400000;
      return Math.ceil((pastDaysOfYear + startOfYear.getDay() + 1) / 7);
    }

    function fetchTimeSlots(date) {


      // $.ajax({
      //     url: '/get-time-slots',
      //     method: 'GET',
      //     data: { date: date },
      //     success: function(response) {
      //         updateTimeSlotDisplay(response.timeSlots);
      //     }
      // });
    }
    document.querySelectorAll('.time-slot-btn').forEach(function(btn) {
      btn.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior

        // Remove the 'btn-danger-reser' class from all buttons
        document.querySelectorAll('.time-slot-btn').forEach(function(button) {
          button.classList.remove('btn-danger-reser');
        });

        // Add the 'btn-danger-reser' class to the clicked button to mark it as red
        this.classList.add('btn-danger-reser');

        // Get the selected time from the data-time attribute
        selectedTime = this.getAttribute('data-time');

        // Check if selectedTime element exists
        const selectedTimeEl = document.getElementById('selectedTime');
        if (selectedTimeEl) {
          selectedTimeEl.textContent = selectedTime;
        }
      });
    });


    const ConfirmModal = document.getElementById('ConfirmModal');

    if (ConfirmModal) {
      ConfirmModal.addEventListener('show.bs.modal', function(event) {
        // Update the modal's content.

        let name = document.getElementById('inputName').value;
        let email = document.getElementById('inputEmail').value;
        let mobile = document.getElementById('inputMobile').value;
        let guests = document.getElementById('inputGuest').value;

        if (name && email && mobile && guests && selectedDate && selectedTime) {
          const modalTitle = ConfirmModal.querySelector('.modal-title');
          const modalBodyDate = ConfirmModal.querySelector('#modalDate');
          const modalBodyTime = ConfirmModal.querySelector('#selectedTime');
          const modalBodyMonth = ConfirmModal.querySelector('#modalMonth');
          const modalBodyYear = ConfirmModal.querySelector('#modalYear');
          const modalBodyDay = ConfirmModal.querySelector('#modalDay');

          const modalBodyName = ConfirmModal.querySelector('#modalName');
          const modalBodyEmail = ConfirmModal.querySelector('#modalEmail');
          const modalBodyMobile = ConfirmModal.querySelector('#modalMobile');
          const modalBodyGuests = ConfirmModal.querySelector('#modalGuests');





          if (modalTitle) modalTitle.textContent = 'Please re-Confirm the details for reservation';
          if (modalBodyDate) modalBodyDate.textContent = `${selectedDate.getDate().toString().padStart(2, '0')} ${selectedDate.getFullYear()}`;
          if (modalBodyTime) modalBodyTime.textContent = selectedTime;
          if (modalBodyMonth) modalBodyMonth.textContent = document.getElementById('modalMonth').textContent;
          if (modalBodyYear) modalBodyYear.textContent = document.getElementById('modalYear').textContent;
          if (modalBodyDay) modalBodyDay.textContent = document.getElementById('modalDay').textContent;
          if (modalBodyName) modalBodyName.textContent = name ? name : 'No name provided';
          if (modalBodyEmail) modalBodyEmail.textContent = email ? email : 'No email provided';
          if (modalBodyMobile) modalBodyMobile.textContent = mobile ? mobile : 'No mobile number provided';
          if (modalBodyGuests) modalBodyGuests.textContent = guests ? guests : 'Number of guests not specified';

        } else {

          $('#ConfirmModal').modal('hide');


          const Reservation_Save = document.getElementById('Reservation_Save');
          Reservation_Save.style.display = 'none';
          alert('Please fill out all fields.');

          message = 'Please Enter the details';
          message1 = 'Details of Reservation Missing';


          $('#ConfirmModal').find('.modal-body')
            .text(message)
            .css({
              'color': 'black',
              'font-size': '16px'
            });
          $('#ConfirmModal').find('.modal-header').text(message1).css({
            'color': 'black',
            'font-size': '16px'
          });


        }


      });
    }

    document.getElementById('Reservation_Save').addEventListener('click', function() {


      let name = document.getElementById('inputName').value;
      let email = document.getElementById('inputEmail').value;
      let mobile = document.getElementById('inputMobile').value;
      let guests = document.getElementById('inputGuest').value;

      let reservation_time = selectedTime;
      const reservation_date = selectedDate;

      const year = reservation_date.getFullYear();
      const month = (reservation_date.getMonth() + 1).toString().padStart(2, '0');
      const day = reservation_date.getDate().toString().padStart(2, '0');

      const loading = document.getElementById('modalFooter_ConfirmModal');
      loading.style.display = 'none';

      const loading2 = document.getElementById('loading');
      loading2.style.display = 'flex';


      const formattedDateTime = `${year}-${month}-${day}`;

      const data = {
        name: name,
        email: email,
        mobile: mobile,
        guests: guests,
        reservation_time: reservation_time,
        reservation_date: formattedDateTime,
      };


      $.ajax({
        url: '/Save_Reservation',
        type: 'POST',
        data: data,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {

          console.log(response.email_status);
          if (response != null || response != '') {

            message = 'To confirm your e-email,please click on the link we sent to your email address';
          } else {

            message = 'Reservation was successful!';
          }

          $('#ConfirmModal').modal('hide');


          $('#ConfirmReplayModal').find('.ConfirmReplay_Message').text(message);


          $('#ConfirmReplayModal').modal('show');

          console.log('Success:', response);

        },
        error: function(xhr, status, error) {
          // Handle the error
          console.error('Error:', error);
        }
      });
    });
    document.getElementById('reservation_close').addEventListener('click', function() {
      // Refresh the page when the button is clicked
      window.location.reload();
    });
    document.getElementById('Reservation_Modify').addEventListener('click', function() {
      // Refresh the page when the button is clicked
      window.location.reload();
    });

    function validateMobileNumber(mobile) {

      const mobilePattern = /^[0-9]{9}$/;


      if (mobilePattern.test(mobile)) {
        console.log('Valid mobile number');
        return true;
      } else {
        console.log('Invalid mobile number');
        return false;
      }
    }

    document.getElementById('inputMobile').addEventListener('input', function() {
      // Get the current value from the input field
      let inputValue = this.value;

      // Show an alert with the current value


      let errorMessageElement = document.getElementById('mobileError');
    let reservationButton = document.getElementById('ConfirmModal_Reservation');

    if (!validateMobileNumber(inputValue)) {
        errorMessageElement.textContent = 'Please enter a valid 9-digit mobile number';
        reservationButton.disabled = true; // Disable the button
    } else {
        errorMessageElement.textContent = ''; // Clear the error message
        reservationButton.disabled = false; // Enable the button
    }



    });
  });

  $(document).ready(function() {
  $('#ConfirmModal').modal({
    backdrop: 'static',
    keyboard: false
  });

  // Ensure that the modal cannot be closed by clicking outside
  $('#ConfirmModal').on('click', function(event) {
    var $target = $(event.target);
    if ($target.hasClass('modal')) {
      event.stopPropagation();
    }
  });
});
</script>