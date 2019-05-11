<?php $__env->startSection('title', __('admin_dashboard.p_update')); ?>
<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('admin/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('admin/dist/bootstrap-tagsinput.css')); ?>">
<div class="row flex-grow">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo e(__('admin_dashboard.p_update')); ?></h4>   

                <form class="forms-sample" method="post" action="<?php echo e(route('aprofile_update_post')); ?>" enctype="multipart/form-data" id="form">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                    <div class="form-group">
                        <label for="exampleInputName1"><?php echo e(__('admin_dashboard.name')); ?></label>
                        <input type="text" placeholder="<?php echo e(__('admin_dashboard.name')); ?>" autocomplete="off" class="form-control" required onblur="this.value = removeSpaces(this.value)" name="name" value="<?php echo $admin->name; ?>" autofocus="on" id="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1"><?php echo e(__('admin_dashboard.job')); ?></label>
                        <input type="text" placeholder="<?php echo e(__('admin_dashboard.job')); ?>" autocomplete="off" class="form-control" required onblur="this.value = removeSpaces(this.value)" name="job" value="<?php echo $admin->job; ?>" id="job">
                    </div>
                    <div class="form-group">
                        <label><?php echo e(__('admin_dashboard.profile_pic')); ?></label>
                        <input type="file" name="profile_pic" class="file-upload-default" />
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="<?php echo e(__('admin_dashboard.upload_img')); ?>" />
                            <span class="input-group-btn">
                                <button class="file-upload-browse btn btn-info" type="button"><?php echo e(__('admin_dashboard.browse')); ?></button>
                            </span>
                        </div>
                    </div> 

                    <?php echo Form::submit(__('admin_dashboard.update_p'), ['class' => 'btn btn-success mr-2']); ?>

                    <?php echo Form::reset(__('admin_dashboard.reset'), ['class' => 'btn btn-primary']); ?>



                </form>
            </div>

        </div>
    </div>
</div>
<script src="/admin/js/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo e(asset('admin/js/file-upload.js')); ?>"></script> 
<script type="text/javascript">

                            $("#dashboard").addClass("active");

                            $("#form").validate({
                                rules: {
                                    name: {
                                        required: true,
                                        maxlength: 200
                                    },
                                    job: {
                                        required: true,
                                        maxlength: 200
                                    },
                                    image: {
                                        accept: "image/*"
                                    }
                                },
                                messages: {
                                    name: {
                                        required: "Please enter name",
                                    },
                                    job: {
                                        required: "Please enter job",
                                    },
                                    image:
                                            {
                                                accept: "Only Image is allowed"
                                            }
                                }
                            });

</script>


<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.Admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/php-4/coretail/resources/views/Admin/Other/profileupdate.blade.php ENDPATH**/ ?>