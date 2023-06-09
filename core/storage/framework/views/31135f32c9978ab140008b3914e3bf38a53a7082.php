<?php
    $counterContent = getContent('counter.content', true);
    $counters = getContent('counter.element', limit: 4, orderById: true);
?>
<section>
    <div class="row g-0">
        <div class="col-lg-6 bg_img video-thumb-two min-height--block"
            data-background="<?php echo e(getImage('assets/images/frontend/counter/' . $counterContent->data_values->image, '730x465')); ?>">
            <a class="video-button" href="<?php echo e($counterContent->data_values->video_link); ?>" type="video/mp4"
                data-rel="lightcase:myCollection"><i class="las la-play"></i></a>
        </div>
        <div class="col-lg-6 pt-120 pb-120 position-relative bg--base text-md-left text-center">
            <div class="section-img"><img src="<?php echo e(getImage($activeTemplateTrue . 'images/texture-3.jpg')); ?>"
                    alt="<?php echo app('translator')->get('image'); ?>"></div>
            <div class="overview-area position-relative">
                <h2 class="section-title text-white"><?php echo e(__($counterContent->data_values->title)); ?></h2>
                <p class="text-white text-justify"><?php echo e(__($counterContent->data_values->description)); ?></p>
                <div class="row gy-4 mt-50">
                    <?php $__currentLoopData = $counters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-3 col-sm-3 col-6 mb-30">
                            <div class="counter-card position-relative z-1">
                                <div class="texture-bg"><img
                                        src="<?php echo e(getImage($activeTemplateTrue . 'images/texture-1.png')); ?>"></div>
                                <div class="counter-card__content">
                                    <span
                                        class="count-num color--<?php echo e($i + 1); ?>"><?php echo e($counter->data_values->digit); ?></span>
                                    <p class="text-dark"><?php echo e(__($counter->data_values->title)); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('style'); ?>
    <style>
        .color--1 {
            color: #13c366 !important;
        }

        .color--2 {
            color: #f32424 !important;
        }

        .color--3 {
            color: #b013c3 !important;
        }

        .color--4 {
            color: #1178d0 !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/sections/counter.blade.php ENDPATH**/ ?>