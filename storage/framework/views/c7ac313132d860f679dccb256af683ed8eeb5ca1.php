<?php $__env->startSection('title',  __('login.login')); ?>
<?php $__env->startSection('content'); ?>
       <div class="col-lg-7 loginBg">
            <div class="logo">
               <a href="index.html">
               <img src="<?php echo e(asset('bOwner/img/white_logo.png')); ?>"  alt="img">
               </a>
            </div>
         </div>
            <div class="col-lg-5">
                  <div class="loginInner">
                  <h3 class="heading"><?php echo e(__('login.admin_reset_p')); ?></h3>
                  <h4 class="font-weight-light"><?php echo e(__('login.reset_p_page_text')); ?></h4>
                      <div class="row">
                        <div class="col-lg-12">
                           <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="alert alert-dismissable alert-danger">
                                  <?php echo e($error); ?>

                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                            <?php if(session('status')): ?>
                              <div class="alert alert-success">
                              <?php echo e(session('status')); ?>

                              </div>
                            <?php endif; ?>
                          </div>
                        </div>    
                  <form class="pt-5" method="post" action="<?php echo e(route('admin.password.email')); ?>">
                      <?php echo e(csrf_field()); ?>

                  <div class="form-group">
                  <label for="email" ><?php echo e(__('E-Mail Address')); ?></label>
                   <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>
                  </div>
                   <div class="btnCont mt-4">
                          <button class="btn customBtn btn-block"><?php echo e(__('Send Password Reset Link')); ?></button>
                   </div>
                 </form>
                     <div class="mt-2 text-center">
                    <a href="<?php echo e(route('admin_login_get')); ?>" class="auth-link text-black"><?php echo e(__('login.already_have_account')); ?> <span class="font-weight-medium"><?php echo e(__('login.sign_in')); ?></span></a>
                  </div> 
               
                  
              
            
              </div>  
           </div>  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.Admin.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/coretails_backend/resources/views/auth/passwords/admin-email.blade.php ENDPATH**/ ?>