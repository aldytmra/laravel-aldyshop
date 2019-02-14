
<?php $__env->startSection('title'); ?> Edit book <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-8">
        <?php if(session('status')): ?>
        <div class="alert alert-success">
            <?php echo e(session('status')); ?>

        </div>
        <?php endif; ?>
        <form enctype="multipart/form-data" method="POST" action="<?php echo e(route('books.update', ['id' => $book->id])); ?>" class="p-3 shadow-sm bg-white">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <label for="title">Title</label><br>
            <input type="text" class="form-control" value="<?php echo e($book->title); ?>" name="title" placeholder="Book title" />
            <br>
            <label for="cover">Cover</label><br>
            <small class="text-muted">Current cover</small><br>
            <?php if($book->cover): ?>
            <img src="<?php echo e(asset('storage/' . $book->cover)); ?>" width="96px" />
            <?php endif; ?>
            <br><br>
            <input type="file" class="form-control" name="cover">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah
                cover</small>
            <br><br>
            <label for="slug">Slug</label><br>
            <input type="text" class="form-control" value="<?php echo e($book->slug); ?>" name="slug" placeholder="enter-a-slug" />
            <br>
            <label for="description">Description</label> <br>
            <textarea name="description" id="description" class="form-control">
            <?php echo e($book->description); ?></textarea>
            <br>
            <label for="categories">Categories</label>
            <select multiple class="form-control" name="categories[]" id="categories"></select>
            <br>
            <br>
            <label for="stock">Stock</label><br>
            <input type="text" class="form-control" placeholder="Stock" id="stock" name="stock" value="<?php echo e($book->stock); ?>">
            <br>
            <label for="author">Author</label>
            <input placeholder="Author" value="<?php echo e($book->author); ?>" type="text" id="author" name="author" class="form-control">
            <br>
            <label for="publisher">Publisher</label><br>
            <input class="form-control" type="text" placeholder="Publisher" name="publisher" id="publisher" value="<?php echo e($book->publisher); ?>">
            <br>
            <label for="price">Price</label><br>
            <input type="text" class="form-control" name="price" placeholder="Price" id="price" value="<?php echo e($book->price); ?>">
            <br>
            <label for="">Status</label>
            <select name="status" id="status" class="form-control">
                <option <?php echo e($book->status == 'PUBLISH' ? 'selected' : ''); ?> value="PUBLISH">PUBLISH</option>
                <option <?php echo e($book->status == 'DRAFT' ? 'selected' : ''); ?> \ value="DRAFT">DRAFT</option>
            </select>
            <br>

            <button class="btn btn-primary" value="PUBLISH">Update</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-scripts'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-
rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-
rc.0/js/select2.min.js"></script>
<script>
    $('#categories').select2({
        ajax: {
            url: 'http://larashop.test/ajax/categories/search',
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.name
                        }
                    })
                }
            }
        }
    });
    var categories = <?php echo $book -> categories; ?>

    categories.forEach(function (category) {
        var option = new Option(category.name, category.id, true, true);
        $('#categories').append(option).trigger('change');
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.global', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>