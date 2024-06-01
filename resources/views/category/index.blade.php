@extends('layouts.master')
@section('linkrel')
<link rel="stylesheet" media="screen, print" href="{{asset('css/notifications/toastr/toastr.css')}}">
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"> Category</li>
    </ol>
    <div class="subheader">
        <h3 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i>Category
        </h3>
        @can('createcategory')
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
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $i => $u)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $u->categ_name }}</td>
                                    <td>
                                        <div class="d-flex demo">
                                            @can('updatecategory')
                                            <a href="javascript:void(0);"
                                                class="btn btn-sm btn-outline-primary btn-icon btn-inline-block mr-1"
                                                title="update" id="update" data-toggle="modal"
                                                data-categ-name="{{ $u->categ_name }}"
                                                onclick="updateData({{ $u->id }})" data-target="#updateModal">
                                                <i class="fal fa-edit"></i></a>
                                            @endcan
                                            @can('deletecategory')
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
                    <h5 class="modal-title" id="exampleModalLabel">Category Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('category.store')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="">Category</label>
                            <input type="text" name="categ_name" class="form-control" placeholder="Enter category"
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
                    <h3 class="modal-title">Update Category</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <form action="" id="updateForm" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <input type="text" name="categ_name" class="form-control" value="" placeholder="Enter category"
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
        var categName = $(e.relatedTarget).data('categ-name');
        $(e.currentTarget).find('input[name="categ_name"]').val(categName);
    });

    function deleteData(id) {
        var id = id;
        var url = '{{ route("category.destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function updateData(id) {
        var id = id;
        var url = '{{ route("category.update", ":id") }}';
        url = url.replace(':id', id);
        $("#updateForm").attr('action', url);
    }
    $('form').submit(function () {
        $(this).find(':submit').attr('disabled', 'disabled');
    });
</script>
@endsection
