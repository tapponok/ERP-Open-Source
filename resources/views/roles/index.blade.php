@extends('layouts.master')
@section('linkrel')
<link rel="stylesheet" media="screen, print" href="{{asset('css/notifications/toastr/toastr.css')}}">
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item">Roles</li>
    </ol>
    <div class="subheader">
        <h3 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i>Roles
        </h3>
        @can('createrolepermission')
        <div class="subheader-title">
            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                data-target="#exampleModal">
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
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles  as $i => $u)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>
                                        <div class="d-flex demo">
                                        <a href="{{ route('roles.show', ['role' => $u->id]) }}"
                                                class="btn btn-sm btn-outline-warning btn-icon btn-inline-block mr-1"
                                                title="info Record"><i class="fal fa-info"></i></a>
                                        @can('createrolepermission')
                                        <a href="javascript:void(0);"
                                                class="btn btn-sm btn-outline-danger btn-icon btn-inline-block mr-1"
                                                title="Delete Record" data-toggle="modal"
                                                onclick="deleteData({{ $u->id }})" data-target="#DeleteModal"
                                                style="color: red"><i class="fal fa-trash"></i></a>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Roles</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('roles.store')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="">Role</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter role name"
                                required>
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
                    <h3 class="modal-title">Update Permission</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <form action="" id="updateForm" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <input type="text" name="name" class="form-control" value="" placeholder="Enter permission"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
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
    $('#updateModal').on('show.bs.modal', function (e) {
        var Name = $(e.relatedTarget).data('name');
        $(e.currentTarget).find('input[name="name"]').val(Name);
    });

    function deleteData(id) {
        var id = id;
        var url = '{{ route("roles.destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function updateData(id) {
        var id = id;
        var url = '{{ route("roles.update", ":id") }}';
        url = url.replace(':id', id);
        $("#updateForm").attr('action', url);
    }
    $('form').submit(function () {
        $(this).find(':submit').attr('disabled', 'disabled');
    });
</script>
@endsection
