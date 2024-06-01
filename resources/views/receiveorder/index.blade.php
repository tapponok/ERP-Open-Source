@extends('layouts.master')
@section('linkrel')
<link rel="stylesheet" media="screen, print" href="{{asset('css/notifications/toastr/toastr.css')}}">
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"> Receive Order</li>
    </ol>
    <div class="subheader">
        <h3 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i>Receive Order
        </h3>
        @can('createreceiveorder')
        <div class="subheader-title">
            <a class="btn btn-primary waves-effect waves-themed float-right" href="{{route('receiveorder.create') }}">Create
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
                        <table id="datatable-receiveordeer" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Receive Order</th>
                                    <th>Purchase Order</th>
                                    <th>Purchase Invoice</th>
                                    <th>Garage</th>
                                    <th>Supplier</th>
                                    <th>Receiver</th>
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
<script>
    $(document).ready(function() {
        $('#datatable-receiveordeer').dataTable({
            responsive: true,
            processing: true,
            serverside: false,
            ajax: "{{route('receiveorder.index')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'codereceived',
                    name: 'Receive Order'
                },
                {
                    data: 'purchaseorderid.po_number',
                    name: 'Purchase Order'
                },
                {
                    data: 'puchaseinvoiceid.pi_number',
                    name: 'Purchase Invoice'
                },
                {
                    data: 'garageid.garagename',
                    name: 'Garage'
                },
                {
                    data: 'supplierid.supplier_name',
                    name: 'Supplier'
                },
                {
                    data: 'receivedby.name',
                    name: 'Receiver'
                },
                {
                    data: 'status',
                    name: 'Status',
                    render: function(data, type, full, meta) {
                        if (type === 'display') {
                            var status = '';
                            if (data === 'submit') {
                                status = '<span class="badge badge-warning badge-pill">Submit</span>';
                            } else if (data === 'approved') {
                                status = '<span class="badge badge-success badge-pill">Approved</span>';
                            } else if (data === 'finish') {
                                status = '<span class="badge badge-secondary badge-pill">Finish</span>';
                            } else {
                                status = '<span class="badge badge-danger badge-pill">Cancelled</span>';
                            }
                            return status;
                        }
                        return data;
                    }
                },
                {
                    data: null,
                    name: 'Action',
                    render: function(data, type, full, meta) {
                        return '<div class="d-flex demo">' +
                            '<a href="/receiveorder/' + full.id + '" class="btn btn-sm btn-outline-warning btn-icon btn-inline-block mr-1" title="Info Record"><i class="fal fa-info"></i></a>' +
                            '</div>';
                    }
                }
            ],
            dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [{
                    extend: 'colvis',
                    text: 'Column Visibility',
                    titleAttr: 'Col visibility',
                    className: 'btn-outline-default'
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    titleAttr: 'Generate CSV',
                    className: 'btn-outline-default'
                },
                {
                    extend: 'copyHtml5',
                    text: 'Copy',
                    titleAttr: 'Copy to clipboard',
                    className: 'btn-outline-default'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    titleAttr: 'Print Table',
                    className: 'btn-outline-default'
                }
            ]
        });
    });
</script>
@endsection
