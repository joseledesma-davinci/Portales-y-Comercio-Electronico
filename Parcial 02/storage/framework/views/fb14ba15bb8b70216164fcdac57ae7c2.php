<?php $__env->startSection('title', $service->title); ?>

<?php $__env->startSection('content'); ?>
<section class="section-spacing" aria-labelledby="titulo-servicio">
    <h1 id="titulo-servicio"><?php echo e($service->title); ?></h1>

    <?php if($service->image): ?>
        <img src="<?php echo e($service->image_url); ?>" alt="Imagen del servicio <?php echo e($service->title); ?>" class="detail-image" loading="lazy">
    <?php else: ?>
        <div class="image-placeholder image-placeholder-lg" aria-hidden="true">Imagen próximamente</div>
    <?php endif; ?>

    <p class="price">$<?php echo e(number_format((float)$service->price, 0, ',', '.')); ?> ARS</p>
    <p><?php echo e($service->synopsis); ?></p>
    <p><?php echo e($service->description); ?></p>
    <p><a href="<?php echo e(route('services.index')); ?>" class="text-link">← Volver a servicios</a></p>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 02\resources\views/services/show.blade.php ENDPATH**/ ?>