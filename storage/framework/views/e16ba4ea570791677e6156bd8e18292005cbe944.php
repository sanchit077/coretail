<?php $__env->startSection('title',  __('login.login')); ?>
<?php $__env->startSection('content'); ?>
               <div class="col-lg-5">
                  <div class="loginInner">

                     <h3 class="heading"><?php echo e(__('Login')); ?></h3>
                     <form action="<?php echo e(route('login')); ?>" method="POST">
                     <?php echo csrf_field(); ?>
                     <div class="form-group">
                        <label><?php echo e(__('Email Address')); ?></label>
                          <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                        <span class="errorText">This email is not registered to the system</span>
                          <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                        <input class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> error <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" type="email" name="email" placeholder="e.g. John Doe" value="<?php echo e(old('email')); ?>" autocomplete="email" >
                     </div>

                     <div class="form-group">
                        <label><?php echo e(__('Password')); ?></label>
                        <input class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> error <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?> pr-5" id="password-field" type="password" name="password" autocomplete="current-password">
                        <div class="passwordView">
                         <img src="<?php echo e(asset('user/img/passwordView.png')); ?>" alt="img" onClick="viewPassword()">
                        </div>

                     </div>
                     <div class="text-left">
                     <a href="<?php echo e(route('password.request')); ?>" class="customLink">
                        <?php echo e(__('Forgot Password?')); ?>

                     </a>
                  </div>

                     <div class="btnCont mt-4">
                        <button type="submit" class="btn customBtn btn-block"><?php echo e(__('Sign In')); ?></button>
                     </div>
                   </form>
                     <div class="belowLink"><?php echo e(__('Don’t have an account?')); ?>  <a href="<?php echo e(route('register')); ?>"> <?php echo e(__('Create Account')); ?></a></div>



                  </div>
               </div>
            <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/User/loginregister', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/php-4/coretail/resources/views/User/Other/sign-in.blade.php ENDPATH**/ ?>