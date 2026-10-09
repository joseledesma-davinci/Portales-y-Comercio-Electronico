<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Panel Admin'); ?> - DevHost Estudio</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
</head>
<body>
<header class="admin-header">
    <div class="admin-container admin-header-content">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="admin-brand">Panel DevHost Estudio</a>
        <nav aria-label="Navegación del panel">
            <ul class="admin-nav-list">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li><a href="<?php echo e(route('admin.posts.create')); ?>">Nueva publicación</a></li>
                <li>
                    <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-ghost">Salir</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main class="admin-main">
    <div class="admin-container">
        <?php echo $__env->make('partials.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</main>
</body>
</html>
<?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ\resources\views/layouts/admin.blade.php ENDPATH**/ ?>