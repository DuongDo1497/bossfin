<?php
    $footer = getContent('footer.content', true);

    $socialIcons = getContent('social_icon.element', false, null, true);
    $policyPages = getContent('policy_pages.element');
    $subscribe   = getContent('subscribe.content', true);
    $contact     = getContent('contact_us.content', true);

    $donation      = App\Models\Donation::paid()->get();
    $donationCount = $donation->count();
    $donationSum   = $donation->sum('donation');

    $countCampaign = App\Models\Campaign::running()->whereDate('deadline', '>', now())->count();
    $categories    = App\Models\Category::active()->hasCampaigns()->orderBy('id', 'DESC')->take(4)->get();
?>

<!-- footer section start -->
<footer class="footer-section base--bg position-relative bg_img"
    data-background="<?php echo e(getImage('assets/images/frontend/footer/' . $footer->data_values->image, '730x465')); ?>">
    <div class="top-shape"><img
            src="<?php echo e(getImage($activeTemplateTrue . 'images/top_texture.png')); ?>"></div>
    <div class="footer-top">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-2 mb-lg-0 mb-5 text-lg-left text-center">
                    <a href="#0" class="footer-logo">
                        <img src="<?php echo e(getImage(getFilePath('logoIcon') . '/' . 'logo.png')); ?>"
                            alt="<?php echo app('translator')->get('image'); ?>"></a>
                </div>
                <div class="col-lg-7 col-md-12 mb-4">
                    <div class="row justify-content-center gy-4 align-items-center">
                        <div class="col-lg-4 col-4 footer-overview-item text-md-left text-center">
                            <h3 class="text-white amount-number text-center"><?php echo e($donationCount); ?></h3>
                            <p class="text-white text-center"><?php echo app('translator')->get('Total Donate Members'); ?></p>
                        </div>
                        <div class="col-lg-4 col-4 footer-overview-item text-md-left text-center">
                            <h3 class="text-white amount-number text-center"><?php echo e($countCampaign); ?></h3>
                            <p class="text-white text-center"><?php echo app('translator')->get('Total Campaigns'); ?></p>
                        </div>

                        <div class="col-lg-4 col-4 footer-overview-item text-md-left text-center">
                            <h3 class="text-white amount-number text-center">
                                <?php echo e($general->cur_sym); ?><?php echo e(showAmount($donationSum)); ?></h3>
                            <p class="text-white text-center"><?php echo app('translator')->get('Donation Raised'); ?></p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                    <div class="text-md-right text-center mb-lg-0 mb-4">
                        <a href="<?php echo e(url($footer->data_values->button_url)); ?>"
                            class="btn cmn-btn"><?php echo e(__($footer->data_values->button_name)); ?></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row gy-4">
                <div class="col-lg-3 col-md-6 col-sm-8 ">
                    <div class="footer-widget">
                        <h3 class="footer-widget__title"><?php echo e(__($footer->data_values->heading)); ?></h3>
                        <p><?php echo e(__($footer->data_values->subheading)); ?></p>
                        <ul class="social-links mt-4">
                            <?php $__currentLoopData = $socialIcons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="bg-transparent">
                                    <a href="<?php echo e($icon->data_values->url); ?>" target="_blank">
                                        <?php echo $icon->data_values->social_icon; ?>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div><!-- footer-widget end -->
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 ">
                    <div class="footer-widget">
                        <h3 class="footer-widget__title"><?php echo app('translator')->get('Categories'); ?></h3>
                        <ul class="short-link-list">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('campaign.index', ['category' => $category->slug])); ?>"><?php echo e($category->name); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div><!-- footer-widget end -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 ">
                    <div class="footer-widget">
                        <h3 class="footer-widget__title"><?php echo app('translator')->get('Fast Links'); ?></h3>
                        <ul class="short-link-list">
                            <li><a href="<?php echo e(route('user.register')); ?>"><?php echo app('translator')->get('Join With Us'); ?></a></li>
                            <li><a href="<?php echo e(route('success.story.archive')); ?>"><?php echo app('translator')->get('Our Success Stories'); ?></a></li>
                            <li><a href="<?php echo e(route('campaign.index')); ?>"><?php echo app('translator')->get('Make Donation'); ?></a></li>
                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('pages', [$data->slug])); ?>"><?php echo e(__($data->name)); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div><!-- footer-widget end -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h3 class="footer-widget__title"><?php echo e(__($subscribe->data_values->heading)); ?></h3>
                        <p><?php echo e(__($subscribe->data_values->subheading)); ?></p>
                        <form class="subscribe-form mt-3" method="POST"
                            action="<?php echo e(route('subscribe')); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="email" name="email" placeholder="<?php echo app('translator')->get('Email Address'); ?>" class="form-control"
                                autocomplete="off">
                            <button class="subscribe-btn"><i class="las la-arrow-right"></i></button>
                        </form>
                    </div><!-- footer-widget end -->
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-lg-8 col-md-6 text-md-start text-center">
                    <p><?php echo app('translator')->get('Copyright'); ?> &copy; <?php echo e(date('Y')); ?> |
                        <?php echo app('translator')->get('All Rights Reserved'); ?></p>
                </div>
                <div class="col-lg-4 col-md-6 mt-md-0">
                    <ul class="link-list justify-content-md-end justify-content-center">
                        <?php $__currentLoopData = $policyPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(route('policy.pages', ['slug' => slug($policy->data_values->title), 'id' => $policy->id])); ?>"><?php echo e(__($policy->data_values->title)); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer section end -->

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';

        $(function () {

            $('.subscribe-form').on('submit', function (event) {
                event.preventDefault();
                let url = `<?php echo e(route('subscribe')); ?>`;

                let data = {
                    email: $(this).find('input[name=email]').val()
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post(url, data, function (response) {
                    if (response.errors) {
                        for (var i = 0; i < response.errors.length; i++) {
                            iziToast.error({
                                message: response.errors[i],
                                position: "topRight"
                            });
                        }
                    } else {
                        $('.subscribe-form').trigger("reset");
                        iziToast.success({
                            message: response.success,
                            position: "topRight"
                        });
                    }
                });
                this.reset();
            })

        })

    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/partials/footer.blade.php ENDPATH**/ ?>