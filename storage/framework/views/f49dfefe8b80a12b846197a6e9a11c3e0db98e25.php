<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/jquery-toast-plugin/jquery.toast.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="col-12 grid-margin stretch-card">

    <div class="card">

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add Managers')): ?>
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h3 class="mr-auto p-3"></h3>
                <div class="btn-group" role="group">
                    <a href="<?php echo e(route('admin.create')); ?>" class="btn btn-primary" role="button"><i
                        class="mdi mdi mdi-plus-circle btn-icon-prepend"></i>Add Manager</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="card-body">
            <h4 class="card-title">Managers</h4>

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check form-check-muted m-0">
                                            <label class="form-check-label">
                                                <input type="checkbox" id="chkAll" class="form-check-input">
                                            </label>
                                        </div>
                                    </th>
                                    <th>Name</th>
                                    <th>E-Mail</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-muted m-0">
                                            <label class="form-check-label">
                                                <input type="checkbox" id="<?php echo e($admin->id); ?>" class="form-check-input">
                                            </label>
                                        </div>
                                    </td>
                                    <td><?php echo e($admin->name); ?></td>
                                    <td><?php echo e($admin->email); ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Managers')): ?>   
                                        <a href="<?php echo e(route('admin.edit', $admin->id)); ?>" class="btn btn-outline-primary"
                                            role="button">Edit</a>
                                        <?php endif; ?>
                                       
                                        <?php if($admin->id != 1): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Managers')): ?>
                                        <a href="#" class="btn btn-outline-danger" onclick="deleteButton( <?php echo e($admin->id); ?> )" role="button">Delete</a>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <form class="form-inline" >
                <div class="form-group btn-sm">
                    <select class="form-control btn-sm" id="actions" name="group" required>
                        <option disabled selected value=""> Select action </option>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Managers')): ?>
                        <option value="deleteAll"> Delete </option>
                        <?php endif; ?>
                    </select>
                </div>

                <button type="button" style="background: black;border: 1px solid #292b31;" class="btn btn-ml"
                    id="actionBtn"> Apply </button>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/vendors/datatables.net/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/data-table.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/jquery-toast-plugin/jquery.toast.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/sweetalert/sweetalert.min.js')); ?>"></script>

<script>
    // toast alert
    function toast(msg, icon) {
        $.toast({
            heading:'<b>Status</b>',
            text: `<b>${msg}</b>`,
            showHideTransition: 'slide',
            icon: icon,
            hideAfter: 10000,
            loaderBg: '#f96868',
            position: 'top-right'
        })
    };

        // swal confrim 
        function swalConfirm(callback) {
            swal({
            title: 'Are you sure?',
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3f51b5',
            cancelButtonColor: '#ff4081',
            confirmButtonText: 'Great ',
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true,
                },
                confirm: {
                    text: "Okay",
                    value: true,
                    visible: true,
                    className: "btn btn-primary",
                    closeModal: true
                }
            }
        }).then((result) => {
            if (result) {
                callback();
            }
        });
    }

    // ajax request 
    function request(type, url, data) {
        $.ajax({
            type: type,
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'data': data
            },
            success: function (res) {
                toast(res.msg, res.icon);
            }
        });
    }

    // Select All 
    var selected = $('#chkAll').change(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    // Table Action Function
       $("#actionBtn").click(function (e) {
        e.preventDefault();
        var $this = $(this);
        var select = $this.parent().find("#actions");

        if (select.val() == null) {
            toast('You should select an action', 'error');
        } else if (select.val() == 'deleteAll') {
            deleteSelected();
        }
    });


    // Get Selected 
    function getSelected() {
        return $("#order-listing input:checkbox:checked").map(function () {
            return $(this).not('#chkAll, [id=1]').attr("id");
        }).get();
    }

    // remove row selected
    function deleteRowSelected() {
        return $("#order-listing input:checkbox:checked").map(function () {
            $(this).not('#chkAll, [id=1]').parents('tr').fadeOut("normal", function () {
                $(this).remove();
            });
        }).get();
    }

    // delete row button
    function removeRowButton(id) {
        $('#'+id).not('#chkAll').parents('tr').fadeOut("normal", function () {
                $(this).remove();
         });
    }
    
    // Delete selected Function 
    function deleteSelected(id) {
        swalConfirm(function() {
            var ids = getSelected();
                 request('post', '<?php echo e(route('admin.destroy')); ?>', ids);
                 deleteRowSelected();
        })
    }

      // Delete by  button
      function deleteButton(id) {
        swalConfirm(function() {
            var ids = getSelected();
                 request('post', '<?php echo e(route('admin.destroy')); ?>', {id});
                 removeRowButton(id);
        })
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/a/Desktop/timetable/resources/views/dashboard/admin/index.blade.php ENDPATH**/ ?>