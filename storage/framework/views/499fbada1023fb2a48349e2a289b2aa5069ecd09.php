<?php $__env->startSection('content'); ?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Pharmacy</h4>
         
            <form method="POST" action="<?php echo e(route('pharmacy.update')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo e(Form::hidden('id', $pharmacy->id)); ?>


            <div class="form-group">
                <label>Pharmacy Name</label>
                
                <?php echo Form::text('name', $pharmacy->name, array('placeholder' => 'pharmacy name','class' => 'form-control', 'required')); ?>


              </div>
                
                <button type="submit" class="btn btn-primary mr-2">Update</button>
            </form>

            </div>
        </div>
        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/a/Desktop/timetable/resources/views/dashboard/pharmacy/edit.blade.php ENDPATH**/ ?>