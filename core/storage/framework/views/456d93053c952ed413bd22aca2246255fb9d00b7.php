<?php
    $banners = getContent('banner.element', null, false, true);
    $campaignWithCategory = App\Models\Category::active()->orderBy('id', 'DESC')->get();
?>



<section class="hero">
    <div class="hero__slider">
        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="single__slide bg_img"
                data-background="<?php echo e(getImage('assets/images/frontend/banner/' . $item->data_values->image, '1980x1280')); ?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="hero__content text-center">
                                <h2 class="hero__title" data-animation="fadeInUp" data-delay=".3s">
                                    <?php echo e(__($item->data_values->heading)); ?> </h2>
                                <p data-animation="fadeInUp" data-delay=".5s"> <?php echo e(__($item->data_values->subheading)); ?>

                                </p>
                                <div class="btn-group mt-40" data-animation="fadeInUp" data-delay=".7s">
                                    <a href="<?php echo e(@$item->data_values->button_url_one); ?>" class="cmn-btn">
                                        <?php echo e(__($item->data_values->button_text_one)); ?> </a>
                                    <a href="<?php echo e($item->data_values->button_url_two); ?>" class="cmn-btn">
                                        <?php echo e(__($item->data_values->button_text_two)); ?> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<div class="banner-slider">
    <div class="container">
        <div class="justify-content-center">
            <div class="responsive">
                <?php $__currentLoopData = $campaignWithCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="category-card has-link hover--effect-1 js-tilt <?php echo e($loop->iteration % 3 == 0 ? 'overlay--three' : ($loop->odd ? 'overlay--one' : 'overlay--two')); ?>"data-tilt-perspective="300" data-tilt-speed="400" data-tilt-max="25">
                        <a href="<?php echo e(route('campaign.index', ['slug' => $category->slug])); ?>" class="item-link"></a>
                        <div class="category-card__thumb">
                            <img src="<?php echo e(getImage(getFilePath('category') . '/' . $category->image, getFileSize('category'))); ?>" class="w-100 __abc">
                        </div>
                        <div class="category-card__content">
                            <h4 class="title text-white"><?php echo e(__($category->name)); ?></h4>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>

<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/sections/banner.blade.php ENDPATH**/ ?>