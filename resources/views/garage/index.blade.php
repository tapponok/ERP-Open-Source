@extends('layouts.master')
@section('linkrel')
<link rel="stylesheet" media="screen, print" href="{{asset('css/notifications/toastr/toastr.css')}}">
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"> Garage</li>
    </ol>
    <div class="subheader">
        <h3 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i>Garage
        </h3>
        @can('creategarage')
        <div class="subheader-title">
            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
                Create New
            </button>
        </div>
        @endcan
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Garage</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Province</th>
                                    <th>Postal code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($garage as $i => $u)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $u->garagename }}</td>
                                    <td>{{ $u->address }}</td>
                                    <td>{{ $u->city }}</td>
                                    <td>{{ $u->province }}</td>
                                    <td>{{ $u->postalcode }}</td>
                                    <td>
                                        <div class="d-flex demo">
                                            @can('updategarage')
                                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary btn-icon btn-inline-block mr-1" title="update" id="update" data-toggle="modal" data-garagename="{{ $u->garagename }}" data-address="{{ $u->address }}" data-city="{{ $u->city }}" data-province="{{ $u->province }}" data-postalcode="{{ $u->postalcode }}" onclick="updateData({{ $u->id }})" data-target="#updateModal">
                                                <i class="fal fa-edit"></i></a>
                                            @endcan
                                            @can('deletegarage')
                                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger btn-icon btn-inline-block mr-1" title="Delete Record" data-toggle="modal" onclick="deleteData({{ $u->id }})" data-target="#DeleteModal" style="color: red"><i class="fal fa-trash"></i></a>
                                            @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Garage</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('garage.store')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="garagename" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea class="form-control" name="address" rows="3" placeholder="Enter address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">City</label>
                            <input type="text" name="city" class="form-control" placeholder="Enter city">
                        </div>
                        <div class="form-group">
                            <label for="">Province</label>
                            <input type="text" name="province" class="form-control" placeholder="Enter province">
                        </div>
                        <div class="form-group">
                            <label for="">Postal Code</label>
                            <input type="number" name="postalcode" class="form-control" placeholder="Enter postal code">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal update -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Update Garage</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <form action="" id="updateForm" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="garagename" class="form-control" value="" placeholder="Enter category" required>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">City</label>
                            <input type="text" name="city" class="form-control" placeholder="Enter city">
                        </div>
                        <div class="form-group">
                            <label for="">Province</label>
                            <input type="text" name="province" class="form-control" placeholder="Enter province">
                        </div>
                        <div class="form-group">
                            <label for="">Postal Code</label>
                            <input type="number" name="postalcode" class="form-control" placeholder="Enter postal code">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal delete -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Confirmation!!!</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <form action="" id="deleteForm" method="post">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <h5 class="modal-title">Are you sure to delete this item?</h5>
                        <input type="hidden" name="id" id="id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')

<script type="text/javascript">
    $('#updateModal').on('show.bs.modal', function(e) {
        var garagename = $(e.relatedTarget).data('garagename');
        var address = $(e.relatedTarget).data('address');
        var city = $(e.relatedTarget).data('city');
        var province = $(e.relatedTarget).data('province');
        var postalcode = $(e.relatedTarget).data('postalcode');

        $(e.currentTarget).find('input[name="garagename"]').val(garagename);
        $('#address').val(address);
        $(e.currentTarget).find('input[name="city"]').val(city);
        $(e.currentTarget).find('input[name="province"]').val(province);
        $(e.currentTarget).find('input[name="postalcode"]').val(postalcode);
    });

    function deleteData(id) {
        var id = id;
        var url = '{{ route("garage.destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function updateData(id) {
        var id = id;
        var url = '{{ route("garage.update", ":id") }}';
        url = url.replace(':id', id);
        $("#updateForm").attr('action', url);
    }

    $('form').submit(function() {
        $(this).find(':submit').attr('disabled', 'disabled');
    });
</script>
@endsection
