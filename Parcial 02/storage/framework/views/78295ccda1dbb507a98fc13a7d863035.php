<?php $__env->startSection('title', 'Servicios'); ?>

<?php $__env->startSection('content'); ?>
<section class="section-spacing" aria-labelledby="titulo-servicios">
    <h1 id="titulo-servicios">Servicios de hosting, desarrollo y mantenimiento</h1>
    <p>Elegí la opción que mejor se adapta a tu etapa actual y escalá cuando lo necesites.</p>

    <div class="service-grid">
        <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="service-card">
                <?php if($service->image): ?>
                    <img src="<?php echo e(asset('img/'.$service->image)); ?>" alt="Imagen del servicio <?php echo e($service->title); ?>" class="card-thumb" loading="lazy">
                <?php else: ?>
                    <div class="image-placeholder" aria-hidden="true">Imagen próximamente</div>
                <?php endif; ?>
                <h2><?php echo e($service->title); ?></h2>
                <p><?php echo e($service->synopsis); ?></p>
                <p class="price">$<?php echo e(number_format((float)$service->price, 0, ',', '.')); ?> ARS</p>
                <a href="<?php echo e(route('services.show', ['id' => $service->id])); ?>" class="text-link">Conocer más</a>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>No hay servicios activos por el momento.</p>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01\resources\views/services/index.blade.php ENDPATH**/ ?>