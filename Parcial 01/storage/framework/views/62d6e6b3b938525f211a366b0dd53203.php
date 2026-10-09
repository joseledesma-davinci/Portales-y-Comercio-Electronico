<?php $__env->startSection('title', 'Publicaciones'); ?>

<?php $__env->startSection('content'); ?>
<section aria-labelledby="titulo-admin-posts">
    <div class="table-headline">
        <h1 id="titulo-admin-posts">Administrar publicaciones</h1>
        <a href="<?php echo e(route('admin.posts.create')); ?>" class="btn btn-primary">Nueva publicación</a>
    </div>

    <div class="table-section">
        <div class="table-wrapper">
            <table>
                <caption class="sr-only">Tabla completa de publicaciones</caption>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($post->id); ?></td>
                        <td><?php echo e($post->title); ?></td>
                        <td><?php echo e($post->category->name); ?></td>
                        <td><?php echo e(optional($post->published_at)->format('d/m/Y') ?? '—'); ?></td>
                        <td>
                            <?php if($post->published_at): ?>
                                <span class="badge badge-publicado">Publicado</span>
                            <?php else: ?>
                                <span class="badge badge-borrador">Borrador</span>
                            <?php endif; ?>
                        </td>
                        <td class="actions-cell">
                            <a class="btn btn-small" href="<?php echo e(route('admin.posts.edit', ['id' => $post->id])); ?>">Editar</a>
                            <a class="btn btn-small btn-danger" href="<?php echo e(route('admin.posts.delete', ['id' => $post->id])); ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6">No hay publicaciones registradas.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01\resources\views/admin/posts/index.blade.php ENDPATH**/ ?>