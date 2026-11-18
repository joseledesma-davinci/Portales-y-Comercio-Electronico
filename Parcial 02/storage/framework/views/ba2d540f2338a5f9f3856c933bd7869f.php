<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<section aria-labelledby="titulo-dashboard">
    <h1 id="titulo-dashboard">Panel de administración</h1>
    <p>Resumen general de contenido y actividad editorial.</p>

    <section class="stats-grid" aria-label="Indicadores del panel">
        <article class="stat-card">
            <h2>Publicaciones totales</h2>
            <p><?php echo e($stats['posts_total']); ?></p>
        </article>
        <article class="stat-card">
            <h2>Publicadas</h2>
            <p><?php echo e($stats['posts_published']); ?></p>
        </article>
        <article class="stat-card">
            <h2>Categorías</h2>
            <p><?php echo e($stats['categories_total']); ?></p>
        </article>
        <article class="stat-card">
            <h2>Servicios activos</h2>
            <p><?php echo e($stats['services_active']); ?></p>
        </article>
    </section>

    <section class="table-section" aria-labelledby="titulo-ultimas-posts">
        <div class="table-headline">
            <h2 id="titulo-ultimas-posts">Últimas publicaciones</h2>
            <a href="<?php echo e(route('admin.posts.create')); ?>" class="btn btn-primary">Nueva publicación</a>
        </div>

        <div class="table-wrapper">
            <table>
                <caption class="sr-only">Listado de últimas publicaciones</caption>
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Autor</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $latestPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($post->title); ?></td>
                        <td><?php echo e($post->category->name); ?></td>
                        <td><?php echo e($post->user->name); ?></td>
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
                        <td colspan="5">No hay publicaciones cargadas.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ2\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>