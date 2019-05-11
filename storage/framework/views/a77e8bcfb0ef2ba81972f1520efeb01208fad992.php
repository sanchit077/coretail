<!DOCTYPE html>
<html lang="en">
<head>  
    <title>CoRetail Web Admin - <?php echo $__env->yieldContent('title'); ?></title> 

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
   <link rel="stylesheet" href="<?php echo e(asset('/admin/css/bootstrap.min.css')); ?>">
   <link rel="stylesheet" href="<?php echo e(asset('/admin/css/style.css')); ?>">
   <link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="<?php echo e(asset('/admin/js/jquery.min.js')); ?>"></script>
   <script src="<?php echo e(asset('/admin/js/popper.min.js')); ?>"></script>
   <script src="<?php echo e(asset('/admin/js/bootstrap.min.js')); ?>"></script>
</head>

<body>
	<section id="">
        <div class="sidebar">
				<?php echo $__env->make('layouts.Admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
		</div>
		<div class="page-container">
			<div class="header navbar">  
			   <?php echo $__env->make('layouts.Admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 			</div>
			<main class="main-content bgc-grey-100">
				<div id="mainContent">
			    	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                    <div class="alert alert-dismissable alert-danger">
	                        <?php echo $error; ?>

                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php if(session('status')): ?>
						<div class="alert alert-success">
							<?php echo e(session('status')); ?>

                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						</div>
					<?php endif; ?> 
						<?php echo $__env->yieldContent('content'); ?> 
                </div>
			</main>
		</div>
	</section>
</body> 
</html> <?php /**PATH /home/php-4/coretail/resources/views/layouts/Admin/dashboard.blade.php ENDPATH**/ ?>