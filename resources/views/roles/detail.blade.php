@extends('layouts.master')
@section('linkrel')
<link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/select2/select2.bundle.css')}}">
<link rel="stylesheet" media="screen, print" href="{{asset('css/notifications/sweetalert2/sweetalert2.bundle.css')}}">
<link rel="stylesheet" media="screen, print" href="{{asset('css/fa-brands.css')}}">
<meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Roles and Permission
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div data-size="A4">
                            <div class="row p-2">
                                <div class="col-sm-4 d-flex">
                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>Roles :</strong>
                                                    </td>
                                                    <td>
                                                        {{$roledata->name}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div data-size="A4">
                            <div class="row p-12">
                                <div class="col-sm-12">
                                    <div id="panel-container show">
                                        <div class="row float-left p-4">
                                            <h2>
                                                List User
                                            </h2>
                                        </div>
                                        @can('createrolepermission')
                                        <div class="row float-right p-4">
                                            <button type="button" class="btn btn-primary btn-sm float-right" onclick="addrole({{ $roledata->id }})" data-toggle="modal" data-target="#createModal">
                                                Create New
                                            </button>
                                        </div>
                                        @endcan
                                        <div class="panel-content">
                                            <table class="table table-bordered table-hover table-striped w-100">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>User Email</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($role as $i => $u)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        <td>{{ $u->userlist->name }}</td>
                                                        <td>{{ $u->userlist->email }}</td>
                                                        @can('deleterolepermission')
                                                        <td>
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger btn-icon btn-inline-block mr-1" title="Delete Record" data-toggle="modal" onclick="deleteuserrole({{ $u->userlist->id }})" data-target="#DeleteModal" style="color: red"><i class="fal fa-trash"></i></a>
                                                        </td>
                                                        @endcan
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row float-right p-4">
                                <div class="demo">
                                    <a class="btn-cancel btn btn-secondary waves-effect waves-themed float-right" href="{{route('roles.index')}}"><span class="fal fa-chevron-left mr-1"></span>Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Roles and Permission
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-content">
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Roles</th>
                                        <th>Give Access</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $i => $u)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $u->name }}</td>
                                        @can('updaterolepermission')
                                        <td><input type="checkbox" class="user-checkbox" data-roles="{{$roledata->id}}" value="{{$u->id}}"  {{   !is_null($u->role_id) ? 'checked' : '' }}></td>
                                        @else
                                        <td><input type="checkbox" class="user-checkbox" data-roles="{{$roledata->id}}" value="{{$u->id}}"  disabled {{   !is_null($u->role_id) ? 'checked' : '' }}></td>
                                        @endcan
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add item to group modal -->
    <div class="modal fade" id="createModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Add user</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="addtogroup" method="POST">
                        {{csrf_field()}}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <div class="form-group">
                                <label class="form-label" for="select2-ajax">
                                    Select user
                                </label>
                                <select data-placeholder="Select user" name="userid" class="js-data-example-ajax form-control" id="selectidproduct"></select>
                            </div>
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
    <!-- delete modal -->
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
                        {{ method_field('PUT') }}
                        <input type="hidden" name="permission_id" value="{{ $roledata->id }}">
                        <h5 class="modal-title">Are you sure to delete this item?</h5>
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
<script src="{{asset('js/formplugins/select2/select2.bundle.js')}}"></script>
<script class="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#createModal').on('show.bs.modal', function(e) {
        $(".js-data-example-ajax").select2({
            minimumInputLength: 2,
            dropdownParent: $('#createModal'),
            ajax: {
                url: "{{route('ajax.getusers')}}" + "?_token=" + "{{ csrf_token() }}",
                type: "POST",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term,
                    };
                },
                processResults: function(response) {
                    return {
                        results: $.map(response, function(item) {
                            return {
                                id: item.id,
                                text: item.text
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });

    function addrole(id) {
        var id = id;
        var url = '{{ route("roleuser.add", ":id") }}';
        url = url.replace(':id', id);
        $("#addtogroup").attr('action', url);
    }

    function deleteuserrole(id) {
        var id = id;
        var url = '{{ route("roleuser.deleteuser", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    $(document).on('change', '.user-checkbox', function() {
    var permissionId = $(this).val();
    var roleId = $(this).data('roles');
    var isChecked = $(this).is(':checked');

    $.ajax({
        url: "{{ route('ajax.setrolepermission') }}" + "?_token=" + "{{ csrf_token() }}",
        type: 'POST',
        dataType: 'json',
        data: {
            permissionId: permissionId,
            checked: isChecked,
            roleId: roleId
        },
        success: function(response) {
            console.log(response.message);
            console.log(response.data);
            console.log(response.datarequest);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});
</script>
@endsection
