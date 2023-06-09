<?php $__empty_1 = true; $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="col-lg-4 col-md-6">
        <div class="event-card hover--effect-1 has-link">
            <div class="feature">
                <?php if(isset($type)): ?>
                    <?php echo e(__($type)); ?>

                <?php else: ?>
                    <?php echo e($campaign->category->name); ?>

                <?php endif; ?>
            </div>
            <a href="<?php echo e(route('campaign.details', ['slug' => $campaign->slug, 'id' => $campaign->id])); ?>"
                class="item-link"></a>

            <div class="event-card__thumb">
                <img src="<?php echo e(getImage(getFilePath('campaign') . '/' . $campaign->image, getFileSize('campaign'))); ?>"
                    alt="image" class="w-100">
                <?php if(@auth()->user()->id == @$campaign->user_id): ?>
                    <span class="event-card__auth">
                        <i class="las la-user-tie"></i>
                    </span>
                <?php endif; ?>
            </div>

            <div class="event-card__content">
                <small><i class="las la-calendar"></i>
                    <?php echo e(showDateTime($campaign->created_at, 'Y-m-d')); ?></small>
                <h4 class="title pt-2"><?php echo e(__(StrLimit($campaign->title, 45))); ?></h4>
                <span class="days-left fst-italic py-3" data-deadline=<?php echo e($campaign->deadline); ?>>
                    <span class="day"></span>
                    <span class="hour"></span>
                    <span class="minute"></span>
                    <span class="sec"></span>
                </span>
                <p class="text-dark">
                    <?php echo e(strLimit(strip_tags($campaign->description), 115)); ?>

                </p>
                <div class="event-bar-item">
                    <div class="skill-bar">
                        <?php
                            $campDonation = $campaign->donation->sum('donation');
                            $percent   = percent($campDonation,$campaign);
                        ?>
                        <div class="progressbar" data-perc="<?php echo e(progressPercent($percent)); ?>%">
                            <div class="bar"></div>
                            <span class="label"><?php echo e(showAmount(progressPercent($percent), 2)); ?>%</span>
                        </div>
                    </div>
                </div><!-- event-bar-item end -->
                <div class="amount-status">
                    <div class="left">
                        <?php echo app('translator')->get('Goal '); ?>&nbsp;
                       <b><?php echo e($general->cur_sym); ?><?php echo e(showAmount($campaign->goal)); ?></b>
                    </div>
                    <div class="right">
                        <?php echo app('translator')->get('Raised'); ?>&nbsp;
                       <b><?php echo e($general->cur_sym); ?><?php echo e(showAmount($campDonation)); ?></b>
                    </div>
                </div>
            </div>
        </div><!-- event-card end -->
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="mx-auto d-flex justify-content-center">
        <div class="card custom--shadow">
            <div class="card-header text-center">
                <h5 class="px-5"><?php echo app('translator')->get('Opps! No Campaign Found'); ?></h5>
            </div>
            <div class="card-body text-center py-5">
                <a href="<?php echo e(url()->previous()); ?>" class="btn cmn-btn"><i class="las la-undo"></i> <?php echo app('translator')->get('Back'); ?></a>
            </div>
        </div>
    </div>
<?php endif; ?>



<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/partials/campaign.blade.php ENDPATH**/ ?>