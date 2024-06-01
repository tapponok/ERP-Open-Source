@extends('layouts.master')
@section('linkrel')
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item">Purchase Order</li>
    </ol>
    <div class="subheader">
        <h3 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i>Purchase Order
        </h3>
        <div class="subheader-title">
            <a class="btn btn-primary waves-effect waves-themed float-right" href="{{route('purchaseorder.create') }}">Create
                New</a>
        </div>
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
                                    <th>PO Number</th>
                                    <th>Purchase Date</th>
                                    <th>Purchaser</th>
                                    <th>Supplier</th>
                                    <th>Garage</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Fulfilled</th>
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
    @can('createpurchaseinvoice')
    <div class="modal fade" id="modalinvoice" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Confirmation!!!</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <form action="" id="submitForm" method="post">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <h6 class="modal-title" id="mpoidmodal"></h6>
                        <table class="table table-sm table-clean" id="mtpurchase">
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes, Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</main>
@endsection
@section('script')
<script type="text/javascript">
    function submitdata(id) {
        var id = id;
        var url = '{{ route("purchaseinvoice.submit", ":id") }}';
        url = url.replace(':id', id);
        $("#submitForm").attr('action', url);
    }
    $('#modalinvoice').on('show.bs.modal', function(e) {
        var mpoid = $(e.relatedTarget).data('poid');
        document.getElementById("mpoidmodal").innerHTML = "Are you sure submit invoice puchase order " + "<b>" + mpoid + "</b>" + "?";
    });
</script>
<script>
    $(document).ready(function() {
        $('#datatable-salesorder').dataTable({
            responsive: true,
            processing: true,
            serverside: false,
            ajax: "{{route('purchaseorder.index')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'po_number',
                    name: 'PO Number'
                },
                {
                    data: 'created_at',
                    name: 'Purchase Date',
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
                    data: 'createdby.name',
                    name: 'Purchaser'
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
                    data: 'status',
                    name: 'Status',
                    render: function(data, type, full, meta) {
                        if (type === 'display') {
                            if (data === 'submit') {
                                return '<span class="badge badge-warning badge-pill">Submit</span>';
                            } else if (data === 'approved') {
                                return '<span class="badge badge-success badge-pill">Approve</span>';
                            } else if (data === 'finish') {
                                return '<span class="badge badge-secondary badge-pill">Finish</span>';
                            } else {
                                return '<span class="badge badge-danger badge-pill">Cancell</span>';
                            }
                        }
                        return data;
                    }
                },
                {
                    data: null,
                    name: 'Fulfilled',
                    render: function(data, type, full, meta) {
                        var fulfilled = full.fulfilled;
                        var badge = '';
                        if (fulfilled === 0) {
                            badge = '<span class="badge badge-warning badge-pill">On progress</span>';
                        } else {
                            badge = '<span class="badge badge-success badge-pill">Finish</span>';
                        }
                        return badge;
                    }
                },
                {
                    data: null,
                    name: 'Action',
                    render: function(data, type, full, meta) {
                        var status = full.status;
                        var action = '';

                        if (status === 'approved') {
                            action = '<div class="d-flex demo">' +
                                '<a href="/purchaseorder/' + full.id + '" class="btn btn-sm btn-outline-warning btn-icon btn-inline-block mr-1" title="See detail to approve/reject"><i class="fal fa-info"></i></a>' +
                                '@can("createpurchaseinvoice")' +
                                '<a href="" class="btn btn-sm btn-outline-danger btn-icon btn-inline-block mr-1" title="create invoice" data-toggle="modal" data-poid="' + full.po_number + '" onclick="submitdata(' + full.id + ')" data-target="#modalinvoice"><i class="fal fa-file"></i></a>' +
                                '@endcan' +
                                '</div>';
                        } else {
                            action = '<a href="/purchaseorder/' + full.id + '" class="btn btn-sm btn-outline-warning btn-icon btn-inline-block mr-1" title="See detail to approve/reject"><i class="fal fa-info"></i></a>';
                        }

                        return action;
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
