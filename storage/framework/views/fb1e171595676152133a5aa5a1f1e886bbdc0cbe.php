
<?php $__env->startSection('title'); ?> Orders list <?php $__env->stopSection(); ?>
<?php $__env->startSection('pageTitle'); ?> Orders list <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('orders.index')); ?>">
    <div class="row">
        <div class="col-md-5">
            <input value="<?php echo e(Request::get('buyer_email')); ?>" name="buyer_email" type="text" class="form-control"
                placeholder="Search by buyer email">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-control" id="status">
                <option value="">ANY</option>
                <option <?php echo e(Request::get('status') == "SUBMIT" ? "selected" : ""); ?> value="SUBMIT">SUBMIT</option>
                <option <?php echo e(Request::get('status') == "PROCESS" ? "selected" : ""); ?> value="PROCESS">PROCESS</option>
                <option <?php echo e(Request::get('status') == "FINISH" ? "selected" : ""); ?> value="FINISH">FINISH</option>
                <option <?php echo e(Request::get('status') == "CANCEL" ? "selected" : ""); ?> value="CANCEL">CANCEL</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="submit" value="Filter" class="btn btn-primary">
        </div>
    </div>
</form>
<hr class="my-3">
<div class="row">
    <div class="col-md-12">
        <table class="table table-stripped table-bordered">
            <thead>
                <tr>
                    <th>Invoice number</th>
                    <th><b>Status</b></th>
                    <th><b>Buyer</b></th>
                    <th><b>Total quantity</b></th>
                    <th><b>Order date</b></th>
                    <th><b>Total price</b></th>
                    <th><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($order->invoice_number); ?></td>
                    <td>
                        <?php if($order->status == "SUBMIT"): ?>
                        <span class="badge bg-warning text-light"><?php echo e($order->status); ?></span>
                        <?php elseif($order->status == "PROCESS"): ?>
                        <span class="badge bg-info text-light"><?php echo e($order->status); ?>

                        </span>
                        <?php elseif($order->status == "FINISH"): ?>
                        <span class="badge bg-success text-light"><?php echo e($order->status); ?></span>
                        <?php elseif($order->status == "CANCEL"): ?>
                        <span class="badge bg-dark text-light"><?php echo e($order->status); ?>

                        </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo e($order->user->name); ?> <br>
                        <small><?php echo e($order->user->email); ?></small>
                    </td>
                    <td><?php echo e($order->totalQuantity); ?> pc (s)</td>
                    <td><?php echo e($order->created_at); ?></td>
                    <td><?php echo e($order->total_price); ?></td>
                    <td>
                        <a href="<?php echo e(route('orders.edit', ['id' => $order->id])); ?>" class="btn btn-info btn-sm"> Edit</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="10">
                        <?php echo e($orders->appends(Request::all())->links()); ?>

                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.global', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>