<?php
    $data    = getContent('success_story.content', true);
    $stories = App\Models\SuccessStory::orderBy('id', 'DESC')
        ->take(3)
        ->get();
?>
<!-- blog section start -->
<section class="pb-90 margin-top-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="section-header text-center">
                    <h2 class="section-title"><?php echo e(__($data->data_values->heading)); ?></h2>
                    <p> <?php echo e(__($data->data_values->subheading)); ?></p>
                </div>
            </div>
        </div><!-- row end -->
        <div class="row gy-4 justify-content-center">
            <?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-8 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                    <?php echo $__env->make($activeTemplate . 'partials.story', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/sections/success_story.blade.php ENDPATH**/ ?>