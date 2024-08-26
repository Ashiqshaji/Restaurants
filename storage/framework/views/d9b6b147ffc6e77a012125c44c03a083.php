<?php $__env->startComponent('mail::message'); ?>
    # QUINCE New  Booking 

    Dear Teams,

    Booking Details:
    Name :  <?php echo e($data['Name']); ?> 
    Date : <?php echo e($data['Date']); ?>

    Time : <?php echo e($data['Time']); ?>

    No of Guests : <?php echo e($data['People']); ?>


    Thanks,
    <?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\Restaurants\resources\views\Email\confrmationnew.blade.php ENDPATH**/ ?>