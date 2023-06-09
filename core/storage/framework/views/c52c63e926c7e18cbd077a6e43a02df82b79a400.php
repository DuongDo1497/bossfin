<?php $login = getContent('login.content', true); ?>

<?php $__env->startSection('content'); ?>
    <section class="pt-90 pb-120">
        <div class="container">
            <div class="row g-0 justify-content-center">
                <div class="col-md-6 pr-0 pl-0">
                    <div class="content-area bg_img"
                        data-background="<?php echo e(getImage('assets/images/frontend/login/' . @$login->data_values->image, '1025x720')); ?>">
                    </div>
                </div>

                <div class="col-lg-6 p-sm-0">
                    <div class="p-sm-5 p-4 custom--shadow">
                        <form class="verify-gcaptcha action-form" action="<?php echo e(route('user.login')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="login-area text-center">
                                <h2 class="title"><?php echo e(__(@$login->data_values->heading)); ?></h2>
                                <p><?php echo e(__(@$login->data_values->subheading)); ?></p>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->get('Username'); ?></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="las la-user"></i></span>
                                    <input type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>"
                                        required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->get('Password'); ?></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="las la-key"></i></span>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <?php if (isset($component)) { $__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243 = $component; } ?>
<?php $component = App\View\Components\Captcha::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('captcha'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Captcha::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243)): ?>
<?php $component = $__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243; ?>
<?php unset($__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243); ?>
<?php endif; ?>

                            <div class="form-group d-flex justify-content-between flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        <?php if(old('remember')): echo 'checked'; endif; ?>>
                                    <label class="form-check-label" for="remember"> <?php echo app('translator')->get('Remember Me'); ?></label>
                                </div>

                                <a href="<?php echo e(route('user.password.request')); ?>"> <?php echo app('translator')->get('Forgot Password'); ?>?</a>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn cmn-btn w-100 shadow-none"><?php echo app('translator')->get('Login'); ?></button>
                            </div>
                        </form>

                        <p class="text-center">
                            <?php echo app('translator')->get("Haven't an account"); ?>? <a href="<?php echo e(route('user.register')); ?>"><?php echo app('translator')->get('Register'); ?></a>
                        </p>

                        <div class="registration-socails__content text-center">
                            <p class="registration-socails__desc mb-0 mt-0"> <?php echo app('translator')->get('Or Login with'); ?> </p>
                        </div>

                        <?php
                            $credentials = $general->socialite_credentials;
                        ?>
                        <?php if(
                            $credentials->google->status == Status::ENABLE ||
                                $credentials->facebook->status == Status::ENABLE ||
                                $credentials->linkedin->status == Status::ENABLE): ?>

                            <div class="d-flex flex-wrap gap-3">
                                <?php if($credentials->facebook->status == Status::ENABLE): ?>
                                    <a href="<?php echo e(route('user.social.login', 'facebook')); ?>"
                                        class="btn btn-outline-facebook btn-sm flex-grow-1">
                                        <span class="me-1"><i class="fab fa-facebook-f"></i></span> <?php echo app('translator')->get('Facebook'); ?>
                                    </a>
                                <?php endif; ?>
                                <?php if($credentials->google->status == Status::ENABLE): ?>
                                    <a href="<?php echo e(route('user.social.login', 'google')); ?>"
                                        class="btn btn-outline-google btn-sm flex-grow-1">
                                        <span class="me-1"><i class="lab la-google-plus-g"></i></span> <?php echo app('translator')->get('Google'); ?>
                                    </a>
                                <?php endif; ?>
                                <?php if($credentials->linkedin->status == Status::ENABLE): ?>
                                    <a href="<?php echo e(route('user.social.login', 'linkedin')); ?>"
                                        class="btn btn-outline-linkedin btn-sm flex-grow-1">
                                        <span class="me-1"><i class="lab la-linkedin-in"></i></span> <?php echo app('translator')->get('Linkedin'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .content-area {
            z-index: -1;
            height: 100%;
        }

        .btn-outline-linkedin {
            border-color: #0077B5;
            background-color: transparent;
            color: #0077B5;
        }

        .btn-outline-linkedin:hover {
            border-color: #0077B5;
            color: #fff !important;
            background-color: #0077B5;
        }

        .btn-outline-facebook {
            border-color: #395498;
            background-color: transparent;
            color: #395498;
        }

        .btn-outline-facebook:hover {
            border-color: #395498;
            color: #fff !important;
            background-color: #395498;
        }

        .btn-outline-google {
            border-color: #D64937;
            background-color: transparent;
            color: #D64937;
        }

        .btn-outline-google:hover {
            border-color: #D64937;
            color: #fff !important;
            background-color: #D64937;
        }


    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\www\bossfin\core\resources\views/templates/basic/user/auth/login.blade.php ENDPATH**/ ?>