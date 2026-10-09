<?php $__env->startSection('title', 'Servicios | DevHost Estudio'); ?>

<?php $__env->startSection('content'); ?>
<section aria-labelledby="titulo-servicios" class="section-spacing">
    <h1 id="titulo-servicios">Servicios profesionales para tu presencia digital</h1>
    <p>Planes de hosting, desarrollo web y mantenimiento técnico en un solo equipo.</p>

    <div class="service-grid">
        <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="service-card">
                <header>
                    <h2><?php echo e($service->name); ?></h2>
                    <p class="category"><?php echo e($service->category); ?></p>
                </header>
                <p><?php echo e($service->description); ?></p>
                <p class="price">$<?php echo e(number_format((float)$service->price, 0, ',', '.')); ?> ARS / <?php echo e($service->billing_cycle); ?></p>
                <h3>Incluye</h3>
                <ul>
                    <?php $__currentLoopData = explode("\n", $service->features); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($feature); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <p class="support">Soporte <?php echo e($service->included_support ? 'incluido' : 'no incluido'); ?>.</p>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>No encontramos servicios activos en este momento.</p>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ\resources\views/services.blade.php ENDPATH**/ ?>