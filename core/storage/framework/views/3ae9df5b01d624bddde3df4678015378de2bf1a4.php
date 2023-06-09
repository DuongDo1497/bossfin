<?php
    $storyContent = getContent('story.content', true);
    $stories      = getContent('story.element', null, false, true);
?>
<!-- story section start -->
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-8">
                <div class="section-header text-center">
                    <h2 class="section-title"><?php echo e(__($storyContent->data_values->heading)); ?></h2>
                    <p><?php echo e(__($storyContent->data_values->subheading)); ?></p>
                </div>
            </div>
        </div><!-- row end -->

        <div class="row g-0">
            <div class="col-lg-6">
                <div class="story-thumb">
                    <div class="story-thumb-slider">
                        <?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-slide">
                                <img src="<?php echo e(getImage('assets/images/frontend/story/' . $story->data_values->image, '730x465')); ?>" alt="<?php echo app('translator')->get('image'); ?>">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 right position-relative bg--base text-center">
                <div class="section-img"><img src="<?php echo e(getImage($activeTemplateTrue . 'images/texture-3.jpg')); ?>" alt="<?php echo app('translator')->get('image'); ?>">
                </div>
                <div class="story-content">
                    <div class="story-slider">
                        <?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-slide">
                                <h3 class="text-white mb-3"><?php echo e(__($story->data_values->title)); ?></h3>
                                <p class="text-white"><?php echo e(__($story->data_values->description)); ?></p>
                            </div><!-- single-slide end -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div><!-- story-slider end -->
                </div>
            </div>
        </div><!-- row end -->
    </div>
</section>
<!-- story section end -->
<?php $__env->startPush('style'); ?>
<style>
    .section-img {
        z-index: none;
    }
</style>

<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/sections/story.blade.php ENDPATH**/ ?>