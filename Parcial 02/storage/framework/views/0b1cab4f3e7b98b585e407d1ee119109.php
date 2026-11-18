<?php $__env->startSection('title', 'Blog'); ?>

<?php $__env->startSection('content'); ?>
<section class="section-spacing" aria-labelledby="titulo-blog">
    <h1 id="titulo-blog">Blog sobre seguridad, optimización y novedades tech</h1>
    <p>Recursos prácticos para mejorar rendimiento, proteger tus activos y tomar mejores decisiones técnicas.</p>

    <div class="blog-list">
        <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="post-item">
                <?php if($post->image): ?>
                    <img src="<?php echo e(asset('img/'.$post->image)); ?>" alt="Imagen de la publicación <?php echo e($post->title); ?>" class="card-thumb" loading="lazy">
                <?php else: ?>
                    <div class="image-placeholder" aria-hidden="true">Sin imagen</div>
                <?php endif; ?>
                <p class="category"><?php echo e($post->category->name); ?></p>
                <h2><a class="post-item-link" href="<?php echo e(route('posts.show', ['id' => $post->id])); ?>"><?php echo e($post->title); ?></a></h2>
                <p><?php echo e($post->synopsis); ?></p>
                <p class="meta">Publicado el <?php echo e(optional($post->published_at)->format('d/m/Y')); ?></p>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>No hay publicaciones disponibles por ahora.</p>
        <?php endif; ?>
    </div>

    
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01\resources\views/posts/index.blade.php ENDPATH**/ ?>