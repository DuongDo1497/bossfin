<?php
    $content = getContent('breadcrumb.content', true);
?>

<section class="inner-page-hero bg_img" data-background="<?php echo e(getImage('assets/images/frontend/breadcrumb/' . @$content->data_values->image, '730x465')); ?>">
    <div class="bottom-shape"><img src="<?php echo e(asset($activeTemplateTrue . 'images/top-shape.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2 class="page-title"><?php echo e(__($pageTitle)); ?></h2>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/partials/breadcrumb.blade.php ENDPATH**/ ?>