<?php $__env->startSection('title', 'Detalle de usuario'); ?>

<?php $__env->startSection('content'); ?>
<section aria-labelledby="titulo-user-detail">
    <h1 id="titulo-user-detail">Detalle de usuario</h1>

    <article class="table-section" aria-label="Datos del usuario">
        <p><strong>ID:</strong> <?php echo e($user->id); ?></p>
        <p><strong>Nombre:</strong> <?php echo e($user->name); ?></p>
        <p><strong>Email:</strong> <?php echo e($user->email); ?></p>
        <p><strong>Rol:</strong> <?php echo e($user->role === 'admin' ? 'Administrador' : 'Usuario'); ?></p>
    </article>

    <section class="table-section" aria-labelledby="titulo-servicios" style="margin-top: 1rem;">
        <h2 id="titulo-servicios">Servicios contratados</h2>

        <?php if($user->subscriptions->isEmpty()): ?>
            <p>Este usuario todavía no tiene servicios contratados.</p>
        <?php else: ?>
            <div class="table-wrapper">
                <table>
                    <caption class="sr-only">Tabla de suscripciones del usuario</caption>
                    <thead>
                    <tr>
                        <th scope="col">Servicio</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Inicio</th>
                        <th scope="col">Vencimiento</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $user->subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($subscription->service->title); ?></td>
                            <td>$<?php echo e(number_format((float)$subscription->service->price, 0, ',', '.')); ?> ARS</td>
                            <td><?php echo e($subscription->status_label); ?></td>
                            <td><?php echo e($subscription->started_at?->format('d/m/Y')); ?></td>
                            <td><?php echo e($subscription->expires_at?->format('d/m/Y') ?? 'Sin vencimiento'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <p style="margin-top: 1rem;"><a href="<?php echo e(route('admin.users.index')); ?>" class="text-link">← Volver al listado de usuarios</a></p>
    </section>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 02\resources\views/admin/users/show.blade.php ENDPATH**/ ?>