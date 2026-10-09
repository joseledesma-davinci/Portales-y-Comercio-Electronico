<?php $__env->startSection('title', 'Ingreso al panel admin'); ?>

<?php $__env->startSection('content'); ?>
<section class="section-spacing" aria-labelledby="admin-login-title">
    <h1 id="admin-login-title">Ingreso al panel administrativo</h1>
    <p>Accedé con tu usuario administrador para gestionar las publicaciones del blog.</p>

    <form action="<?php echo e(route('admin.login.attempt')); ?>" method="POST" class="form-card" novalidate>
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" autocomplete="email">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="field-error"><?php echo e($message); ?></small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" name="password" type="password" autocomplete="current-password">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="field-error"><?php echo e($message); ?></small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="btn btn-primary">Ingresar al panel</button>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ\resources\views/admin/login.blade.php ENDPATH**/ ?>