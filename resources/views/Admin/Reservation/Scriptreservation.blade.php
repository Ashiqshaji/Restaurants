<script>
    document.addEventListener('DOMContentLoaded', function() {

        let currentTime = new Date();
        if (currentTime.getMinutes() >= 30) {
            currentTime.setHours(currentTime.getHours() + 1);
        }
        currentTime.setMinutes(0, 0, 0);


        const roundedTimeStr = currentTime.toTimeString().substring(0, 5);
        let activeCard = null;


        document.querySelectorAll('.time-slot-card').forEach(function(card) {
            const slotTime = card.getAttribute('data-time');

            if (roundedTimeStr === slotTime) {
                card.classList.add('active');
                activeCard = card;
            }


            card.addEventListener('click', function() {

                if (activeCard) {
                    activeCard.classList.remove('active');
                    activeCard = null;
                }

                if (card.classList.contains('clicked')) {
                    card.classList.remove('clicked');
                } else {

                    document.querySelectorAll('.time-slot-card').forEach(function(c) {
                        c.classList.remove('clicked');
                    });
                    card.classList.add('clicked');


                    let selectedTime = card.getAttribute('data-time');
                    let [hour, minute] = selectedTime.split(':');
                    let ampm = hour >= 12 ? 'PM' : 'AM';
                    hour = hour % 12 || 12;
                    hour = hour < 10 ? '0' + hour : hour;
                    let formattedTime = hour + ':' + minute + ' ' + ampm;


                    let date_page = document.getElementById('page_date').value;



                    $.ajax({
                        url: '/Each-timeslot',
                        method: 'post',
                        data: {
                            time: formattedTime,
                            date: date_page,
                            _token: '{{ csrf_token() }}'
                        },
                        beforeSend: function() {

                            $('#preloader1').show();
                        },
                        success: function(response) {

                            $('#list_date_reservation').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error: ', error);
                        },
                        complete: function() {

                            $('#preloader1').hide();
                        }
                    });

                }
            });
        });

        // $('#datepicker').on('changeDate', function() {
        //     var selectedDate = $(this).datepicker('getFormattedDate');
        //     // Do something with the selected date
        //     console.log("Selected Date: " + selectedDate);
        // });
    });
    // document.addEventListener('DOMContentLoaded', function() {

    //     flatpickr("#datePicker", {
    //         dateFormat: "Y-m-d",
    //         onChange: function(selectedDates, dateStr, instance) {

    //             alert("Selected date: " + dateStr);

    //             $.ajax({
    //                 url: '/each-date',
    //                 method: 'POST',
    //                 data: {
    //                     time: dateStr,
    //                     _token: '{{ csrf_token() }}'
    //                 },
    //                 beforeSend: function() {

    //                     $('#preloader1').show();
    //                 },
    //                 success: function(response) {

    //                     console.log(response);
    //                     // $('#list_date_reservation').html(response);
    //                 },
    //                 error: function(xhr, status, error) {
    //                     console.error('AJAX error: ', error);
    //                 },
    //                 complete: function() {

    //                     $('#preloader1').hide();
    //                 }
    //             });


    //         }
    //         responsive: true
    //     });


    //     document.getElementById('showCalendar').addEventListener('click', function() {
    //         const dateInput = document.getElementById('datePicker');
    //         dateInput.focus();
    //     });
    // });

    // document.addEventListener('DOMContentLoaded', function() {

    //     flatpickr("#datePicker", {
    //         dateFormat: "Y-m-d",
    //         onChange: function(selectedDates, dateStr, instance) {

    //             alert("Selected date: " + dateStr);

    //             window.location.href = "/each-date/" + dateStr;

    //         },

    //         responsive: true
    //     });


    // });

    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#datePicker", {
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                $.ajax({
                    url: '/each-date',
                    method: 'POST',
                    data: {
                        Date: dateStr,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $('#preloader').addClass('show');
                    },
                    success: function(response) {
                        console.log(response);

                        var form = $('<form>', {
                            action: '/Admin-List',
                            method: 'get'
                        }).append($('<input>', {
                            type: 'hidden',
                            name: '_token',
                            value: '{{ csrf_token() }}'
                        })).append($('<input>', {
                            type: 'hidden',
                            name: 'data',
                            value: response
                        }));

                        $('body').append(form);
                        form.submit();
                    },
                    complete: function() {
                        $('#preloader').removeClass('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error: ', error);
                    }
                });
            },
            responsive: true
        });
    });
</script>
