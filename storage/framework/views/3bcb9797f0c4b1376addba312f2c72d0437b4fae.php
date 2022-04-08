<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-inverse-primary">
            <?php $__currentLoopData = Request::segments(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $segment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($loop->last ): ?> 
            <li class="breadcrumb-item">
                <a href="<?php echo e(Request::url()); ?>">
                <?php if($loop->iteration !== 2): ?>
                    <?php echo e($segment); ?>

                <?php endif; ?>
                </a>
                <?php else: ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($segment); ?></li>
                <?php endif; ?>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



        </ol>
    </nav>
</div><?php /**PATH /Users/a/Desktop/timetable/resources/views/dashboard/partials/breadcrumbs.blade.php ENDPATH**/ ?>