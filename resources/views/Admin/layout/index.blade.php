<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Quincedubai</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="{{URL::to('assets/img/Q.png')}}" rel="icon">
  <link href="{{URL::to('assets/img/Q.png')}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="{{URL::to('https://fonts.googleapis.com')}}" rel="preconnect">
  <link href="{{URL::to('https://fonts.gstatic.com')}}" rel="preconnect" crossorigin>
  <link
    href="{{URL::to('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap')}}"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{URL::to('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{URL::to('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{URL::to('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <!-- <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet"> -->

  <!-- Main CSS File -->
  <link href="{{URL::to('assets/css/main.css')}}" rel="stylesheet">


</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center">
    <div class="container-fluid">

      <div class="row ps-5 pt-4">
        
        <div class="col-12 d-flex " style="display: flex;">
          <a href="index.html" class="logo d-flex ">
            <img src="{{URL::to('assets/img/Quince-brand.png')}}" alt="">
            <!-- <h1 class="sitename">Quince</h1> -->
          </a>
        </div>

      </div>










    </div>
  </header>

  <main class="main ">



  @yield('content') 


  </main>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i
      class="bi bi-arrow-up-short"></i>
    </a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{URL::to('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <script src="{{URL::to('assets/vendor/aos/aos.js')}}"></script>
  <!-- <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script> -->

  <!-- Main JS File -->
  <script src="{{URL::to('assets/js/main.js')}}"></script>
 

</body>

</html>
   
   




