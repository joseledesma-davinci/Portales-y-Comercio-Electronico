<?php $__env->startSection('title', 'Editar publicación'); ?>

<?php $__env->startSection('content'); ?>
<section aria-labelledby="edit-post-title">
    <h1 id="edit-post-title">Editar publicación</h1>
    <p>Actualizá el contenido y el estado de esta nota.</p>

    <form action="<?php echo e(route('admin.posts.update', $post)); ?>" method="POST" class="admin-form" novalidate>
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php echo $__env->make('admin.posts.form-fields', ['post' => $post], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <button type="submit" class="btn btn-primary">Actualizar publicación</button>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ\resources\views/admin/posts/edit.blade.php ENDPATH**/ ?>