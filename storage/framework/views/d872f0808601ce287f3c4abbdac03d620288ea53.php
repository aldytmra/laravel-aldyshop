
<?php $__env->startSection('content'); ?>
<div class="d-flex flex-row justify-content-center">
 <div class="col-md-6 text-center">
 <div class="alert alert-danger">
 <h1>404</h1>
 <h4><?php echo e($exception->getMessage()); ?></h4>
 </div>
 </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>