@extends('layouts.master')
@section('linkrel')
<link rel="stylesheet" media="screen, print" href="{{asset('css/notifications/toastr/toastr.css')}}">
@endsection
@section('content')
<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('purchaseorder.index') }}">Receive Order</a></li>
        <li class="breadcrumb-item">Detail</li>
    </ol>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Receive Order Detail
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
                                                        <strong>PO Number</strong>
                                                    </td>
                                                    <td>
                                                        {{$receiveorder->purchaseorderid->po_number}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Receive Code</strong>
                                                    </td>
                                                    <td>
                                                        {{ $receiveorder->codereceived }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Received at</strong>
                                                    </td>
                                                    <td>
                                                        {{ $receiveorder->created_at->format('Y-m-d') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Purchaser</strong>
                                                    </td>
                                                    <td>
                                                        {{ $receiveorder->purchaseorderid->createdby->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Purchase Date</strong>
                                                    </td>
                                                    <td>
                                                        {{ $receiveorder->purchaseorderid->created_at->format('Y-m-d') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Supplier</strong>
                                                    </td>
                                                    <td>
                                                        {{ $receiveorder->supplierid->supplier_name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Garage</strong>
                                                    </td>
                                                    <td>
                                                        {{ $receiveorder->garageid->garagename }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Notes</strong>
                                                    </td>
                                                    <td>
                                                        {{ $receiveorder->purchaseorderid->note }}
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
                                                        @if ($receiveorder->status == 'submit')
                                                        <span class="badge badge-warning  badge-pill">Submit</span>
                                                        @elseif ($receiveorder->status == 'approved')
                                                        <span class="badge badge-success badge-pill">Approved</span>
                                                        @elseif ($receiveorder->status == 'finish')
                                                        <span class="badge badge-secondary badge-pill">Finish</span>
                                                        @else
                                                        <span class="badge badge-danger badge-pill">Cancelled</span>
                                                        @endif
                                                    </td>
                                                </tr>

                                                @if ($receiveorder->updated_by !== null)
                                                <tr>
                                                    <td>
                                                        <strong>Updated by</strong>
                                                    </td>
                                                    <td>
                                                        {{ $receiveorder->updatedby->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Updated at</strong>
                                                    </td>
                                                    <td>
                                                        {{ $receiveorder->updated_at->format('Y-m-d') }}
                                                    </td>
                                                </tr>
                                                @endif
                                                @if ($receiveorder->status == 'approved' || $receiveorder->status ==
                                                'finish')
                                                <tr>
                                                    <td>
                                                        <strong>Approved by</strong>
                                                    </td>
                                                    <td>
                                                        {{ $receiveorder->approvedby->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Approved at</strong>
                                                    </td>
                                                    <td>
                                                        {{ $receiveorder->approved_at }}
                                                    </td>
                                                </tr>
                                                @endif
                                                @if ($receiveorder->status == 'cancelled')
                                                <tr>
                                                    <td>
                                                        <strong>Cancelled at</strong>
                                                    </td>
                                                    <td>
                                                        {{ $receiveorder->cancelled_at }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Cancelled by</strong>
                                                    </td>
                                                    <td>
                                                        {{ $receiveorder->cancelledby->name }}
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if(!$purchase_order_items->isEmpty())
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table mt-5">
                                            <div class="text-dark fw-700 h3 mb-g keep-print-font">
                                                Received item
                                            </div>
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        No
                                                    </th>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        Product Name</th>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        Product Code</th>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        Quantity Order
                                                    </th>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        Quantity Received
                                                    </th>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        Difference
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($purchase_order_items as $i => $u)
                                                <tr>
                                                    <td class="text-center">{{ ++$i }} </td>
                                                    <td class="text-center">{{ $u->product_code }}</td>
                                                    <td class="text-center">{{ $u->product_name }}</td>
                                                    <td class="text-center">{{ number_format($u->quantity) }}</td>
                                                    <td class="text-center">{{ number_format($u->received) }}</td>
                                                    <td class="text-center">
                                                        {{ number_format($u->received - $u->quantity) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @else
                            @endif
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table mt-5">
                                            <div class="text-dark fw-700 h3 mb-g keep-print-font">
                                                Request receive item
                                            </div>
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        No
                                                    </th>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        Product Code</th>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        Product Name</th>
                                                    <th
                                                        class="text-center border-top-0 table-scale-border-bottom fw-700">
                                                        Quantity Receive
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($receiveorder->receiveoderitem as $i => $u)
                                                <tr>
                                                    <td class="text-center">{{ ++$i }} </td>
                                                    <td class="text-center">{{ $u->product_code }}</td>
                                                    <td class="text-center">{{ $u->product_name }}</td>
                                                    <td class="text-center">{{ number_format($u->quantity) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if ($receiveorder->status == 'submit')
                            <div class="row float-right p-4">
                                <div class="demo">
                                    <a class="btn-cancel btn btn-secondary waves-effect waves-themed float-right"
                                        href="{{route('receiveorder.index')}}"><span
                                            class="fal fa-chevron-left mr-1"></span>Back</a>
                                </div>
                                @canany(['approvereceiveorder', 'rejectreceiveorder'])
                                <div class="demo">
                                    <a class="btn-cancel btn btn-danger waves-effect waves-themed float-right"
                                        href="javascript:void(0);" onclick="cancelldata( {{$receiveorder->id}} )"
                                        data-target="#cancelModal" data-toggle="modal"
                                        data-po-id="{{$receiveorder->id}}"><span
                                            class="fal fa-times mr-1"></span>Cancel</a>
                                </div>
                                <div class="demo2">
                                    <a class="btn-approve btn btn-info waves-effect waves-themed float-right"
                                        href="javascript:void(0);" onclick="approvedata( {{$receiveorder->id}} )"
                                        data-target="#approveModal" data-toggle="modal"
                                        data-po-id="{{$receiveorder->id}}"><span
                                            class="fal fa-check mr-1"></span>Approve</a>
                                </div>
                                @endcan
                            </div>
                            @else
                            <div class="row float-right p-4">
                                <div class="demo">
                                    <a class="btn-cancel btn btn-secondary waves-effect waves-themed float-right"
                                        href="{{route('receiveorder.index')}}"><span
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
</main>
@endsection
@section('script')
<script class="text/javascript">
    function approvedata(id) {
        var id = id;
        var url = '{{ route("receiveorder.approve", ":id") }}';
        url = url.replace(':id', id);
        $("#approveform").attr('action', url);
    }

    function cancelldata(id) {
        var id = id;
        var url = '{{ route("receiveorder.cancel", ":id") }}';
        url = url.replace(':id', id);
        $("#cancellform").attr('action', url);
    }

</script>
@endsection
