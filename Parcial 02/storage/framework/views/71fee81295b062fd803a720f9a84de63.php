<?php if($paginator->hasPages()): ?>
    <!-- PAGINADOR-PROPIO-V2 -->
    
    
    <nav aria-label="Paginación">
        <ul class="pagination">
            
            <?php if($paginator->onFirstPage()): ?>
                <li>
                    <span class="pagination__link is-disabled" aria-disabled="true">Anterior</span>
                </li>
            <?php else: ?>
                <li>
                    <a class="pagination__link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">Anterior</a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(is_string($element)): ?>
                    <li>
                        <span class="pagination__link is-disabled" aria-disabled="true"><?php echo e($element === '...' ? '…' : $element); ?></span>
                    </li>
                <?php elseif(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li>
                                <span class="pagination__link is-active" aria-current="page"><?php echo e($page); ?></span>
                            </li>
                        <?php else: ?>
                            <li>
                                <a class="pagination__link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li>
                    <a class="pagination__link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">Siguiente</a>
                </li>
            <?php else: ?>
                <li>
                    <span class="pagination__link is-disabled" aria-disabled="true">Siguiente</span>
                </li>
            <?php endif; ?>
        </ul>

        
        <p class="pagination__summary">
            Mostrando <?php echo e($paginator->firstItem()); ?> a <?php echo e($paginator->lastItem()); ?> de <?php echo e($paginator->total()); ?> publicaciones
        </p>
    </nav>
<?php endif; ?>
<?php /**PATH D:\DAVINCI\Portales y Comercio Electronico\Parcial 02\resources\views/pagination/site.blade.php ENDPATH**/ ?>