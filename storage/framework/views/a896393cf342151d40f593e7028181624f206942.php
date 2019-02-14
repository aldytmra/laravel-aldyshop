
<?php $__env->startSection('title'); ?> Category list <?php $__env->stopSection(); ?>
<?php $__env->startSection('pageTitle'); ?> Category list <?php $__env->stopSection(); ?>
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
                        <a class="nav-link active" href="
<?php echo e(route('categories.index')); ?>">Published</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="
 <?php echo e(route('categories.trash')); ?>">Trash</a>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-3">
        <?php if(session('status')): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <?php echo e(session('status')); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12 text-right">
                <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-primary">Create
                    category</a>
            </div>
        </div>
        <br>

<div class="row">
    <div class="col-md-12">

        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th><b>Name</b></th>
                    <th><b>Slug</b></th>
                    <th><b>Image</b></th>
                    <th><b>Actions</b></th>
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
                        <?php else: ?>
                        No image
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('categories.show', ['id' => $category->id])); ?>" class="btn btn-primary btn-sm">
                            Show </a>
                        <a href="<?php echo e(route('categories.edit', ['id' => $category->id])); ?>" class="btn btn-info btn-sm">
                            Edit </a>
                        <form class="d-inline" action="<?php echo e(route('categories.destroy', ['id' => $category->id])); ?>" method="POST"
                            onsubmit="return confirm('Move category to trash?')">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="DELETE" name="_method">
                            <input type="submit" class="btn btn-danger btn-sm" value="Trash">

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