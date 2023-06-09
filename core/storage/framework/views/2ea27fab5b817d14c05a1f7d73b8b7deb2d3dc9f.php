<?php
    $volunteer = getContent('volunteer.content', true);
    $volunteers = App\Models\Volunteer::active()->orderBy('participated')->limit(6)->get();
?>

<section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="section-header text-center">
                    <h2 class="section-title"><?php echo e(__(@$volunteer->data_values->heading)); ?></h2>
                    <p><?php echo e(__(@$volunteer->data_values->subheading)); ?></p>
                </div>
            </div>
        </div>

            <div class="row gy-4 main-view justify-content-center">
                <?php $__empty_1 = true; $__currentLoopData = $volunteers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-xxl-3 col-xl-4 col-md-4 col-sm-6 mb-30 wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
                        <div class="volunteer-card h-100">
                            <div class="volunteer-card__thumb">
                                <img src="<?php echo e(getImage(getFilePath('volunteer') . '/' . $item->image, getFileSize('volunteer'))); ?>" class="w-100" <?php echo app('translator')->get('Image'); ?>">
                                <div class="volunteer-shape">
                                    <img src="<?php echo e(asset($activeTemplateTrue . 'images/top-shape.png')); ?>" alt="image">
                                </div>
                            </div>
                            <div class="volunteer-card__content">
                                <h4 class="name"><?php echo e(__($item->fullname)); ?></h4>
                                <span class="designation"><?php echo app('translator')->get("Participate {$item->participated} Campaigns"); ?></span>
                                <div class="designation"><small> <?php echo app('translator')->get("From"); ?> : <?php echo e(__(@$item->country)); ?></small></div>
                            </div>


                        </div><!-- volunteer-card end -->
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-center py-3"><?php echo e(__($emptyMessage)); ?></p>
                <?php endif; ?>
            </div>
    </div>
</section>

<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/sections/volunteer.blade.php ENDPATH**/ ?>