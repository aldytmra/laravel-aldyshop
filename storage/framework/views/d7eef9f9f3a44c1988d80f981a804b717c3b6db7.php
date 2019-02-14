
<?php $__env->startSection('title'); ?> Trashed Categories <?php $__env->stopSection(); ?>
<?php $__env->startSection('pageTitle'); ?> Trashed Categories <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6">
        <form action="<?php echo e(route('categories.index')); ?>">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Filter by category name" value="<?php echo e(Request::get('name')); ?>"
                    name="name">

                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-primary">
                </div>
            </div>

        </form>
    </div>
    <div class="col-md-6">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link" href="
<?php echo e(route('categories.index')); ?>">Published</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="
<?php echo e(route('categories.trash')); ?>">Trash</a>
            </li>
        </ul>
    </div>
</div>
<hr class="my-3">
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($category->name); ?></td>
                    <td><?php echo e($category->slug); ?></td>
                    <td>
                        <?php if($category->image): ?>
                        <img src="<?php echo e(asset('storage/' . $category->image)); ?>" width="48px" />
                        <?php endif; ?>
                    </td>
                    <td>
                    <a href="<?php echo e(route('categories.restore', ['id' => $category->id])); ?>"
                    class="btn btn-success">Restore</a>
                    <form
                    class="d-inline"
                    action="<?php echo e(route('categories.delete-permanent', ['id' => $category->id])); ?>"
                    method="POST"
                    onsubmit="return confirm('Delete this category permanently?')">
                    <?php echo csrf_field(); ?>
                    <input
                    type="hidden"
                    name="_method"
                    value="DELETE"/>

                    <input
                    type="submit"
                    class="btn btn-danger btn-sm"
                    value="Delete"/>
                    </form>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colSpan="10">
                        <?php echo e($categories->appends(Request::all())->links()); ?>

                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.global', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>