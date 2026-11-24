<?php $__env->startSection('title', 'Usuarios'); ?>

<?php $__env->startSection('content'); ?>
<section aria-labelledby="titulo-admin-users">
    <div class="table-headline">
        <h1 id="titulo-admin-users">Usuarios registrados</h1>
    </div>

    <form method="get" action="<?php echo e(route('admin.users.index')); ?>" class="admin-form" aria-label="Buscador de usuarios">
        <div class="form-grid">
            <div class="form-group form-group-full">
                <label for="q">Buscar por nombre o email</label>
                <input type="text" id="q" name="q" value="<?php echo e($search); ?>" placeholder="Ej: maria o maria@mail.com">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <div class="table-section" style="margin-top: 1rem;">
        <div class="table-wrapper">
            <table>
                <caption class="sr-only">Listado de usuarios con cantidad de suscripciones</caption>
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Suscripciones</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($user->id); ?></td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->role === 'admin' ? 'Administrador' : 'Usuario'); ?></td>
                        <td><?php echo e($user->subscriptions_count); ?></td>
                        <td>
                            <a class="btn btn-small" href="<?php echo e(route('admin.users.show', ['id' => $user->id])); ?>">Ver detalle</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6">No se encontraron usuarios con ese criterio.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap" aria-label="Paginación de usuarios">
            <?php echo e($users->links('pagination.admin')); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 02\resources\views/admin/users/index.blade.php ENDPATH**/ ?>