@extends('layouts.master')
@section('linkrel')
<link rel="stylesheet" media="screen, print" href="{{asset('css/notifications/toastr/toastr.css')}}">
@endsection
@section('content')
<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('purchaseinvoice.index') }}">Purchase Order</a></li>
        <li class="breadcrumb-item">Detail</li>
    </ol>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Purchaser Order Detail
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
                                <div class="col-sm-6 d-flex">
                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>Opname Code</strong>
                                                    </td>
                                                    <td>
                                                        {{ $stockopname->code }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Created Date</strong>
                                                    </td>
                                                    <td>
                                                        {{ $stockopname->created_at->format('Y-m-d') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Notes</strong>
                                                    </td>
                                                    <td>
                                                        {{ $stockopname->notes }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-6 ml-sm-auto">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-clean">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>Status</strong>
                                                    </td>
                                                    <td>
                                                        @if ($stockopname->status == 'submit')
                                                        <span class="badge badge-warning  badge-pill">Submit</span>

                                                        @elseif ($stockopname->status == 'approved')
                                                        <span class="badge badge-success badge-pill">Approved</span>
                                                        @elseif ($stockopname->status == 'finish')
                                                        <span class="badge badge-secondary badge-pill">Finish</span>
                                                        @else
                                                        <span class="badge badge-danger badge-pill">Cancelled</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @if ($stockopname->updated_by !== null)
                                                <tr>
                                                    <td>
                                                        <strong>Updated by</strong>
                                                    </td>
                                                    <td>
                                                        {{ $stockopname->updatedby->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Updated at</strong>
                                                    </td>
                                                    <td>
                                                        {{ $stockopname->updated_at->format('Y-m-d') }}
                                                    </td>
                                                </tr>
                                                @endif

                                                @if ($stockopname->status == 'approved' || $stockopname->status ==
                                                'finish')
                                                <tr>
                                                    <td>
                                                        <strong>Approved by</strong>
                                                    </td>
                                                    <td>
                                                        {{ $stockopname->approvedby->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Approved at</strong>
                                                    </td>
                                                    <td>
                                                        {{ $stockopname->approved_at }}
                                                    </td>
                                                </tr>
                                                @endif
                                                @if ($stockopname->status == 'cancelled')
                                                <tr>
                                                    <td>
                                                        <strong>Cancelled at</strong>
                                                    </td>
                                                    <td>
                                                        {{ $stockopname->canceled_at }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Cancelled by</strong>
                                                    </td>
                                                    <td>
                                                        {{ $stockopname->canceledby->name }}
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table mt-5">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        No
                                                    </th>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        Garage</th>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        Product Code</th>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        Product Name</th>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        Current Stock
                                                    </th>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        New Stock
                                                    </th>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        Notes
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($stockopname_item as $i=>$u)
                                                <tr>
                                                    <td class="text-center"> {{ ++$i }} </td>
                                                    <td class="text-center"> {{ $u->garageid->garagename }} </td>
                                                    <td class="text-center"> {{ $u->productid->product_code }} </td>
                                                    <td class="text-center"> {{ $u->productid->product_name }} </td>
                                                    <td class="text-center"> {{ $u->laststock }} </td>
                                                    <td class="text-center"> {{ $u->newstock }} </td>
                                                    <td class="text-center"> {{ $u->notes }} </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if ($stockopname->status == 'submit')
                            <div class="row float-right p-4">
                                <div class="demo">
                                    <a class="btn-cancel btn btn-secondary waves-effect waves-themed float-right"
                                        href="{{route('stockopname.index')}}"><span
                                            class="fal fa-chevron-left mr-1"></span>Back</a>
                                </div>
                                @canany(['approvestockopname', 'rejectstockopname'])
                                <div class="demo">
                                    <a class="btn-cancel btn btn-danger waves-effect waves-themed float-right"
                                        href="javascript:void(0);" onclick="cancelldata( {{$stockopname->id}} )"
                                        data-target="#cancelModal" data-toggle="modal"
                                        data-po-id="{{$stockopname->id}}"><span
                                            class="fal fa-times mr-1"></span>Cancel</a>
                                </div>
                                <div class="demo2">
                                    <a class="btn-approve btn btn-info waves-effect waves-themed float-right"
                                        href="javascript:void(0);" onclick="approvedata( {{$stockopname->id}} )"
                                        data-target="#approveModal" data-toggle="modal"
                                        data-po-id="{{$stockopname->id}}"><span
                                            class="fal fa-check mr-1"></span>Approve</a>
                                </div>
                                @endcan
                            </div>
                            @elseif ($stockopname->status == 'approved')
                            <div class="row float-right p-4">
                                <div class="demo">
                                    <a class="btn-cancel btn btn-secondary waves-effect waves-themed float-right"
                                        href="{{route('stockopname.index')}}"><span
                                            class="fal fa-chevron-left mr-1"></span>Back</a>
                                </div>
                            </div>
                            @else
                            <div class="row float-right p-4">
                                <div class="demo">
                                    <a class="btn-cancel btn btn-secondary waves-effect waves-themed float-right"
                                        href="{{route('stockopname.index')}}"><span
                                            class="fal fa-chevron-left mr-1"></span>Back</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Info -->
    @canany(['approvestockopname', 'rejectstockopname'])
    <!-- Modal Approve -->
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Confirmation !!!</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <form action="" id="approveform" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <h5 class="modal-title">Are you sure to approve this order?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes, Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- invoice -->
    <div class="modal fade" id="invoicemodal" tabindex="-1" role="dialog" aria-hidden="true">
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
    <!-- Cancel Approve -->
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Confirmation !!!</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <form action="" id="cancellform" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <h5 class="modal-title">Are you sure to cancel this order?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Yes, Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</main>
@endsection
@section('script')
<script class="text/javascript">
    function approvedata(id) {
        var id = id;
        var url = '{{ route("stockopname.approve", ":id") }}';
        url = url.replace(':id', id);
        $("#approveform").attr('action', url);
    }

    function cancelldata(id) {
        var id = id;
        var url = '{{ route("stockopname.cancel", ":id") }}';
        url = url.replace(':id', id);
        $("#cancellform").attr('action', url);
    }

    function submitdata(id) {
        var id = id;
        var url = '{{ route("purchaseinvoice.submit", ":id") }}';
        url = url.replace(':id', id);
        $("#submitForm").attr('action', url);
    }
    $('#invoicemodal').on('show.bs.modal', function (e) {
        var mpoid = $(e.relatedTarget).data('poid');
        document.getElementById("mpoidmodal").innerHTML = "Are you sure submit invoice puchase order " + "<b>" +
            mpoid + "</b>" + "?";
    });

</script>
@endsection
