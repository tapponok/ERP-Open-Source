@extends('layouts.master')
@section('linkrel')
<link rel="stylesheet" media="screen, print" href="{{asset('css/notifications/toastr/toastr.css')}}">
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"> Stock Opname</li>
    </ol>
    <div class="subheader">
        <h3 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i>Stock Opname
        </h3>
        @can('createstockopname')
        <div class="subheader-title">
            <a class="btn btn-primary waves-effect waves-themed float-right" href="{{route('stockopname.create') }}">Create
                New</a>
        </div>
        @endcan
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table id="datatable-salesorder" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Stock Opname Code</th>
                                    <th>Created by</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script type="text/javascript">
    $(function() {
        var table = $('#datatable-salesorder').DataTable({
            processing: true,
            serverSide: false,
            // deferRender : true,
            ajax: "{{ route('stockopname.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'code',
                    name: 'Stock Opname Code'
                },
                {
                    data: 'createdby.name',
                    name: 'Created by'
                },
                {
                    data: 'created_at',
                    name: 'Created at',
                    render: function(data, type, full, meta) {
                        if (type === 'display') {
                            var date = new Date(data);
                            var day = date.getDate().toString().padStart(2, '0');
                            var month = (date.getMonth() + 1).toString().padStart(2, '0');
                            var year = date.getFullYear();
                            return day + '-' + month + '-' + year;
                        }
                        return data;
                    }
                },
                {
                    data: 'status',
                    name: 'Status',
                    render: function(data, type, full, meta) {
                        if (type === 'display') {
                            if (data === 'submit') {
                                return '<span class="badge badge-warning badge-pill">Submit</span>';
                            } else if (data === 'approved') {
                                return '<span class="badge badge-success badge-pill">Approved</span>';
                            } else {
                                return '<span class="badge badge-danger badge-pill">Cancelled</span>';
                            }
                        }
                        return data;
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        return '<div class="d-flex demo">' +
                            '<a href="/stockopname/' + full.id + '" class="btn btn-sm btn-outline-warning btn-icon btn-inline-block mr-1" title="info Record"><i class="fal fa-info"></i></a>' +
                            '</div>';
                    }
                }
            ]
        });

    });
</script>
@endsection
