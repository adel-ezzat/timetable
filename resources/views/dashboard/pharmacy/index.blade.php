@extends('layouts.app')

@section('content')
<div class="col-12 grid-margin stretch-card">

    <div class="card">
 
    @can('Add Pharmacies')
        <div class="card-header">
        <div class="d-flex align-items-center">
            <h3 class="mr-auto p-3"></h3>
            <div class="btn-group" role="group">
                <a href="{{ route('pharmacy.create') }}" class="btn btn-primary" role="button"><i
                    class="mdi mdi mdi-plus-circle btn-icon-prepend"></i>Add Pharmacy</a>
                </div>
            </div>
        </div>
    @endcan

        <div class="card-body">
            <h4 class="card-title">Pharmacies</h4>
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pharmacies as $pharmacy)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-muted m-0">
                                            <label class="form-check-label">
                                                <input type="checkbox" id="{{ $pharmacy->id }}" class="form-check-input">
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $pharmacy->name }}</td>
                                    <td>
                                       @can('Edit Pharmacies')
                                       <a href="{{ route('pharmacy.edit', $pharmacy->id) }}" class="btn btn-outline-primary"
                                        role="button">Edit</a>
                                       @endcan
                                    
                                       @can('Delete Pharmacies') 
                                        <a href="#" class="btn btn-outline-danger" onclick="deleteButton( {{ $pharmacy->id }} )" role="button">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <form class="form-inline" >
                <div class="form-group btn-sm">
                    <select class="form-control btn-sm" id="actions" name="group" required>
                        <option disabled selected value=""> Select action </option>
                        @can('Delete Pharmacies') 
                        <option value="deleteAll"> Delete </option>
                        @endcan
                    </select>
                </div>

                <button type="button" style="background: black;border: 1px solid #292b31;" class="btn btn-ml"
                    id="actionBtn"> Apply </button>
            </form>

        </div>
    </div>
</div>
@endsection

@section('scripts')

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
            return $(this).not('#chkAll').attr("id");
        }).get();
    }

    // remove row selected
    function deleteRowSelected() {
        return $("#order-listing input:checkbox:checked").map(function () {
            $(this).not('#chkAll').parents('tr').fadeOut("normal", function () {
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
                 request('post', '{{ route('pharmacy.destroy-ajax') }}', ids);
                 deleteRowSelected();
        })
    }

      // Delete by  button
      function deleteButton(id) {
        swalConfirm(function() {
            var ids = getSelected();
                 request('post', '{{ route('pharmacy.destroy-ajax') }}', {id});
                 removeRowButton(id);
        })
    }

</script>
@endsection
