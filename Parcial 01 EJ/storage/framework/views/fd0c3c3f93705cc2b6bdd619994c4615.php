<?php if(session('success')): ?>
    <div class="flash flash-success" role="status" aria-live="polite"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="flash flash-error" role="alert"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="flash flash-error" role="alert">
        <p>Revisá estos datos, che:</p>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ\resources\views/partials/flash.blade.php ENDPATH**/ ?>