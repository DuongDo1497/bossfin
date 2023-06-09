<?php
    $contact = getContent('contact_us.content', true);
?>
<div class="header__top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="left d-flex align-items-center">
                    <a href="tel:<?php echo e($contact->data_values->contact_number); ?>">
                        <i class="la la-phone-volume"></i> <?php echo app('translator')->get('Help Center'); ?>
                    </a>
                    <?php if($general->multi_language): ?>
                    <div class="language">
                        <i class="la la-globe-europe"></i>
                        <select id="language" class="langSel">
                            <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($lang->code); ?>" <?php echo e(session('lang') == $lang->code ? 'selected' : ''); ?>><?php echo e(__($lang->name)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-6">
                <?php if(auth()->guard()->check()): ?>
                    <div class="right text-sm-end text-center dashboard">
                        <a class="<?php echo e(menuActive('user.home')); ?>" href="<?php echo e(route('user.home')); ?>"><i class="las la-tachometer-alt"></i> <?php echo app('translator')->get('Dashboard'); ?></a>
                    </div>
                <?php else: ?>
                    <div class="right text-sm-end text-center">
                        <a href="<?php echo e(route('user.login')); ?>"><i class="las la-sign-in-alt"></i> <?php echo app('translator')->get('Login'); ?></a>
                        <a href="<?php echo e(route('user.register')); ?>"><i class="las la-user-plus"></i> <?php echo app('translator')->get('Register'); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<header class="header__bottom">
    <div class="container">
        <nav class="navbar navbar-expand-xl p-0 align-items-center">
            <a class="site-logo site-title" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" alt="site-logo"><span class="logo-icon"><i class="flaticon-fire"></i></span></a>
            <button class="navbar-toggler ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="las la-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(request()->routeIs('home') || request()->routeIs('campaign.index') || request()->routeIs('volunteer.index') || request()->routeIs('about')|| request()->routeIs(['success.story.*'])): ?>
                        <ul class="navbar-nav main-menu ms-auto">
                            <?php echo $__env->make($activeTemplate . 'partials.common_menus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </ul>
                    <?php else: ?>
                        <ul class="navbar-nav main-menu ms-auto">
                            <li class="menu_has_children">
                                <a class="<?php echo e(menuActive('user.campaign.*')); ?>" href="javascript:void(0)"><?php echo app('translator')->get('MY CAMPAIGNS'); ?></a>
                                <ul class="sub-menu">
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.campaign.fundrise.create')); ?>"><?php echo app('translator')->get('CREATE CAMPAIGN'); ?></a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.campaign.fundrise.approved')); ?>"><?php echo app('translator')->get('APPROVED CAMPAIGNS'); ?></a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.campaign.fundrise.pending')); ?>"><?php echo app('translator')->get('PENDING CAMPAIGNS'); ?></a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.campaign.fundrise.rejected')); ?>"><?php echo app('translator')->get('REJECTED CAMPAIGNS'); ?></a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.campaign.fundrise.complete')); ?>"><?php echo app('translator')->get('SUCCESSFUL CAMPAIGNS'); ?></a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.campaign.fundrise.all')); ?>"><?php echo app('translator')->get('ALL CAMPAIGNS'); ?></a></li>
                                </ul>
                            </li>
                            <li class="menu_has_children"><a class="<?php echo e(menuActive(['user.withdraw', 'user.withdraw.history'])); ?>" href="#0"><?php echo app('translator')->get('WITHDRAW MONEY'); ?></a>
                                <ul class="sub-menu">
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.withdraw')); ?>"><?php echo app('translator')->get('WITHDRAW MONEY'); ?></a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.withdraw.history')); ?>"><?php echo app('translator')->get('WITHDRAW LOG'); ?></a></li>
                                </ul>
                            </li>
                            <li class="menu_has_children"><a href="#0"><?php echo app('translator')->get('SUPPORT TICKET'); ?></a>
                                <ul class="sub-menu">
                                    <li> <a class="dropdown-item" href="<?php echo e(route('ticket.open')); ?>"><?php echo app('translator')->get('CREATE NEW'); ?></a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('ticket.index')); ?>"><?php echo app('translator')->get('MY TICKETS'); ?></a></li>
                                </ul>
                            </li>
                            <li class="menu_has_children"><a class="<?php echo e(menuActive(['user.change.password', 'user.twofactor', 'user.profile.setting'])); ?>" href="#0"> <i class="fa fa-user me-2"></i><?php echo e(strtoupper(auth()->user()->username)); ?></a>
                                <ul class="sub-menu">
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.change.password')); ?>"><?php echo app('translator')->get('CHANGE PASSWORD'); ?></a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.profile.setting')); ?>"><?php echo app('translator')->get('PROFILE SETTING'); ?></a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.transactions')); ?>"><?php echo app('translator')->get('TRANSACTIONS LOG'); ?></a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.campaign.donation.received')); ?>"><?php echo app('translator')->get('RECEIVED DONATIONS '); ?></a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.campaign.donation.my')); ?>"><?php echo app('translator')->get('MY DONATIONS '); ?></a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.twofactor')); ?>"><?php echo app('translator')->get('2FA SETTING'); ?></a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('user.logout')); ?>"><?php echo app('translator')->get('LOGOUT'); ?></a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php endif; ?>
                <?php else: ?>
                <ul class="navbar-nav main-menu ms-auto">
                    <?php echo $__env->make($activeTemplate . 'partials.common_menus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </ul>
                <div class="nav-right">
                    <a href="<?php echo e(route('contact')); ?>" class="btn cmn-btn <?php echo e(menuActive('contact')); ?>"><?php echo app('translator')->get('CONTACT'); ?></a>
                </div>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>
<?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/partials/header.blade.php ENDPATH**/ ?>