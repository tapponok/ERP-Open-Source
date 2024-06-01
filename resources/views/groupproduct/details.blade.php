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
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item">Group product</li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Group product detail
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                            data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                            data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close"
                            data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
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
                                                        <strong>Name</strong>
                                                    </td>
                                                    <td>
                                                        {{ $group->name }}
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
                                                Product Collection
                                            </h2>
                                        </div>
                                        @can('creategroupproduct')
                                        <div class="row float-right p-4">
                                            <button type="button" class="btn btn-primary btn-sm float-right" onclick="addproduct({{ $group->id }})"
                                                data-toggle="modal" data-target="#createModal">
                                                Create New
                                            </button>
                                        </div>
                                        @endcan
                                        <div class="panel-content">
                                            <table class="table table-bordered table-hover table-striped w-100">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Product Code</th>
                                                        <th>Product Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($product as $i => $u)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        <td>{{ $u->product_code }}</td>
                                                        <td>{{ $u->product_name }}</td>
                                                        @can('deletegroupproduct')
                                                        <td>
                                                            <a href="javascript:void(0);"
                                                                class="btn btn-sm btn-outline-danger btn-icon btn-inline-block mr-1"
                                                                title="Delete Record" data-toggle="modal"
                                                                onclick="deleteData({{ $u->id }})"
                                                                data-target="#DeleteModal" style="color: red"><i
                                                                    class="fal fa-trash"></i></a>
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
                                    <a class="btn-cancel btn btn-secondary waves-effect waves-themed float-right"
                                        href="{{route('groupproduct.index')}}"><span
                                            class="fal fa-chevron-left mr-1"></span>Back</a>
                                </div>
                            </div>
                        </div>
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
                    <h3 class="modal-title" id="exampleModalLabel">Add Product</h3>
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
                                    Select Product
                                </label>
                                <select data-placeholder="Select product" name="idproduct"
                                    class="js-data-example-ajax form-control" id="selectidproduct"></select>
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
    $('#createModal').on('show.bs.modal', function (e) {
        $(".js-data-example-ajax").select2({
            minimumInputLength: 2,
            dropdownParent: $('#createModal'),
            ajax: {
                url: "{{route('ajax.getproduct')}}" + "?_token=" + "{{ csrf_token() }}",
                type: "POST",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term,
                    };
                },
                processResults: function (response) {
                    return {
                        results: $.map(response, function (item) {
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
    function addproduct(id) {
        var id = id;
        var url = '{{ route("collectionproduct.add", ":id") }}';
        url = url.replace(':id', id);
        $("#addtogroup").attr('action', url);
    }
    function deleteData(id){
        var id =id;
        var url = '{{ route("collectionproduct.delete", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }
</script>
@endsection
