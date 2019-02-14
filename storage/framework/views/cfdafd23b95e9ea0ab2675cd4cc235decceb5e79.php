
<?php $__env->startSection('title'); ?> Trashed Books <?php $__env->stopSection(); ?>
<?php $__env->startSection('pageTitle'); ?> Trashed Books <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <?php if(session('status')): ?>
        <div class="alert alert-success">
            <?php echo e(session('status')); ?>

        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <form action="<?php echo e(route('books.index')); ?>">
                    <div class="input-group">
                        <input name="keyword" type="text" value="
<?php echo e(Request::get('keyword')); ?>" class="form-control"
                            placeholder="Filter by
title">
                        <div class="input-group-append">
                            <input type="submit" value="Filter" class="btn btnprimary">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::get('status') == NULL &&
Request::path() == 'books' ? 'active' : ''); ?>"
                            href="
<?php echo e(route('books.index')); ?>">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::get('status') == 'publish' ?
'active' : ''); ?>" href="<?php echo e(route('books.index', ['status' =>
'publish'])); ?>">Publish</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::get('status') == 'draft' ?
'active' : ''); ?>" href="<?php echo e(route('books.index', ['status' =>
'draft'])); ?>">Draft</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::path() == 'books/trash' ?
'active' : ''); ?>" href="<?php echo e(route('books.trash')); ?>">Trash</a>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-3">
        <div class="row mb-3">
            <div class="col-md-12 text-right">
                <a href="<?php echo e(route('books.create')); ?>" class="btn btn-primary">Create book</a>
            </div>
        </div>
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th><b>Cover</b></th>
                    <th><b>Title</b></th>
                    <th><b>Author</b></th>
                    <th><b>Categories</b></th>
                    <th><b>Stock</b></th>
                    <th><b>Price</b></th>
                    <th><b>Action</b></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <?php if($book->cover): ?>
                        <img src="<?php echo e(asset('storage/' . $book->cover)); ?>" width="96px" />
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($book->title); ?></td>
                    <td><?php echo e($book->author); ?></td>
                    <td>
                        <ul class="pl-3">
                            <?php $__currentLoopData = $book->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($category->name); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </td>
                    <td><?php echo e($book->stock); ?></td>
                    <td><?php echo e($book->price); ?></td>
                    <td>
                        <form method="POST" action="<?php echo e(route('books.restore', ['id' => $book->id])); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <input type="submit" value="Restore" class="btn btnsuccess" />
                        </form>
                        <form method="POST" action="<?php echo e(route('books.delete-permanent', ['id' =>
$book->id])); ?>" class="d-inline"
                            onsubmit="return confirm('Delete this book permanently?')">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="Delete" class="btn btn-danger
btn-sm">
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="10">
                        <?php echo e($books->appends(Request::all())->links()); ?>

                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.global', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>