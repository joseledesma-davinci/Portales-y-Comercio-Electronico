<?php $__env->startSection('title', 'Editar publicación'); ?>

<?php $__env->startSection('content'); ?>
<section aria-labelledby="titulo-editar-post">
    <h1 id="titulo-editar-post">Editar publicación</h1>

    <?php if($errors->any()): ?>
        <div class="flash flash-error" role="alert">Hay errores en los datos enviados. Revisá los campos marcados.</div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.posts.update', ['id' => $post->id])); ?>" method="post" class="admin-form">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('admin.posts.form', ['post' => $post], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <button type="submit" class="btn btn-primary">Actualizar publicación</button>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ2\resources\views/admin/posts/edit.blade.php ENDPATH**/ ?>