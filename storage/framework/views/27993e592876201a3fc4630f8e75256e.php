
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">

            <div class="col-12">
                <h5>
                    <?php echo e(__('Dashboard')); ?>

                </h5>
            </div>
            <div class="col-12">


                <ul class="nav nav-underline">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" style="color: white">User Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('profile.edit')); ?>" style="color: white"><?php echo e(__('Profile')); ?></a>
                    </li>

                </ul>
            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Restaurants\resources\views\Admin\layout\dashboard.blade.php ENDPATH**/ ?>