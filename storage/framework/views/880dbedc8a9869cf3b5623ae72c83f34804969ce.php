<?php $__env->startSection('content'); ?>
               <div class="col-lg-5">
                  <div class="loginInner">
                     <h3 class="heading mb-0"><?php echo e(__('Reset Password')); ?></h3>
                     <p class="p17 mb-4"><?php echo e(__('Pick a new password ')); ?></p>

                     <form action="<?php echo e(route('password.update')); ?>" method="post">
                       <?php echo csrf_field(); ?>
                       <input type="hidden" name="token" value="<?php echo e($token); ?>">
                       <input class="form-control pr-5" type="hidden" name="email" value="<?php echo e($email ?? old('email')); ?>">
                     <div class="form-group">
                        <label> <?php echo e(__('New Password')); ?></label>
                        <input class="form-control pr-5 <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> error <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" type="password" id="password-field" name="password" required autocomplete="new-password">
                        <div class="passwordView">
                         <img src="<?php echo e(asset('user/img/passwordView.png')); ?>" alt="img" onClick="viewPassword()">
                        </div>
                        <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                     </div>
                      <div class="form-group">
                        <label> <?php echo e(__('Repeat New Password')); ?></label>
                        <input class="form-control pr-5" type="password" id="conpassword-field" name="password_confirmation" required autocomplete="new-password">

                        <div class="passwordView">
                         <img src="<?php echo e(asset('user/img/passwordView.png')); ?>" alt="img" onClick="viewconPassword()">
                        </div>

                     </div>

                     <div class="btnCont mt-4">
                        <button type="submit" class="btn customBtn btn-block"> <?php echo e(__('Reset Password')); ?></button>
                     </div>
                   </form>



                  </div>
               </div>
          <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/User/loginregister', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/php-4/coretail/resources/views/User/Other/sign-in-new-password.blade.php ENDPATH**/ ?>