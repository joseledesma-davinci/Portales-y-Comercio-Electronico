<?php $__env->startSection('title', 'Ingresar'); ?>

<?php $__env->startSection('content'); ?>
<section class="section-spacing" aria-labelledby="titulo-login">
    <h1 id="titulo-login">Ingresar a tu cuenta</h1>
    <p>Accedé para gestionar tu perfil o administrar contenido según tu rol.</p>

    <?php if($errors->any()): ?>
        <div class="flash flash-error" role="alert">Hay errores en los datos enviados. Revisá el formulario e intentá nuevamente.</div>
    <?php endif; ?>

    <form action="<?php echo e(route('auth.login.process')); ?>" method="post" class="form-card">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>">
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
            <input type="password" id="password" name="password">
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

        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>

    <p>¿No tenés cuenta? <a href="<?php echo e(route('auth.register.form')); ?>" class="text-link">Crear cuenta</a>.</p>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 02\resources\views/auth/login.blade.php ENDPATH**/ ?>