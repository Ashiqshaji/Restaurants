<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<style>
    .bg-gray-100 {
        --tw-bg-opacity: 1;
        background-color: black !important;
    }

    .text-gray-700 {
        --tw-text-opacity: 1;
        color: rgb(203 152 43);
    }

    .bg-gray-800 {
        --tw-bg-opacity: 1;
        background-color: rgb(203 152 43);
    }

    .active\:bg-gray-900:active {
        --tw-bg-opacity: 1;
        background-color: rgb(203 152 43);
    }

    .focus\:ring-indigo-500:focus {
        --tw-ring-opacity: 1;
        --tw-ring-color: rgb(203 152 43);
    }
</style>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                
                <img src="<?php echo e(URL::to('assets/img/Quince-brand.png')); ?>" alt="">
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <?php echo e($slot); ?>

        </div>
    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\Restaurants\resources\views\layouts\guest.blade.php ENDPATH**/ ?>