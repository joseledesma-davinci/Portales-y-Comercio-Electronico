<?php $__env->startSection('title', 'Inicio'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero" aria-labelledby="titulo-home">
    <div class="hero-grid">
        <article>
            <h1 id="titulo-home">Estudio de Desarrollo Web & Hosting</h1>
            <p>Ayudamos a negocios a construir, optimizar y sostener su presencia digital con foco en resultados y continuidad operativa.</p>
            <p>Combinamos infraestructura, desarrollo a medida y soporte técnico para que puedas crecer con una base sólida.</p>
        </article>
        <article class="hero-media">
            <img src="<?php echo e(asset('img/hero-estudio.jpg')); ?>" alt="Equipo profesional trabajando en infraestructura y desarrollo web" loading="lazy">
        </article>
    </div>
</section>

<section class="section-spacing" aria-labelledby="servicios-destacados">
    <h2 id="servicios-destacados">Servicios destacados</h2>
    <div class="card-grid">
        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="card">
                <?php if($service->image): ?>
                    <img src="<?php echo e(asset('img/'.$service->image)); ?>" alt="Imagen del servicio <?php echo e($service->title); ?>" class="card-thumb" loading="lazy">
                <?php else: ?>
                    <div class="image-placeholder" aria-hidden="true">Imagen próximamente</div>
                <?php endif; ?>
                <h3><?php echo e($service->title); ?></h3>
                <p><?php echo e($service->synopsis); ?></p>
                <p class="price">$<?php echo e(number_format((float)$service->price, 0, ',', '.')); ?> ARS</p>
                <a href="<?php echo e(route('services.show', ['id' => $service->id])); ?>" class="text-link">Ver detalle</a>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<section class="section-spacing" aria-labelledby="ultimas-publicaciones">
    <h2 id="ultimas-publicaciones">Últimas publicaciones del blog</h2>
    <div class="card-grid">
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="card">
                <?php if($post->image): ?>
                    <img src="<?php echo e(asset('img/'.$post->image)); ?>" alt="Imagen de portada: <?php echo e($post->title); ?>" class="card-thumb" loading="lazy">
                <?php else: ?>
                    <div class="image-placeholder" aria-hidden="true">Sin imagen</div>
                <?php endif; ?>
                <p class="category"><?php echo e($post->category->name); ?></p>
                <h3><?php echo e($post->title); ?></h3>
                <p><?php echo e($post->synopsis); ?></p>
                <a href="<?php echo e(route('posts.show', ['id' => $post->id])); ?>" class="text-link">Leer nota</a>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01\resources\views/home.blade.php ENDPATH**/ ?>