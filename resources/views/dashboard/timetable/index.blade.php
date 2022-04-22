@extends('layouts.app')

@section('content')
<div class="col-12 grid-margin stretch-card">

    <div class="card">

        <div class="card-body">
            <h4 class="card-title">Add Timtable</h4>
            <div class="row">
                <div class="col-12">

                        <div class="card-body">
                          <div class="modal fade" id="add-time-slot" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                           
                              <div class="modal-dialog" role="document">

                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="ModalLabel">Add time Slot</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                
                                <div class="modal-body">
                                  <form>
                                    <div class="form-group">
                                      <label class="col-form-label">Pharamcy:</label>
                                      <select class="select2" id="pharmacy" style="width:100%">
                                          @foreach ($pharmacies as $pharmacy)
                                          <option value="{{ $pharmacy->id }}">{{ $pharmacy->name }}</option>
                                          @endforeach
                                          </select>
                                    </div>

                                    <div class="form-group">
                                      <div class="row">

                                          <div class="col">
                                              <label for="message-text" class="col-form-label">From:</label><br>   
                                              <input id="time-from" type="time" value="00:00" step="3600">
                                          </div>

                                          <div class="col">
                                              <label for="message-text" class="col-form-label">To:</label><br>
                                              <input id="time-to" type="time" value="00:00" step="3600">
                                          </div>
                                      </div>
                                  </div>
                                    

                                </form>
                              </div>

                                <div class="modal-footer">
                                  <button type="button" id="submit" class="btn btn-success">Add</button>
                                  <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                </div>

                              </div>
                            </div>
                          </div>



                    



                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>From</label>

                                <div class="input-group date" id="from" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#from" />
                                    <div class="input-group-append" data-target="#from" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="mdi mdi-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>To</label>

                                <div class="input-group date datepicker" id="to" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#to" />
                                    <div class="input-group-append" data-target="#to" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="mdi mdi-calendar"></i></div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>User</label>
                                <div class="form-group mt-1"">
                            <select class="select2" id="user" style="width:100%">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group mt-4">
                                    <a href="#" onclick="generateTable()" class="btn btn-primary" role="button"><i
                                            class="mdi mdi mdi-plus-circle btn-icon-prepend"></i>Generate</a>
                                </div>
                            </div>
                        </div>


                    </div>




                    <div id="timetable"></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    // toast alert
    function toast(msg, icon) {
        $.toast({
            heading: '<b>Status</b>',
            text: `<b>${msg}</b>`,
            showHideTransition: 'slide',
            icon: icon,
            hideAfter: 10000,
            loaderBg: '#f96868',
            position: 'top-right'
        })
    }


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
        var data = {
            from,
            to
        }

        var tr = '';

        $.ajax({
            type: 'post',
            url: '{{ route('timetable.generate-dates-range') }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function (res) {

                $.each(res, function (key, obj) {
                    tr += `<tr>
                          <td>${obj.date}</td>

                          <td>${obj.day_name}</td>

                          <td>
                              <button type="button" class="btn btn-info" data-toggle="modal"
                                  data-target="#add-time-slot" data-date="${obj.date}" data-id="${key}">Add
                                  Time Slot</button>
                          </td>

                      </tr>`;
                });

                var table = `<div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th> Date </th>
                      <th> Day Name </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                   ${tr}
                  </tbody>
                </table>
              </div>`;

                // append table to DOM
                $('#timetable').html(table);
            },
            error: function (res) {
                $.each(res.responseJSON.errors, function (key, val) {
                    toast(val, 'error');
                });
            }
        });
        }


    $('#add-time-slot').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var date = button.data('date');
        var modal = $(this)

        modal.find('#submit').attr({date});
    });


    $('#submit').click(function (event) {

        event.preventDefault();
        var user_id = $('#user').val();
        var pharmacy_id = $('#pharmacy').val();
        var start_time = $('#time-from').val();
        var end_time = $('#time-to').val();
        var date = $("#submit").attr('date'); 

        // check from time is not after to time
        var beginningTime = moment(start_time, 'hh:mm');
        var endTime = moment(end_time, 'hh:mm');

        var isTimeAfter = beginningTime.isAfter(start_time);
        var isTimeEqual = beginningTime.isSame(end_time);

        if (isTimeAfter || isTimeEqual) {
            toast('From time must before to time!', 'error');
        }

        $.ajax({
            type: "post",
            url: "{{ route('timetable.store') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                user_id,
                pharmacy_id,
                start_time,
                end_time,
                date,
            },
            success: function (res) {
                toast(res.msg, res.icon);

                if(res.timeslots.length > 0){
                    $.each(res.timeslots, function (key, val) {
                        toast(`time slot from:${val.start_time} to:${val.end_time} is already taken! `, 'error');
                    });
                }

                $("#add-time-slot").modal('hide');
               
            }, error: function(res) {
                $.each(res.responseJSON.errors, function (key, val) {
                    toast(val, 'error');
                });
            }
        });

    });
</script>
@endsection
