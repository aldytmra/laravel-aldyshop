
<?php $__env->startSection('title'); ?> Edit order <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8">
        <?php if(session('status')): ?>
        <div class="alert alert-success">
            <?php echo e(session('status')); ?>

        </div>
        <?php endif; ?>
        <form class="shadow-sm bg-white p-3" action="<?php echo e(route('orders.update', ['id' => $order->id])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <label for="invoice_number">Invoice number</label><br>
            <input type="text" class="form-control" value="<?php echo e($order->invoice_number); ?>" disabled>
            <br>
            <label for="">Buyer</label><br>
            <input  class="form-control" type="text" value="<?php echo e($order->user->name); ?>" disabled>
            <br>
            <label for="created_at">Order date</label><br>
            <input type="text" class="form-control" value="<?php echo e($order->created_at); ?>" disabled>
            <br>
            <label for="">Books (<?php echo e($order->totalQuantity); ?>) </label><br>
            <ul>
                <?php $__currentLoopData = $order->books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($book->title); ?> <b>(<?php echo e($book->pivot->quantity); ?>)</b></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <label for="">Total price</label><br>
            <input class="form-control" type="text" value="<?php echo e($order->total_price); ?>" disabled>
            <br>
            <label for="status">Status</label><br>
            <select class="form-control" name="status" id="status">
                <option <?php echo e($order->status == "SUBMIT" ? "selected" : ""); ?> value="SUBMIT">SUBMIT</option>
                <option <?php echo e($order->status == "PROCESS" ? "selected" : ""); ?> value="PROCESS">PROCESS</option>
                <option <?php echo e($order->status == "FINISH" ? "selected" : ""); ?> value="FINISH">FINISH</option>
                <option <?php echo e($order->status == "CANCEL" ? "selected" : ""); ?> value="CANCEL">CANCEL</option>
            </select>
            <br>
            <input type="submit" class="btn btn-primary" value="Update">
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.global', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>