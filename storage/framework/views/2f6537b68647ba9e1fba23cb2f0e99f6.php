<?php $__env->startSection('content'); ?>
    <style>
        h1,
        h5 {
            color: #888;
        }

        .border-success {
            --bs-border-opacity: 1;
            border-color: black !important;
        }
    </style>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="border border-3 border-success"></div>
            <div class="card text-center shadow p-5" style="background-color: black;">
                <div class="mb-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75" fill="#c49429"
                        class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                    </svg>
                </div>
                <div class="text-center " style="color:black">
                    <h1>Thank You !</h1>
                    <h5>Email verified</h5>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Frontend.Layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Restaurants\resources\views/Email/Thankyou.blade.php ENDPATH**/ ?>