<?php $__env->startSection('content'); ?>
               <div class="col-lg-5">
                  <div class="loginInner">
                     <h3 class="heading"><?php echo e(__('New Account')); ?></h3>
                     <form action="<?php echo e(route('register')); ?>" method="post">
                       <?php echo csrf_field(); ?>
                     <div class="form-group">
                        <label><?php echo e(__('Full Name')); ?></label>
                        <input class="form-control <?php if ($errors->has('fullname')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('fullname'); ?> error <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" type="text" name="fullname" value="<?php echo e(old('fullname')); ?>" required autocomplete="fullname" autofocus>
                     </div>
                     <div class="form-group">
                        <label><?php echo e(__('Email Address')); ?></label>
                        <input class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> error <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" type="email" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email">
                     </div>
                     <div class="form-group">
                        <label><?php echo e(__('Password')); ?></label>
                        <input class="form-control pr-5 <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> error <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" type="password" id="password-field" name="password" required autocomplete="new-password">
                        <div class="passwordView">
                         <img src="<?php echo e(asset('user/img/passwordView.png')); ?>" alt="img" onClick="viewPassword()">
                        </div>
                        <div class="pwIndicator">
                           <ul>
                              <li class="one"></li>
                              <li class="two"></li>
                              <li  class="three"></li>
                              <li  class="four"></li>
                           </ul>
                           <p><?php echo e(__('Passwords must be at least 6 characters long and should include letters A-Z, numbers 0-9 or symbols.')); ?></p>
                        </div>
                     </div>
                     <div class="acType">
                        <label><?php echo e(__('Account Type')); ?></label>

                        <div class="row">
                           <div class="col-sm-6">
                             <label class="blockChkBx">
                             <input type="radio" name="type" value="brandOwner" required <?php if(old('type')=='brandOwner'): ?> checked <?php endif; ?>>
                             <span class="checkmark1 btn">
                                  <i><img src="<?php echo e(asset('user/img/brand_owner_icon.png')); ?>" alt="img" /> </i> <span>Brand Owner</span>
                             </span>
                             </label>
                           </div>
                           <div class="col-sm-6">
                             <label class="blockChkBx">
                             <input type="radio" name="type" value="landlord" required <?php if(old('type')=='landlord'): ?> checked <?php endif; ?>>
                             <span class="checkmark1 btn">
                                  <i><img src="<?php echo e(asset('user/img/landlord_icon.png')); ?>" alt="img" /> </i> <span>Landlord</span>
                             </span>
                             </label>
                           </div>
                         </div>
                        </div>
                     </div>
                     <div class="btnCont mt-4">
                        <button type="submit" class="btn customBtn btn-block"><?php echo e(__('Create Account')); ?></button>
                     </div>
                   </form>
                     <div class="belowLink"><?php echo e(__('Already have an account?')); ?>  <a href="<?php echo e(route('login')); ?>"> <?php echo e(__('Login')); ?> </a></div>
                  </div>
               </div>
            <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/User/loginregister', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/php-4/coretail/resources/views/User/Other/registration.blade.php ENDPATH**/ ?>