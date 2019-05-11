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
                <h2><?php echo e(__('login.admin_reset_p')); ?></h2>
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
                <form class="pt-4" role="form" method="POST" action="<?php echo e(route('admin.password.request')); ?>"> 
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo e(__('login.email')); ?></label>
					<?php echo e(csrf_field()); ?>	
					 <input type="hidden" name="token" value="<?php echo e($token); ?>">
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="<?php echo e(__('login.email')); ?>" value="<?php echo e(old('email')); ?>" required />
                    <i class="mdi mdi-account"></i>
                  </div>
                   <div class="form-group">
                    <label for="exampleInputPassword1"><?php echo e(__('login.password')); ?></label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="<?php echo e(__('login.password')); ?>" />
                    <i class="mdi mdi-eye"></i>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword2"><?php echo e(__('login.c_password')); ?></label>
                    <input  type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="<?php echo e(__('login.c_password')); ?>" />
                    <i class="mdi mdi-eye"></i>
                  </div>
                  <div class="mt-5">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium" name="register" type="submit"><?php echo e(__('login.r_password')); ?></button>
                  </div>
                  
                  <div class="mt-2 text-center">
                    <a href="<?php echo e(route('admin_login_get')); ?>" class="auth-link text-black"><?php echo e(__('login.already_reset_p')); ?> <span class="font-weight-medium"><?php echo e(__('login.sign_in')); ?></span></a>
                  </div>
                </form>


            
              </div>  
           </div>  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.Admin.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/php-4/coretail/resources/views/auth/passwords/admin-reset.blade.php ENDPATH**/ ?>