<?php $__env->startSection('title', $post->title); ?>

<?php $__env->startSection('content'); ?>
<article class="post-detail section-spacing" aria-labelledby="titulo-post">
    <header>
        <p class="category"><?php echo e($post->category->name); ?></p>
        <h1 id="titulo-post"><?php echo e($post->title); ?></h1>
        <p class="meta">Publicado el <?php echo e(optional($post->published_at)->format('d/m/Y')); ?> por <?php echo e($post->user->name); ?></p>
    </header>

    <?php if($post->image): ?>
        <img src="<?php echo e(asset('img/'.$post->image)); ?>" alt="Imagen destacada de <?php echo e($post->title); ?>" class="detail-image" loading="lazy">
    <?php else: ?>
        <div class="image-placeholder image-placeholder-lg" aria-hidden="true">Sin imagen</div>
    <?php endif; ?>

    <p class="excerpt"><strong><?php echo e($post->synopsis); ?></strong></p>

    <?php $__currentLoopData = preg_split('/\n\n+/', trim($post->content)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <p><?php echo e($paragraph); ?></p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <p><a href="<?php echo e(route('posts.index')); ?>" class="text-link">← Volver al blog</a></p>
</article>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ2\resources\views/posts/show.blade.php ENDPATH**/ ?>