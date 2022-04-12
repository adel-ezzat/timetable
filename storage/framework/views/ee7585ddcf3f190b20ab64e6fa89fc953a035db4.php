<?php $__env->startSection('content'); ?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create role</h4>
         
            <form method="POST" action="<?php echo e(route('role.store')); ?>">
                <?php echo csrf_field(); ?>

            <div class="form-group">
                <label>Role Name</label>
                <input type="text" class="form-control" name="role" placeholder="role name" required>
              </div>

            <div class="row">
                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo e(Form::checkbox('permission[]', $permission->id )); ?> <?php echo e($permission->name); ?> <i class="input-helper">
                      </i>
                    </label>
                  </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
                
                <button type="submit" class="btn btn-primary mr-2">Create</button>
            </form>

            </div>
        </div>
        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/a/Desktop/timetable/resources/views/dashboard/role/create.blade.php ENDPATH**/ ?>