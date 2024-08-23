<script>
    // document.addEventListener('DOMContentLoaded', function() {

    //     let currentTime = new Date();
    //     if (currentTime.getMinutes() >= 1) {
    //         currentTime.setHours(currentTime.getHours() + 1);
    //     }
    //     currentTime.setMinutes(0, 0, 0);


    //     const roundedTimeStr = currentTime.toTimeString().substring(0, 5);
    //     let activeCard = null;


    //     let selectedTime = roundedTimeStr;


    //     document.querySelectorAll('.time-slot-card').forEach(function(card) {
    //         const slotTime = card.getAttribute('data-time');

    //         if (roundedTimeStr === slotTime) {
    //             card.classList.add('active');
    //             activeCard = card;
    //         }


    //         card.addEventListener('click', function() {

    //             if (activeCard) {
    //                 activeCard.classList.remove('active');
    //                 activeCard = null;
    //             }

    //             if (card.classList.contains('clicked')) {
    //                 card.classList.remove('clicked');
    //             } else {

    //                 document.querySelectorAll('.time-slot-card').forEach(function(c) {
    //                     c.classList.remove('clicked');
    //                 });
    //                 card.classList.add('clicked');


    //                 let selectedTime = card.getAttribute('data-time');
    //                 let [hour, minute] = selectedTime.split(':');
    //                 let ampm = hour >= 12 ? 'PM' : 'AM';
    //                 hour = hour % 12 || 12;
    //                 hour = hour < 10 ? '0' + hour : hour;
    //                 let formattedTime = hour + ':' + minute + ' ' + ampm;


    //                 let date_page = document.getElementById('page_date').value;

    //                 // let selectedTime = formattedTime;
    //                 let roundedTimeStr = formattedTime;

    //                 $.ajax({
    //                     url: '/Each-timeslot',
    //                     method: 'post',
    //                     data: {
    //                         time: formattedTime,
    //                         date: date_page,
    //                         _token: '<?php echo e(csrf_token()); ?>'
    //                     },
    //                     beforeSend: function() {

    //                         $('#preloader1').show();
    //                     },
    //                     success: function(response) {

    //                         $('#list_date_reservation').html(response);
    //                     },
    //                     error: function(xhr, status, error) {
    //                         console.error('AJAX error: ', error);
    //                     },
    //                     complete: function() {

    //                         $('#preloader1').hide();
    //                     }
    //                 });

    //             }
    //         });
    //     });

    //     document.getElementById('inputMobile').addEventListener('change', function() {
    //         let mobileNumber = this.value;

    //         // Get the date from the date picker or another element on the page
    //         let pageDate = document.getElementById('page_date').value;

    //         // Get the selected time, or use the default rounded current time
    //         let timeToPass = roundedTimeStr;

    //         alert(pageDate);

    //         alert(timeToPass);

    //         // $.ajax({
    //         //     url: '/search-mobile',
    //         //     method: 'POST',
    //         //     data: {
    //         //         mobile: mobileNumber,
    //         //         date: pageDate,
    //         //         time: timeToPass,
    //         //         _token: '<?php echo e(csrf_token()); ?>'
    //         //     },
    //         //     beforeSend: function() {
    //         //         $('#preloader').addClass('show');
    //         //     },
    //         //     success: function(response) {
    //         //         $('#mobile_search_results').html(response);
    //         //     },
    //         //     complete: function() {
    //         //         $('#preloader').removeClass('show');
    //         //     },
    //         //     error: function(xhr, status, error) {
    //         //         console.error('AJAX error: ', error);
    //         //     }
    //         // });
    //     });

    //     // $('#datepicker').on('changeDate', function() {
    //     //     var selectedDate = $(this).datepicker('getFormattedDate');
    //     //     // Do something with the selected date
    //     //     console.log("Selected Date: " + selectedDate);
    //     // });
    // });

    document.addEventListener('DOMContentLoaded', function() {

        let currentTime = new Date();
        if (currentTime.getMinutes() >= 1) {
            currentTime.setHours(currentTime.getHours() + 1);
        }
        currentTime.setMinutes(0, 0, 0);

        const roundedTimeStr = currentTime.toTimeString().substring(0, 5);
        let activeCard = null;

        let selectedTime = roundedTimeStr; // Update selected time
        let [hour, minute] = selectedTime.split(':');
        let ampm = hour >= 12 ? 'PM' : 'AM';
        hour = hour % 12 || 12;
        hour = hour < 10 ? '0' + hour : hour;
        selectedTime = hour + ':' + minute + ' ' + ampm; // Format the time

        // Initialize with the default rounded current time

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

                document.querySelectorAll('.time-slot-card').forEach(function(c) {
                    c.classList.remove('clicked');
                });

                card.classList.add('clicked');

                selectedTime = card.getAttribute('data-time'); // Update selected time
                let [hour, minute] = selectedTime.split(':');
                let ampm = hour >= 12 ? 'PM' : 'AM';
                hour = hour % 12 || 12;
                hour = hour < 10 ? '0' + hour : hour;
                selectedTime = hour + ':' + minute + ' ' + ampm; // Format the time

                let date_page = document.getElementById('page_date').value;

                $.ajax({
                    url: '/Each-timeslot',
                    method: 'post',
                    data: {
                        time: selectedTime,
                        date: date_page,
                        _token: '<?php echo e(csrf_token()); ?>'
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
            });
        });

        document.getElementById('inputMobile').addEventListener('input', function() {
            let mobileNumber = this.value;

            // Get the date from the date picker or another element on the page
            let pageDate = document.getElementById('page_date').value;

            // Use the selected time from the clicked time slot card
            let timeToPass = selectedTime;
            document.getElementById('preloader1').style.display = 'block';

            $.ajax({
                url: '/search-mobile-date',
                method: 'POST',
                data: {
                    mobile: mobileNumber,
                    date: pageDate,
                    time: timeToPass,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                beforeSend: function() {
                    $('#preloader1').addClass('show');
                },
                success: function(response) {
                    $('#list_date_reservation').html(response);
                },
                complete: function() {
                    $('#preloader1').removeClass('show');
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error: ', error);
                }
            });
        });
    });



    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#datePicker", {
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                $.ajax({
                    url: '/each-date',
                    method: 'POST',
                    data: {
                        Date: dateStr,
                        _token: '<?php echo e(csrf_token()); ?>'
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
                            value: '<?php echo e(csrf_token()); ?>'
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
<?php /**PATH C:\xampp\htdocs\Restaurants\resources\views/Admin/Reservation/Scriptreservation.blade.php ENDPATH**/ ?>