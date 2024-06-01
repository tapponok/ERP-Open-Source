@extends('layouts.master')
@section('linkrel')
<link rel="stylesheet" media="screen, print" href="{{asset('css/formplugins/select2/select2.bundle.css')}}">
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item">Sales invoice</li>
    </ol>
    <div class="subheader">
        <h3 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i>Sales Invoice
        </h3>
        @can('createsalesinvoice')
        <div class="subheader-title">
            <a class="btn btn-primary waves-effect waves-themed float-right" data-toggle="modal" data-target="#createModal" href="#">Create
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
                                    <th>Partnership</th>
                                    <th>Garage</th>
                                    <th>Sales order</th>
                                    <th>Sales invoice</th>
                                    <th>Total sales order</th>
                                    <th>Down payment</th>
                                    <th>Payment</th>
                                    <th>Total payment</th>
                                    <th>Outstanding</th>
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
    <div class="modal fade" id="createModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Create sales invoice</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('salesinvoice.CreateSalesInvoice')}}" id="addtogroup" method="POST">
                        {{csrf_field()}}
                        {{ method_field('POST') }}
                        <div class="form-group">
                            <div class="form-group">
                                <label class="form-label" for="select2-ajax">
                                    Select sales order
                                </label>
                                <select data-placeholder="Select sales order" name="salesOrderID" class="js-data-example-ajax form-control" id="selectidproduct"></select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Invoice</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script src="{{asset('js/formplugins/select2/select2.bundle.js')}}"></script>
<script type="text/javascript">
    function submitdata(id) {
        var id = id;
        var url = '{{ route("purchaseinvoice.submit", ":id") }}';
        url = url.replace(':id', id);
        $("#submitForm").attr('action', url);
    }
    $('#modalinvoice').on('show.bs.modal', function(e) {
        var mpoid = $(e.relatedTarget).data('poid');
        document.getElementById("mpoidmodal").innerHTML = "Are you sure submit invoice puchase order " + "<b>" +
            mpoid + "</b>" + "?";
    });
</script>
<script>
    function customNumberRenderer(data, type, full, meta) {
        if (type === 'display') {
            if (data === null) {
                return 0;
            } else {
                return parseFloat(data).toLocaleString('en-US');
            }
        }
        return data;
    }
    $(document).ready(function() {
        $('#datatable-salesorder').dataTable({
            responsive: true,
            processing: true,
            serverside: false,
            ajax: "{{route('salesinvoice.index')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'salesorderid.partnershipid.name.',
                    name: 'Partnerhisp'
                },
                {
                    data: 'salesorderid.garageid.garagename',
                    name: 'Garage'
                },
                {
                    data: 'salesorderid.salesorder_code',
                    name: 'Sales order'
                },
                {
                    data: 'sales_invoice_code',
                    name: 'Sales invoice'
                },
                {
                    data: 'salesorderid.total_charge',
                    name: 'Total sales order',
                    render : customNumberRenderer
                },
                {
                    data: 'down_payment_total',
                    name: 'Down payment',
                    render : customNumberRenderer
                },
                {
                    data: 'payment',
                    name: 'Payment',
                    render : customNumberRenderer
                },
                {
                    data: 'salesinvoice.total_payment',
                    name: 'Payment',
                    render : customNumberRenderer
                },
                {
                    data: 'outstanding',
                    name: 'OutStanding',
                    render : customNumberRenderer
                },
                {
                    data: 'status',
                    name: 'Status',
                    render: function(data, type, full, meta) {
                        if (type === 'display') {
                            if (data === 'submit') {
                                return '<span class="badge badge-warning badge-pill">Submit</span>';
                            }else if(data === 'save'){
                                return '<span class="badge badge-primary badge-pill">Save</span>';
                            }else if (data === 'approve') {
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
                    name: 'Action',
                    render: function(data, type, full, meta) {
                        return '<a href="/salesinvoice/' + full.id + '" class="btn btn-sm btn-outline-warning btn-icon btn-inline-block mr-1" title="See detail to approve/reject"><i class="fal fa-info"></i></a>';
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
        $('#createModal').on('show.bs.modal', function(e) {
            $(".js-data-example-ajax").select2({
                minimumInputLength: 2,
                dropdownParent: $('#createModal'),
                ajax: {
                    url: "{{route('salesinvoice.getsalesorder')}}" + "?_token=" + "{{ csrf_token() }}",
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
                                    text: item.salesorder_code
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    });
</script>
@endsection
