<li><a class="<?php echo e(menuActive('home')); ?>" href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('HOME'); ?></a></li>
<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li><a class="<?php echo e(menuActive('pages', null, $data->slug)); ?>" href="<?php echo e(route('pages', [$data->slug])); ?>"><?php echo e(__($data->name)); ?></a></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<li><a class="<?php echo e(menuActive('campaign.index')); ?>" href="<?php echo e(route('campaign.index')); ?>"><?php echo app('translator')->get('CAMPAIGNS'); ?></a></li>
<li><a class="<?php echo e(menuActive('volunteer.index')); ?>" href="<?php echo e(route('volunteer.index')); ?>"><?php echo app('translator')->get('VOLUNTEERS'); ?></a></li>
<li><a class="<?php echo e(menuActive('success.story.archive')); ?>" href="<?php echo e(route('success.story.archive')); ?>"><?php echo app('translator')->get('SUCCESS STORY'); ?></a></li>
<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/partials/common_menus.blade.php ENDPATH**/ ?>