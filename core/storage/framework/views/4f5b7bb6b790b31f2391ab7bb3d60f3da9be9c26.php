<?php
    $campaignContent = getContent('campaign.content', true);
    $campaigns = App\Models\Campaign::running()->with('donation', 'category')->orderBy('id', 'DESC')->take(3)->get();
?>

<section class="campaign-section pt-120 pb-120 position-relative base--bg">
    <div class="section-img"><img src="<?php echo e(getImage($activeTemplateTrue . 'images/texture-3.jpg')); ?>">
    </div>
    <div class="bottom-shape"><img src="<?php echo e(asset($activeTemplateTrue . 'images/top-shape.png')); ?>" >
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-8">
                <div class="section-header text-center">
                    <h2 class="section-title text-white"><?php echo e(__($campaignContent->data_values->title)); ?></h2>
                    <p class="text-white"><?php echo e(__($campaignContent->data_values->description)); ?></p>
                </div>
            </div>
        </div><!-- row end -->
        <div class="row gy-4 gy-4 justify-content-center">
            <?php echo $__env->make($activeTemplate . 'partials.campaign', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-md-12 my-5 text-center">
                <a href="<?php echo e(route('campaign.index')); ?>" class="cmn-btn"><?php echo app('translator')->get('SHOW ALL CAMPAIGNS'); ?></a>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/sections/campaign.blade.php ENDPATH**/ ?>