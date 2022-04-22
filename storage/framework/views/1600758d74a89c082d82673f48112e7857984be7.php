<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo e(config('app.name', 'Laravel')); ?></title>
  
        <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/mdi/css/materialdesignicons.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/css/vendor.bundle.base.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/jquery-toast-plugin/jquery.toast.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/select2/select2.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/modern-vertical/style.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/timetable/timetablejs.css')); ?>">
        <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" />
        <?php echo $__env->yieldContent('styles'); ?>
    </head>

    <body>
        <div class="container-scroller">
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
        <script src="<?php echo e(asset('/assets/vendors/js/vendor.bundle.base.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/off-canvas.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/hoverable-collapse.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/misc.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/vendors/datatables.net/jquery.dataTables.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/data-table.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/vendors/jquery-toast-plugin/jquery.toast.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/vendors/sweetalert/sweetalert.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/vendors/select2/select2.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/vendors/moment/moment.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/vendors/timetable/timetable.js')); ?>"></script>


        <?php echo $__env->yieldContent('scripts'); ?>
    </body>

</html>
<?php /**PATH /Users/a/Desktop/timetable/resources/views/layouts/app.blade.php ENDPATH**/ ?>