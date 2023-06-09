<?php
    $campaignContent = getContent('recently_funded.content', true);
    $campaigns = App\Models\Donation::paid()->groupBy('campaign_id')
        ->with('campaign.donation', 'campaign.category')
        ->whereHas('campaign', function ($campaign) {
            $campaign->running();
        })
        ->selectRaw('*,sum(donation) as donate')->latest('id')->take(3)->get()
        ->map(function ($campaign) {
            return $campaign->campaign;
        });
?>
<section class="campaign-section pt-120 pb-150 position-relative base--bg">
    <div class="section-img">
        <img src="<?php echo e(getImage($activeTemplateTrue . 'images/texture-3.jpg')); ?>" alt="<?php echo app('translator')->get('image'); ?>">
    </div>
    <div class="top-shape">
        <img src="<?php echo e(getImage($activeTemplateTrue . 'images/top_texture.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>">
    </div>
    <div class="bottom-shape">
        <img src="<?php echo e(asset($activeTemplateTrue . 'images/top-shape.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-header my-5">
                    <h2 class="section-title text-white"><?php echo e(__($campaignContent->data_values->heading)); ?></h2>
                    <p class="text-white"><?php echo e(__($campaignContent->data_values->subheading)); ?></p>
                </div>
            </div>
        </div>
        <div class="row gy-4 gy-4 justify-content-center">

            <?php echo $__env->make($activeTemplate . 'partials.campaign', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if($campaigns->count() > 6): ?>
                <div class="col-md-12 my-5 text-center">
                    <a href="<?php echo e(route('campaign.index')); ?>" class="cmn-btn"><?php echo app('translator')->get('Show All Campaigns'); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/sections/recently_funded.blade.php ENDPATH**/ ?>