<?php $__env->startComponent('mail::message'); ?>
    # QUINCE Booking confirmation


    QUINCE BOOKING CONFIRMATION

    Dear <?php echo e($data['Name']); ?>,

    We are pleased to confirm your booking as follows:

    Booking Details:

    Date : <?php echo e($data['Date']); ?>

    Time : <?php echo e($data['Time']); ?>

    No of Guests : <?php echo e($data['People']); ?>


    Table Number(s) : <?php echo e(implode(', ', $data['Table']->pluck('table_no')->filter()->toArray())); ?>



    If you have any questions or need to make changes to your booking,
    please do not hesitate to contact us at (+971) 56 418 4244.

    We look forward to serving you!


    Thanks,
    <?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\Restaurants\resources\views/Email/confrmation.blade.php ENDPATH**/ ?>