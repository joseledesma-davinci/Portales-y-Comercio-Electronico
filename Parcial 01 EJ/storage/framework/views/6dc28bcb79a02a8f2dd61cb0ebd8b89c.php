<?php $__env->startSection('title', 'Blog | DevHost Estudio'); ?>

<?php $__env->startSection('content'); ?>
<section aria-labelledby="titulo-blog" class="section-spacing">
    <h1 id="titulo-blog">Blog de seguridad, rendimiento y novedades tech</h1>
    <p>Notas pensadas para equipos que quieren una web robusta, veloz y lista para escalar.</p>

    <div class="blog-list">
        <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="post-item">
                <header>
                    <p class="category"><?php echo e($post->category->name); ?></p>
                    <h2><a href="<?php echo e(route('site.blog.show', $post)); ?>"><?php echo e($post->title); ?></a></h2>
                </header>
                <p><?php echo e($post->excerpt); ?></p>
                <p class="meta">Publicado <?php echo e(optional($post->published_at)->format('d/m/Y')); ?> · <?php echo e($post->reading_time_minutes); ?> min de lectura</p>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>Todavía no hay publicaciones para mostrar.</p>
        <?php endif; ?>
    </div>

    <nav aria-label="Paginación del blog" class="pagination-wrap">
        <?php echo e($posts->links()); ?>

    </nav>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ\resources\views/blog/index.blade.php ENDPATH**/ ?>