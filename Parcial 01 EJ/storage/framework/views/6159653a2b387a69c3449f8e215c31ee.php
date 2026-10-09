<?php $__env->startSection('title', 'Inicio | DevHost Estudio'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero" aria-labelledby="hero-title">
    <div>
        <h1 id="hero-title">Estudio de Desarrollo Web & Hosting</h1>
        <p>En DevHost Estudio ayudamos a empresas y profesionales a vender más con plataformas rápidas, seguras y mantenibles.</p>
        <p>Laburamos con una metodología clara: diagnóstico, implementación y soporte continuo para que tu negocio no se frene.</p>
        <a href="<?php echo e(route('site.services')); ?>" class="btn btn-primary">Ver servicios disponibles</a>
    </div>
</section>

<section aria-labelledby="servicios-destacados" class="section-spacing">
    <h2 id="servicios-destacados">Servicios destacados</h2>
    <div class="card-grid">
        <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="card">
                <h3><?php echo e($service->name); ?></h3>
                <p><?php echo e($service->short_description); ?></p>
                <p class="price">$<?php echo e(number_format((float)$service->price, 0, ',', '.')); ?> ARS / <?php echo e($service->billing_cycle); ?></p>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>No hay servicios cargados por ahora.</p>
        <?php endif; ?>
    </div>
</section>

<section aria-labelledby="ultimas-novedades" class="section-spacing">
    <h2 id="ultimas-novedades">Últimas novedades del blog</h2>
    <div class="card-grid">
        <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="card">
                <p class="category"><?php echo e($post->category->name); ?></p>
                <h3><?php echo e($post->title); ?></h3>
                <p><?php echo e($post->excerpt); ?></p>
                <a href="<?php echo e(route('site.blog.show', $post)); ?>" class="text-link" aria-label="Leer <?php echo e($post->title); ?>">Leer artículo</a>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>Todavía no hay publicaciones visibles.</p>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ\resources\views/home.blade.php ENDPATH**/ ?>