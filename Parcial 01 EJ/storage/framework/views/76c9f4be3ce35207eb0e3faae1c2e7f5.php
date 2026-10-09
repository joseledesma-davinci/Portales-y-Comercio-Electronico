<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<section aria-labelledby="dashboard-title">
    <h1 id="dashboard-title">Dashboard del blog</h1>
    <p>¡Hola, <?php echo e(session('admin_name', 'Administrador')); ?>! Desde acá podés gestionar las entradas del blog.</p>

    <section class="stats-grid" aria-label="Métricas del panel">
        <article class="stat-card">
            <h2>Publicaciones totales</h2>
            <p><?php echo e($stats['publicaciones']); ?></p>
        </article>
        <article class="stat-card">
            <h2>Publicadas</h2>
            <p><?php echo e($stats['publicadas']); ?></p>
        </article>
        <article class="stat-card">
            <h2>Servicios activos</h2>
            <p><?php echo e($stats['servicios_activos']); ?></p>
        </article>
    </section>

    <section aria-labelledby="tabla-posts" class="table-section">
        <div class="table-headline">
            <h2 id="tabla-posts">Listado de publicaciones</h2>
            <a href="<?php echo e(route('admin.posts.create')); ?>" class="btn btn-primary">Nueva publicación</a>
        </div>

        <div class="table-wrapper">
            <table>
                <caption class="sr-only">Tabla de publicaciones del blog</caption>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Autor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($post->title); ?></td>
                            <td><?php echo e($post->category->name); ?></td>
                            <td><span class="badge badge-<?php echo e($post->status); ?>"><?php echo e(ucfirst($post->status)); ?></span></td>
                            <td><?php echo e($post->author->name); ?></td>
                            <td class="actions-cell">
                                <a href="<?php echo e(route('admin.posts.edit', $post)); ?>" class="btn btn-small">Editar</a>
                                <form method="POST" action="<?php echo e(route('admin.posts.destroy', $post)); ?>" onsubmit="return confirm('¿Seguro que querés eliminar esta publicación?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-small btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5">No hay publicaciones cargadas todavía.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            <?php echo e($posts->links()); ?>

        </div>
    </section>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>