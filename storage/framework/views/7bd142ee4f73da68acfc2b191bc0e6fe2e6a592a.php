
<?php $__env->startSection('title'); ?> Edit User <?php $__env->stopSection(); ?>
<?php $__env->startSection('pageTitle'); ?> Edit User <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="col-md-8">
    <?php if(session('status')): ?>
    <div class="alert alert-success">
        <?php echo e(session('status')); ?>

    </div>
    <?php endif; ?>
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="<?php echo e(route('users.update', ['id'=>$user->id])); ?>"
        method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" value="PUT" name="_method">
        <label for="name">Name</label>
        <input value="<?php echo e(old('name') ? old('name') : $user->name); ?>" class="form-control <?php echo e($errors->first('name') ? "is-invalid" : ""); ?>"
            placeholder="Full
 Name" type="text" name="name" id="name" />
        <div class="invalid-feedback">
            <?php echo e($errors->first('name')); ?>

        </div>
        <br>

        <label for="username">Username</label>
        <input value="<?php echo e($user->username); ?>" class="form-control" placeholder="username" type="text" name="username" disabled id="username" />
        <br>
        <label for="">Status</label>
        <br />
        <input <?php echo e($user->status == "ACTIVE" ? "checked" : ""); ?> value="ACTIVE" type="radio" class="form-control" id="active"
            name="status"> <label for="active">Active</label>
        <input <?php echo e($user->status == "INACTIVE" ? "checked" : ""); ?> value="INACTIVE" type="radio" class="form-control" id="inactive"
            name="status"> <label for="inactive">Inactive</label>
        <br><br>

        <label for="">Roles</label>
        <br>
        <input type="checkbox" <?php echo e(in_array("ADMIN", json_decode($user->roles)) ? "checked" : ""); ?> name="roles[]" class="form-control <?php echo e($errors->first('roles') ? "is-invalid" : ""); ?>"
            id="ADMIN" value="ADMIN">
        <label for="ADMIN">Administrator</label>
        <input type="checkbox" <?php echo e(in_array("STAFF", json_decode($user->roles)) ? "checked" : ""); ?> name="roles[]" class="form-control <?php echo e($errors->first('roles') ? "is-invalid" : ""); ?>"
            id="STAFF" value="STAFF">
        <label for="STAFF">Staff</label>
        <input type="checkbox" <?php echo e(in_array("CUSTOMER", json_decode($user->roles)) ? "checked" : ""); ?> name="roles[]"
            class="form-control <?php echo e($errors->first('roles') ? "is-invalid" : ""); ?>" id="CUSTOMER" value="CUSTOMER">
        <label for="CUSTOMER">Customer</label>

        <div class="invalid-feedback">
            <?php echo e($errors->first('roles')); ?>

        </div>
        <br>
        <br>
        <label for="phone">Phone number</label>
        <br>
        <input type="text" name="phone" class="form-control <?php echo e($errors->first('phone') ? "is-invalid" : ""); ?>" value="<?php echo e(old('phone') ? old('phone')
: $user->phone); ?>">
        <div class="invalid-feedback">
            <?php echo e($errors->first('phone')); ?>

        </div>
        <br>
        <label for="address">Address</label>
        <textarea name="address" id="address" class="form-control <?php echo e($errors->first('address') ? "is-invalid" : ""); ?>"><?php echo e(old('address') ? old('address')
: $user->address); ?></textarea>
        <div class="invalid-feedback">
            <?php echo e($errors->first('address')); ?>

        </div>
        <br>
        <label for="avatar">Avatar image</label>
        <br>
        Current avatar: <br>
        <?php if($user->avatar): ?>
        <img src="<?php echo e(asset('storage/'.$user->avatar)); ?>" width="120px" />
        <br>
        <?php else: ?>
        No avatar
        <?php endif; ?>
        <br>
        <input id="avatar" name="avatar" type="file" class="form-control">
        <small class="text-muted">Kosongkan jika tidak ingin mengubah
            avatar</small>

        <hr class="my-4">

        <label for="email">Email</label>
        <input value="<?php echo e($user->email); ?>" disabled class="form-control
<?php echo e($errors->first('email') ? "is-invalid" : ""); ?> "
            placeholder="user@mail.com" type="text" name="email" id="email" />
        <div class="invalid-feedback">
            <?php echo e($errors->first('email')); ?>

        </div>
        <br>

        <input class="btn btn-primary" type="submit" value="Simpan" />
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.global', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>