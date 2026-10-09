<?php if(session()->has('feedback.message')): ?>
    <div class="flash flash-success" role="status" aria-live="polite">
        <?php echo e(session('feedback.message')); ?>

    </div>
<?php endif; ?>

<?php if(session()->has('feedback.error')): ?>
    <div class="flash flash-error" role="alert">
        <?php echo e(session('feedback.error')); ?>

    </div>
<?php endif; ?>
<?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 01 EJ2\resources\views/partials/feedback.blade.php ENDPATH**/ ?>