<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', ''); ?> :: DevHost Estudio</title>
    <meta name="description" content="Estudio de Desarrollo Web & Hosting con servicios de hosting, desarrollo y mantenimiento.">
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('favicon.svg')); ?>">
    <link rel="alternate icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    
</head>
<body>
<div id="app">
    <header class="site-header">
        <div class="container header-content">
            <a class="brand" href="<?php echo e(route('home')); ?>">DevHost Estudio</a>
            <nav aria-label="Navegación principal del sitio">
                <ul class="nav-list">
                    <li><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                    <li><a href="<?php echo e(route('services.index')); ?>">Servicios</a></li>
                    <li><a href="<?php echo e(route('posts.index')); ?>">Blog</a></li>
                    <li><a href="<?php echo e(route('auth.login.form')); ?>" class="nav-admin-link">Iniciar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <?php echo $__env->make('partials.feedback', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container footer-content">
            <p>© <?php echo e(now()->year); ?> DevHost Estudio — Tecnología que acompaña tu crecimiento.</p>
        </div>
    </footer>
</div>
</body>
</html>
<?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01\resources\views/layouts/app.blade.php ENDPATH**/ ?>