<?php
    $content = getContent('feature.content', true);
    $element = getContent('feature.element', null, false, true);
?>
<!-- feature section start -->
<section class="pt-120 pb-120 position-relative">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-left">
                <div class="section-header">
                    <h2 class="section-title"><?php echo e(__($content->data_values->heading)); ?></h2>
                    <p><?php echo e(__($content->data_values->subheading)); ?></p>
                </div>
            </div><!-- row end -->
            <div class="col-lg-8">
                <div class="row gy-4">
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $el): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
                            <div class="feature-card">
                                <div class="feature-card__icon"><?php echo $el->data_values->icon; ?></div>
                                <div class="feature-card__content">
                                    <h4 class="title"><?php echo e(__($el->data_values->title)); ?></h4>
                                    <p><?php echo e(__($el->data_values->description)); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/sections/feature.blade.php ENDPATH**/ ?>