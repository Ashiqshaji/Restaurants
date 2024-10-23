<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Quincedubai</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Favicons -->
    <link href="<?php echo e(URL::to('assets/img/Q.png')); ?>" rel="icon">
    <link href="<?php echo e(URL::to('assets/img/Q.png')); ?>" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="<?php echo e(URL::to('https://fonts.googleapis.com')); ?>" rel="preconnect">
    <link href="<?php echo e(URL::to('https://fonts.gstatic.com')); ?>" rel="preconnect" crossorigin>
    <link
        href="<?php echo e(URL::to('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap')); ?>"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo e(URL::to('assets/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::to('assets/vendor/bootstrap-icons/bootstrap-icons.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::to('assets/vendor/aos/aos.css')); ?>" rel="stylesheet">
    <!-- <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet"> -->

    <!-- Main CSS File -->
    <link href="<?php echo e(URL::to('assets/css/main.css')); ?>" rel="stylesheet">



    <link href="<?php echo e(URL::to('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(URL::to('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css')); ?>"
        rel="stylesheet">


    <link
        href="<?php echo e(URL::to('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css')); ?>"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    

    <!-- Include jQuery UI for Autocomplete -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


</head>

<style>
    i.bi.bi-gear {
        font-size: 20px;
        color: #cb982b;
    }

    .user-icon a {
        color: #ce972c;
        text-decoration: none;
        transition: 0.3s;
    }

    #user-icon .btn-check:checked+.btn,
    .btn.active,
    .btn.show,
    .btn:first-child:active,
    :not(.btn-check)+.btn:active {
        border-color: black;
    }

    #user-icon .btn:hover {
        color: var(--bs-btn-hover-color);
        background-color: var(--bs-btn-hover-bg);
        border-color: black;
    }

    .manully-adding {
        display: flex;
        align-items: center;
    }

    i.bi.bi-plus-square {
        font-size: 25px;
    }
</style>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center">
        <div class="container">

            <div class="row pt-4 pb-4">

                <div class="col-8 d-flex " style="display: flex;">
                    <a href="<?php echo e(route('admin.reservationlist')); ?>" class="logo d-flex ">
                        <img src="<?php echo e(URL::to('assets/img/Quince-brand.png')); ?>" alt="">
                        <!-- <h1 class="sitename">Quince</h1> -->
                    </a>
                </div>



                <div class="col-4" style="display: flex;flex-direction: row-reverse;">
                    <div class="user-icon" id="user-icon" style="padding: 0px 0px 0px 0px;">
                        <div class="btn-group">
                            <button class="btn  " type="button" data-bs-toggle="dropdown" data-bs-auto-close="true"
                                aria-expanded="false">
                                <i class="bi bi-gear"></i>

                            </button>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item"
                                        href="<?php echo e(route('profile.edit')); ?>"><?php echo e(__('Profile')); ?></a>
                                </li>
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>

                                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            <?php echo e(__('Log Out')); ?>

                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>








                    </div>


                </div>




            </div>










        </div>
    </header>

    <main class="main ">



        <?php echo $__env->yieldContent('content'); ?>


    </main>


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?php echo e(URL::to('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

    <script src="<?php echo e(URL::to('assets/vendor/aos/aos.js')); ?>"></script>
    <!-- <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script> -->

    <!-- Main JS File -->
    <script src="<?php echo e(URL::to('assets/js/main.js')); ?>"></script>

    <script src="<?php echo e(URL::to('https://code.jquery.com/jquery-3.7.1.js')); ?>"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script
        src="<?php echo e(URL::to('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js')); ?>">
    </script>

    <script src="<?php echo e(URL::to('https://cdn.jsdelivr.net/npm/flatpickr')); ?>"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\Restaurants\resources\views/Admin/layout/index.blade.php ENDPATH**/ ?>