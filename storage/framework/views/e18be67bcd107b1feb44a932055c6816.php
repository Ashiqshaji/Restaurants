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


</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center">
    <div class="container ">

      <div class="row">
        
        <div class="col-12 d-flex align-items-center" style="display: flex;justify-content: space-around;">
          <a href="#" class="logo d-flex ">
            <img src="<?php echo e(URL::to('assets/img/Quince-brand.png')); ?>" alt="">
            <!-- <h1 class="sitename">Quince</h1> -->
          </a>
        </div>

      </div>


    </div>
  </header>

  <main class="main ">



  <?php echo $__env->yieldContent('content'); ?> 


  </main>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i
      class="bi bi-arrow-up-short"></i>
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
 

</body>

</html>
   
   




<?php /**PATH C:\xampp\htdocs\Restaurants\resources\views/Frontend/Layout/index.blade.php ENDPATH**/ ?>