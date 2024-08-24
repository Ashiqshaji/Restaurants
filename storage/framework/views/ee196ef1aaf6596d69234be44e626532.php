<?php $__env->startComponent('mail::message'); ?>
    # Verify Your Email Address

    Dear <?php echo e($data['name']); ?>,

    Please click the button below to verify your email address.
   
    <?php $__env->startComponent('mail::button2', ['url' => $url]); ?>
        Clik here to Verify Email Address
    <?php echo $__env->renderComponent(); ?>


    If you did not create an account, no further action is required.

    Thanks
    <?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\Restaurants\resources\views\Email\verificationmail.blade.php ENDPATH**/ ?>