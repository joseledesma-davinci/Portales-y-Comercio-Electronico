<?php $__env->startSection('title', 'Nueva publicación'); ?>

<?php $__env->startSection('content'); ?>
<section aria-labelledby="create-post-title">
    <h1 id="create-post-title">Crear publicación</h1>
    <p>Completá los datos para sumar una nueva nota al blog.</p>

    <form action="<?php echo e(route('admin.posts.store')); ?>" method="POST" class="admin-form" novalidate>
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('admin.posts.form-fields', ['post' => null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <button type="submit" class="btn btn-primary">Guardar publicación</button>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ\resources\views/admin/posts/create.blade.php ENDPATH**/ ?>