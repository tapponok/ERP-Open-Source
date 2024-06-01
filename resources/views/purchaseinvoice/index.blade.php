@extends('layouts.master')
@section('linkrel')
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item">Puchase Invoice</li>
    </ol>
    <div class="subheader">
        <h3 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i>Puchase Invoice Index
        </h3>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table id="datatable-puchaseinvoice" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>PI Number</th>
                                    <th>Invoice Date</th>
                                    <th>PO Number</th>
                                    <th>Order Date</th>
                                    <th>Supplier</th>
                                    <th>Garage</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
        $('#datatable-puchaseinvoice').dataTable({
            responsive: true,
            processing: true,
            serverside: false,
            ajax: "{{route('purchaseinvoice.index')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'pi_number',
                    name: 'PI Number'
                },
                {
                    data: 'created_at',
                    name: 'Invoice Date',
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
                    data: 'puchaseorderid.po_number',
                    name: 'PO Number'
                },
                {
                    data: 'puchaseorderid.created_at',
                    name: 'Order Date',
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
                    data: 'supplierid.supplier_name',
                    name: 'Supplier'
                },
                {
                    data: 'garageid.garagename',
                    name: 'Garage'
                },
                {
                    data: 'total',
                    name: 'Total',
                    render: function(data, type, full, meta) {
                        if (type === 'display') {
                            return parseFloat(data).toLocaleString('en-US'); // Ubah 'en-US' sesuai dengan pengaturan regional yang diinginkan
                        }
                        return data;
                    }
                },
                {
                    data: null,
                    name: 'Status',
                    render: function(data, type, full, meta) {
                        var status = full.status;
                        var badge = '';

                        if (status === 'submit') {
                            badge = '<span class="badge badge-primary badge-pill">' + status + '</span>';
                        } else if (status === 'approved') {
                            badge = '<span class="badge badge-success badge-pill">' + status + '</span>';
                        } else if (status === 'cancelled') {
                            badge = '<span class="badge badge-danger badge-pill">' + status + '</span>';
                        }

                        return '<div class="d-flex demo">' + badge + '</div>';
                    }
                },
                {
                    data: null,
                    name: 'Actions',
                    render: function(data, type, full, meta) {
                        var status = full.status;
                        var actions = '';

                        if (status === 'approve') {
                            actions = '<div class="d-flex demo">' +
                                '<a href="/purchaseinvoice/show/' + full.id + '" class="btn btn-sm btn-outline-warning btn-icon btn-inline-block mr-1" title="invoice details"><i class="fal fa-info"></i></a>' +
                                '<a href="#" class="btn-print btn btn-sm btn-outline-danger btn-icon btn-inline-block mr-1" title="Create Invoice"><i class="fal fa-file-pdf"></i></a>' +
                                '</div>';
                        } else {
                            actions = '<div class="d-flex demo">' +
                                '<a href="/purchaseinvoice/show/' + full.id + '" class="btn btn-sm btn-outline-warning btn-icon btn-inline-block mr-1" title="invoice details"><i class="fal fa-info"></i></a>' +
                                '</div>';
                        }

                        return actions;
                    }
                },
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
