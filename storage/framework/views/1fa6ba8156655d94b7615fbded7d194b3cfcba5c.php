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
                    <h3 class="heading"><?php echo e(__('login.login')); ?></h3>

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


                    <form class="pt-5" method="post" action="<?php echo e(route('admin_login_post')); ?>">
                      <?php echo e(csrf_field()); ?>

                     <div class="form-group">
                        <label><?php echo e(__('login.email')); ?></label>
                        <span class="errorText"></span> 
                     <input  type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="<?php echo e(__('login.email')); ?>" value="<?php if(count($details)>0): ?><?php echo e($details['ad_email']); ?> <?php else: ?> <?php echo e(Request::old('email')); ?> <?php endif; ?>"/>
                     </div>
                    
                     <div class="form-group">
                        <label><?php echo e(__('login.password')); ?></label>

                         <input type="password" name="password" class="form-control pr-5 pass" id="exampleInputPassword1" placeholder="<?php echo e(__('login.password')); ?>" value="<?php if(count($details)>0): ?><?php echo e($details['ad_psw']); ?><?php endif; ?>"/> 
                        <div class="passwordView" onclick="return showPass();">
                         <button><img src="<?php echo e(asset('bOwner/img/passwordView.png')); ?>" alt="img"></button>
                        </div>
                         
                     </div>
                     <div class="text-left">
                     <a href="<?php echo e(route('admin.password.request')); ?>" class="customLink">
                        <?php echo e(__('login.forgot_p')); ?>?
                     </a>
                  </div>
                     <div class="btnCont mt-4">
                        <button class="btn customBtn btn-block"><?php echo e(__('login.login')); ?></button>
                     </div> 
 
                  </div>
               </div> 
          
	    <script src="<?php echo e(asset('admin/node_modules/jquery/dist/jquery.min.js')); ?>"></script>
      <script> 
		  function showPass(){
			  if($('.pass').attr('type')=='password')
				$('.pass').attr('type', 'text');
				else
				$('.pass').attr('type', 'password');
       return false;
		  } 
      </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.Admin.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/coretails_backend/resources/views/Admin/Other/login.blade.php ENDPATH**/ ?>