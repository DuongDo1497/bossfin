<?php
    $content   = getContent('top_donors.content', true);
    $topDonors = App\Models\Donation::paid()->limit(12)->groupBy('email')->selectRaw("*,sum(donation) as totalDonations")->orderBy('totalDonations', 'DESC')->get();
?>
<section class="pt-120 pb-120 border-top-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-header">
                    <h2 class="section-title"><?php echo e(__(@$content->data_values->heading)); ?></h2>
                    <p><?php echo e(__(@$content->data_values->subheading)); ?></p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center gy-4">
            <?php $__currentLoopData = $topDonors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-3 col-sm-6 col-xsm-6">
                    <div class="top-donor-item">
                        <h3 class="top-donor-item__position"> <span class="text"><?php echo e(ordinal($loop->iteration)); ?></span> </h3>
                        <div class="top-donor-item__content">
                            <h5 class="top-donor-item__name"> <?php echo e($data->fullname); ?> </h5>
                            <h5 class="top-donor-item__amount mb-0 text--base"><?php echo app('translator')->get('Donation'); ?>: <?php echo e($general->cur_sym); ?><?php echo e(showAmount($data->totalDonations)); ?> </h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/sections/top_donors.blade.php ENDPATH**/ ?>