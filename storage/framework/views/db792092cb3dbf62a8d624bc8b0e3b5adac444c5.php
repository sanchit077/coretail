<?php $__env->startSection('content'); ?>
               <div class="col-lg-5">
                  <div class="loginInner">
                     <h3 class="heading"><?php echo e(__('Forgot Password')); ?></h3>
                     <?php if(session('status')): ?>
                         <div class="alert alert-success" role="alert">
                             <?php echo e(session('status')); ?>

                         </div>
                     <?php endif; ?>

                     <form action="<?php echo e(route('password.email')); ?>" method="POST">
                       <?php echo csrf_field(); ?>
                     <div class="form-group">
                        <label><?php echo e(__('Email Address')); ?></label>

                        <input class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> error <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" type="email" name="email" placeholder="mr.xeious@gmail.com" value="<?php echo e(old('email')); ?>" autocomplete="email" required autofocus>
                     </div>
                     <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                         <span class="invalid-feedback" role="alert">
                             <strong><?php echo e($message); ?></strong>
                         </span>
                     <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>


                     <div class="btnCont mt-4">
                        <button type="submit" class="btn customBtn btn-block"><?php echo e(__('Reset Password')); ?></button>
                     </div>
                 </form>



                  </div>
               </div>
          <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/User/loginregister', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/php-4/coretail/resources/views/User/Other/sign-in-reset-password.blade.php ENDPATH**/ ?>