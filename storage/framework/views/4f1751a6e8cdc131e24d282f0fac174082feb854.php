
<?php $__env->startSection("title"); ?> Users list <?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
<?php if(session('status')): ?>
<div class="alert alert-success">
    <?php echo e(session('status')); ?>

</div>
<?php endif; ?>

<form action="<?php echo e(route('users.index')); ?>">
    <div class="row">
        <div class="col-md-6">
            <input value="<?php echo e(Request::get('keyword')); ?>" name="keyword" class="form-control" type="text" placeholder="Masukan email untuk filter..." />
        </div>
        <div class="col-md-6">
            <input <?php echo e(Request::get('status') == 'ACTIVE' ? 'checked' : ''); ?> value="ACTIVE" name="status" type="radio"
                class="form-control" id="active">
            <label for="active">Active</label>

            <input <?php echo e(Request::get('status') == 'INACTIVE' ? 'checked' : ''); ?> value="INACTIVE" name="status" type="radio"
                class="form-control" id="inactive">
            <label for="inactive">Inactive</label>
            <input type="submit" value="Filter" class="btn btn-primary">
        </div>
    </div>
</form>


<div class="row">
    <div class="col-md-12 text-right">
        <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary">Create user</a>
    </div>
</div>
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th><b>Name</b></th>
            <th><b>Username</b></th>
            <th><b>Email</b></th>
            <th><b>Avatar</b></th>
            <th><b>Status</b></th>
            <th><b>Action</b></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($user->name); ?></td>
            <td><?php echo e($user->username); ?></td>
            <td><?php echo e($user->email); ?></td>
            <td>
                <?php if($user->avatar): ?>
                <img src="<?php echo e(asset('storage/'.$user->avatar)); ?>" width="70px" />
                <?php else: ?>
                N/A
                <?php endif; ?>
            </td>
            <td>
                <?php if($user->status == "ACTIVE"): ?>
                <span class="badge badge-success">
                    <?php echo e($user->status); ?>

                </span>
                <?php else: ?>
                <span class="badge badge-danger">
                    <?php echo e($user->status); ?>

                </span>
                <?php endif; ?>
            </td>

            <td>
                <a href="<?php echo e(route('users.show', ['id' => $user->id])); ?>" class="btn btn-primary btn-sm">Detail</a>
                <a class="btn btn-info text-white btn-sm" href="<?php echo e(route('users.edit', ['id'=>$user->id])); ?>">Edit</a>
                <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline" action="<?php echo e(route('users.destroy', ['id' => $user->id ])); ?>"
                    method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    <tfoot>
        <tr>
        <td colspan=10>
        <?php echo e($users->appends(Request::all())->links()); ?>

        </td>
        </tr>
    </tfoot>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.global", \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>