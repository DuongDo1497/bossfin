<?php $__env->startSection('panel'); ?>
    <div class="page-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/layouts/frontend.blade.php ENDPATH**/ ?>