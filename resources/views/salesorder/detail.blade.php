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
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item">Sales Order</li>
        <li class="breadcrumb-item active">Draft</li>
    </ol>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Sales Order
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="panel-container show">
                            <div class="panel-content">
                                <div class="form-group col-md-6 float-left">
                                    <label for="salesorder_code" class="form-label">Sales order code</label>
                                    <input type="text" name="salesorder_code" id="codesalesorder" class="form-control" value="{{$salesorder->salesorder_code}}" placeholder="0" disabled>
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label class="form-label" for="date">Estimate Date</label>
                                    <input class="form-control" id="estimate_date" value="{{$salesorder->estimate_date}}" type="date" name="estimate_date" disabled>
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label for="Select partnership" class="form-label">Partnership</label>
                                    <select name="partnership_id" id="partnership-select" class="form-control" disabled>
                                        <option value="" disabled="" selected="">Select partnership
                                        </option>
                                        @foreach($partnership as $partnership)
                                        @if ($salesorder->partnership_id == $partnership->id)
                                        <option value="{{ $partnership->id }}" selected>{{ $partnership->name }}
                                        </option>
                                        @else
                                        <option value="{{ $partnership->id }}">{{ $partnership->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('partnership_id')
                                    <span class="text-danger">{{ $message  }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label for="Select garage" class="form-label">Garage</label>
                                    <select name="garage_id" id="garage-select" class="form-control" disabled>
                                        <option value="" disabled="" selected="">Select garage
                                        </option>
                                        @foreach($garage as $garage)
                                        @if ($salesorder->garage_id == $garage->id)
                                        <option value="{{ $garage->id }}" selected>{{ $garage->garagename }}
                                        </option>
                                        @else
                                        <option value="{{ $garage->id }}">{{ $garage->garagename }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('garage_id')
                                    <span class="text-danger">{{ $message  }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 float-left mb-3">
                                    <label class="form-label" for="city">City</label>
                                    <input class="form-control" id="city" type="text" name="city" value="{{$salesorder->city}}" placeholder="Input city" disabled>
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label class="form-label" for="province">Province</label>
                                    <input class="form-control" id="province" type="text" name="province" value="{{$salesorder->province}}" placeholder="Input province" disabled>
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label class="form-label" for="postal_code">Postal code</label>
                                    <input class="form-control" id="postal_code" type="text" name="postal_code" value="{{$salesorder->postalcode}}" placeholder="Input postal code" disabled>
                                </div>
                                <div class="form-group col-md-6 float-right">
                                    <label class="form-label" for="address">Address</label>
                                    <textarea class="form-control" name="address" id="address" rows="1" disabled>{{$salesorder->address}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr mb-1">
                    <h2>
                        Sales Product
                    </h2>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="panel-container show">
                            <div class="panel-content">
                                <div class="panel-content">
                                    <!-- datatable start -->
                                    <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Product code</th>
                                                <th>Product name</th>
                                                <th>Price</th>
                                                <th>Qantity</th>
                                                <th>Discount %</th>
                                                <th>Discount total</th>
                                                <th>Sub total</th>
                                                <th>Total after discount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($salesOrderItem as $i => $u)
                                            <tr>
                                                <td>{{++$i}}</td>
                                                <td>{{$u->product_code}}</td>
                                                <td>{{$u->product_name}}</td>
                                                <td>{{number_format($u->price)}}</td>
                                                <td>{{$u->quantity}}</td>
                                                <td>{{ is_numeric($u->discount_percentage) ? $u->discount_percentage : 0 }}</td>
                                                <td>{{number_format($u->discounttotal)}}</td>
                                                <td>{{number_format($u->subtotal)}}</td>
                                                <td>{{number_format($u->total_after_discount)}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- datatable end -->
                                </div>
                                <div class="border border-top border-right border-right border-bottom border-left p-3">
                                    <div class="form-group  col-md-6 float-left">
                                        <label class="form-label" for="discount">Discount (%)</label>
                                        <input class="form-control" id="discount" type="text" name="discount" value="{{ $salesorder->discount }}" disabled>
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label class="form-label" for="total_discount">Discount total</label>
                                        <input class="form-control" id="total_discount" type="text" name="total_discount" value="{{ number_format($salesorder->total_discount, 2, ',', '.')  }}" disabled>
                                    </div>
                                    <div class="form-group  col-md-6 float-left">
                                        <label class="form-label" for="tax_percent">Tax (%)</label>
                                        <input class="form-control" id="tax_percent" type="text" name="tax_percent" value="{{ $salesorder->tax_percent }}" disabled>
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label class="form-label" for="tax_total">Tax total</label>
                                        <input class="form-control" id="tax_total" type="text" name="tax_total" value="{{ number_format($salesorder->tax_total, 2, ',', '.')  }}" disabled>
                                    </div>
                                    <div class="panel-content">
                                        <div class="form-group">
                                            <label class="form-label" for="shipment_cost">Shipment cost</label>
                                            <input class="form-control" id="shipment_cost" type="text" name="shipment_cost" value="{{ number_format($salesorder->shipment_cost, 2, ',', '.')  }}" disabled>
                                        </div>
                                    </div>
                                    <div class="panel-content">
                                        <div class="form-group">
                                            <label class="form-label" for="globalnotes">Notes</label>
                                            <textarea class="form-control" name="globalnotes" id="globalnotes" rows="3" disabled>{{ $salesorder->notes }}</textarea>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div>
                                            <table class="table table-bordered m-0 fw-700 h4 keep-print-font">
                                                <tr>
                                                    <td class="text-right">TOTAL</td>
                                                    <td class="text-right m-0  keep-print-font" id="totalAmount">{{ number_format($totalSalesOrderItem, 2, ',', '.') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">TOTAL Charge</td>
                                                    <td class="text-right m-0  keep-print-font" id="totalCharge">{{ number_format($salesorder->total_charge, 2, ',', '.') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row float-right p-4 mt-4">
                                        <div class="row float-right p-4">
                                            <div class="demo">
                                                <a class="btn-cancel btn btn-secondary waves-effect waves-themed float-right" href="{{route('salesorder.index')}}"><span class="fal fa-chevron-left mr-1"></span>Back</a>
                                            </div>
                                            @if($salesorder->status == 'approve' || $salesorder->status == 'finish' || $salesorder->status == 'cancel')
                                            <div class="demo">
                                                <a class="btn-cancel btn btn-primary waves-effect waves-themed float-right" href="javascript:void(0);"><span class="fal fa-file-alt mr-1"></span>Create Invoice</a>
                                            </div>
                                            @else
                                            <div class="demo">
                                                <a class="btn-cancel btn btn-danger waves-effect waves-themed float-right" id="rejectButton"  href="javascript:void(0);"><span class="fal fa-times mr-1"></span>Cancel</a>
                                            </div>
                                            <div class="demo2">
                                                <a class="btn-approve btn btn-info waves-effect waves-themed float-right" id="approveButton"  href="javascript:void(0);"><span class="fal fa-check mr-1"></span>Approve</a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script src="{{asset('js/formplugins/select2/select2.bundle.js')}}"></script>
<script src="{{asset('js/notifications/sweetalert2/sweetalert2.bundle.js')}}"></script>
<script>
    var IDsalesOrder = {{$salesorder->id}}

    function submitSalesOrder(isApproved) {
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger mr-2"
            },
            buttonsStyling: false
        });
        var confirmationText = isApproved ? "Approve" : "Reject";

        swalWithBootstrapButtons
            .fire({
                title: "Are you sure?",
                text: "You " + confirmationText + " the sales order!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, " + confirmationText + "!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            })
            .then(function(result) {
                if (result.value) {
                    var urlPost = isApproved ? "{{ route('salesorder.approve', ':id') }}" : "{{ route('salesorder.reject', ':id') }}";
                    urlPost = urlPost.replace(':id', IDsalesOrder) + "?_token={{ csrf_token() }}";
                    var urlRedirect = "{{ route('salesorder.index') }}";
                    $.ajax({
                        url: urlPost,
                        method: 'post',
                        success: function(response) {
                            swalWithBootstrapButtons.fire(
                                confirmationText + "ed.",
                                "Your sales order has been " + confirmationText + "ed.",
                                "success"
                            );
                            // Redirect ke halaman yang diinginkan setelah proses selesai
                            window.location.href = urlRedirect
                        },
                        error: function(xhr, status, error) {
                            // Handle error jika ada kesalahan dalam pengiriman data ke backend
                            $('#errorModal').modal('show'); // Tampilkan modal kesalahan
                            $('#errorModalContent').text('Terjadi kesalahan: ' + xhr.responseJSON.error); // Tampilkan pesan kesalahan dalam modal
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        "Cancelled",
                        "Your sales order was not " + confirmationText + "ed",
                        "error"
                    );
                }
            });
    }

    // Penggunaan pada tombol approve
    $("#approveButton").on("click", function() {
        submitSalesOrder(true);
    });

    // Penggunaan pada tombol reject
    $("#rejectButton").on("click", function() {
        submitSalesOrder(false);
    });
</script>
@endsection
