<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'DevHost Estudio'); ?></title>
    <meta name="description" content="Estudio de Desarrollo Web & Hosting con servicios de hosting, desarrollo y mantenimiento.">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>
<body>
<header class="site-header">
    <div class="container header-content">
        <a href="<?php echo e(route('site.home')); ?>" class="brand" aria-label="Ir al inicio de DevHost Estudio">DevHost Estudio</a>
        <nav aria-label="Navegación principal">
            <ul class="nav-list">
                <li><a href="<?php echo e(route('site.home')); ?>">Inicio</a></li>
                <li><a href="<?php echo e(route('site.services')); ?>">Servicios</a></li>
                <li><a href="<?php echo e(route('site.blog')); ?>">Blog</a></li>
                <li><a href="<?php echo e(route('admin.login')); ?>">Admin</a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <div class="container">
        <?php echo $__env->make('partials.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</main>

<footer class="site-footer">
    <div class="container footer-content">
        <p>© <?php echo e(now()->year); ?> DevHost Estudio. Soluciones web y hosting para negocios que quieren crecer en serio.</p>
    </div>
</footer>
</body>
</html>
<?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ\resources\views/layouts/app.blade.php ENDPATH**/ ?>