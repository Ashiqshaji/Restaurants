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

    .text-gray-800 {
        --tw-text-opacity: 1;
        color: rgb(203 152 43);
    }
</style>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        

        <!-- Page Heading -->
        <?php if(isset($header)): ?>
            <header class="bg-Black shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <!-- Page Content -->
        <main>
            <?php echo e($slot); ?>

        </main>
    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\Restaurants\resources\views\layouts\app.blade.php ENDPATH**/ ?>