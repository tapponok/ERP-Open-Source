@extends('layouts.master')
@section('linkrel')
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item">Sales Order</li>
    </ol>
    <div class="subheader">
        <h3 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i>Sales Order
        </h3>
        @can('createsalesinvoice')
        <div class="subheader-title">
            <a class="btn btn-primary waves-effect waves-themed float-right" data-toggle="modal" data-target="#createsomodal" href="{{route('salesorder.create') }}">Create
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
                                    <th>Garage</th>
                                    <th>Partnership</th>
                                    <th>Sales Order</th>
                                    <th>Order Date</th>
                                    <th>Estimate Date</th>
                                    <th>Total</th>
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
    <div class="modal fade" id="createsomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Sales Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('salesorder.store')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="">Sales order</label>
                            <input type="text" name="salesorder" class="form-control" placeholder="Auto generate" disabled>
                        </div>
                        <div class="form-group">
                            <label for="select Category">Garage</label>
                            <select name="garage_id" id="garage_id" class="form-control">
                                <option value="" disabled="" selected="{{ old('garage_id') }}" required>Select
                                    garage
                                </option>
                                @foreach ($garage as $c)
                                <option value="{{$c->id}}">{{$c->garagename}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="select Category">Partnership</label>
                            <select name="partnership_id" id="partnership_id" class="form-control">
                                <option value="" disabled="" selected="{{ old('partnership_id') }}" required>Select
                                    partnership
                                </option>
                                @foreach ($partnership as $u)
                                <option value="{{$u->id}}">{{$u->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="example-date">Estimate Date</label>
                            <input class="form-control" id="example-date" type="date" name="estimate_date">
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
        document.getElementById("mpoidmodal").innerHTML = "Are you sure submit invoice puchase order " + "<b>" +
            mpoid + "</b>" + "?";
    });
</script>
<script>

    $(document).ready(function() {
        $('#datatable-salesorder').dataTable({
            responsive: true,
            processing: true,
            serverside: false,
            ajax: "{{route('salesorder.index')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'garageid.garagename',
                    name: 'Garage'
                },
                {
                    data: 'partnershipid.name',
                    name: 'Partnership'
                },
                {
                    data: 'salesorder_code',
                    name: 'Sales Order'
                },
                {
                    data: 'created_at',
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
                    data: 'estimate_date',
                    name: 'Estimate Date',
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
                    data: 'total',
                    name: 'Total',
                    render: function(data, type, full, meta) {
                        if (type === 'display') {
                            if (data === null) {
                                return 0;
                            } else {
                                return parseFloat(data).toLocaleString('en-US'); // Ubah 'en-US' sesuai dengan pengaturan regional yang diinginkan
                            }
                        }
                        return data;
                    }
                },
                {
                    data: 'status',
                    name: 'Status',
                    render: function(data, type, full, meta) {
                        if (type === 'display') {
                            if (data === 'draft') {
                                return '<span class="badge badge-primary badge-pill">Draft</span>';
                            } else if (data === 'submit') {
                                return '<span class="badge badge-warning badge-pill">Submit</span>';
                            } else if (data === 'approve') {
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
                        return '<a href="/salesorder/' + full.id + '" class="btn btn-sm btn-outline-warning btn-icon btn-inline-block mr-1" title="See detail to approve/reject"><i class="fal fa-info"></i></a>';
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
