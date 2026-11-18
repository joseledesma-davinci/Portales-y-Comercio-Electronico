<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Panel'); ?> :: DevHost Estudio</title>
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('favicon.svg')); ?>">
    <link rel="alternate icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
</head>
<body>
<header class="admin-header">
    <div class="admin-container admin-header-content">
        <a class="admin-brand" href="<?php echo e(route('admin.dashboard')); ?>">Panel DevHost</a>
        <nav aria-label="Navegación del panel de administración">
            <ul class="admin-nav-list">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>">Panel</a></li>
                <li><a href="<?php echo e(route('admin.posts.index')); ?>">Publicaciones</a></li>
                <li>
                    <form action="<?php echo e(route('auth.logout')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-ghost">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main class="admin-main">
    <div class="admin-container">
        <?php echo $__env->make('partials.feedback', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</main>
</body>
</html>
<?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01\resources\views/layouts/admin.blade.php ENDPATH**/ ?>