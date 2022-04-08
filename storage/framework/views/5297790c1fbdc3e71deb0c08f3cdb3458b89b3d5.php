<?php $__env->startSection('content'); ?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add Pharmacy</h4>
         
            <form method="POST" action="<?php echo e(route('pharmacy.store')); ?>">
                <?php echo csrf_field(); ?>

            <div class="form-group">
                <label>Pharmacy Name</label>
                <input type="text" class="form-control" name="name" placeholder="pharmacy name" required>
              </div>
                
                <button type="submit" class="btn btn-primary mr-2">Create</button>
            </form>

            </div>
        </div>
        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/a/Desktop/timetable/resources/views/dashboard/pharmacy/create.blade.php ENDPATH**/ ?>