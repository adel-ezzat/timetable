<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/timetable/timetablejs.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/select2/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/mdi/css/materialdesignicons.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/modern-vertical/style.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/timetable/demo.css')); ?>">


<style>
    .container,
    .container-fluid,
    .container-sm,
    .container-md,
    .container-lg,
    .container-xl {
        padding-right: unset;
        padding-left: unset;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="col-12 grid-margin stretch-card">

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label>From</label>

                        <div class="input-group date" id="from" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input"
                                data-target="#from" />
                            <div class="input-group-append" data-target="#from"
                                data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="mdi mdi-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>To</label>

                        <div class="input-group date datepicker" id="to"
                            data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input"
                                data-target="#to" />
                            <div class="input-group-append" data-target="#to"
                                data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="mdi mdi-calendar"></i>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-form-label">Pharamcy:</label>
                        <select class="select2" id="pharmacy" style="width:100%">
                            <?php $__currentLoopData = $pharmacies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pharmacy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($pharmacy->id); ?>"><?php echo e($pharmacy->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group" style="margin-top: 37px;">
                            <a href="#" onclick="generateTable()" class="btn btn-primary"
                                role="button"><i
                                    class="mdi mdi mdi-plus-circle btn-icon-prepend"></i>Generate</a>
                        </div>
                    </div>
                </div>


            </div>

            <div class="timetable"></div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/vendors/timetable/timetable.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/select2/select2.min.js')); ?>"></script>

<script>
    $('#from').datetimepicker({
        format: 'YYYY-MM-DD',
        date: moment()
    });
    $('#to').datetimepicker({
        useCurrent: false,
        format: 'YYYY-MM-DD',
        date: moment().add(7, 'days')
    });
    $("#from").on("change.datetimepicker", function (e) {
        $('#to').datetimepicker('minDate', e.date);
    });
    $("#to").on("change.datetimepicker", function (e) {
        $('#from').datetimepicker('maxDate', e.date);
    });
    $(".select2").select2();

    function generateTable() {
        var from = $("#from").datetimepicker('viewDate').format("YYYY-MM-DD");
        var to = $("#to").datetimepicker('viewDate').format("YYYY-MM-DD");
        var pharmacy_id = $("#pharmacy").val();

        $.ajax({
            type: "post",
            url: "<?php echo e(route('home.generate-time-table')); ?>",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                pharmacy_id,
                from,
                to
            },
            success: function (res) {
                var timetable = new Timetable();

                timetable.setScope(0, 23)
                timetable.useTwelveHour();

                var arr = [];

                $.each(res.date_range, function (key, val) {
                    arr.push(val.date_day);
                });

                timetable.addLocations(arr);

                $.each(res.timeslots, function (key, val) {
                    timetable.addEvent(val.pharmacy['name'],
                        val.date_day,
                        new Date(`${val.date} ${val.start_time}`),
                        new Date(`${val.date} ${val.end_time}`));
                });

                var renderer = new Timetable.Renderer(timetable);
                renderer.draw('.timetable');

            }
        });


    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/a/Desktop/timetable/resources/views/user/timetable/index.blade.php ENDPATH**/ ?>