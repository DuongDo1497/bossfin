<?php
    $content = getContent('cta.content', true);
?>
<section class="pt-120 pb-120 position-relative bg_img overlay-one" data-background="<?php echo e(getImage('assets/images/frontend/cta/' . $content->data_values->image)); ?>">
    <div class="bottom-shape"><img src="<?php echo e(asset($activeTemplateTrue . 'images/top-shape.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center pb-90">
                <h2 class="text-white"><?php echo e(__($content->data_values->heading)); ?></h2>
                <p class="text-white"><?php echo e(__($content->data_values->subheading)); ?></p>
                <a href="<?php echo e($content->data_values->button_url); ?>" class="cmn-btn my-5"><?php echo e(__($content->data_values->button_title)); ?></a>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/sections/cta.blade.php ENDPATH**/ ?>