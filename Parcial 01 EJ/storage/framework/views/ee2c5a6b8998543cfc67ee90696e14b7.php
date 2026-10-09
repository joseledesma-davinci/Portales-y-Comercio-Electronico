<?php $__env->startSection('title', $post->title . ' | Blog DevHost Estudio'); ?>

<?php $__env->startSection('content'); ?>
<article class="post-detail" aria-labelledby="post-title">
    <header>
        <p class="category"><?php echo e($post->category->name); ?></p>
        <h1 id="post-title"><?php echo e($post->title); ?></h1>
        <p class="meta">Publicado <?php echo e(optional($post->published_at)->format('d/m/Y')); ?> · <?php echo e($post->reading_time_minutes); ?> min de lectura</p>
    </header>

    <p class="excerpt"><?php echo e($post->excerpt); ?></p>

    <?php $__currentLoopData = preg_split('/\n\n+/', trim($post->content)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <p><?php echo e($paragraph); ?></p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <p><a href="<?php echo e(route('site.blog')); ?>" class="text-link">← Volver al listado del blog</a></p>
</article>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ\resources\views/blog/show.blade.php ENDPATH**/ ?>