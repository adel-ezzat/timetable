<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo e(config('app.name', 'Laravel')); ?></title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/mdi/css/materialdesignicons.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/css/vendor.bundle.base.css')); ?>">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/modern-vertical/style.css')); ?>">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" />
        <?php echo $__env->yieldContent('styles'); ?>
    </head>

    <body>
        <div class="container-scroller">

            <!-- partial:partials/_sidebar.html -->
            <?php if(auth()->guard()->check()): ?>
            <?php echo $__env->make('dashboard.partials.side-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('dashboard.partials.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="container-fluid page-body-wrapper">
                <div class="main-panel">
                    <div class="content-wrapper">
                        <?php echo $__env->make('dashboard.partials.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="row">
                           <?php echo $__env->yieldContent('content'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('body'); ?>

       
        </div>
        <!-- page-body-wrapper ends -->
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="<?php echo e(asset('/assets/vendors/js/vendor.bundle.base.js')); ?>"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <?php echo $__env->yieldContent('scripts'); ?>
        <script src="<?php echo e(asset('assets/js/off-canvas.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/hoverable-collapse.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/misc.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/settings.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/todolist.js')); ?>"></script>
        <!-- endinject -->
    </body>

</html>
<?php /**PATH /Users/a/Desktop/timetable/resources/views/layouts/app.blade.php ENDPATH**/ ?>