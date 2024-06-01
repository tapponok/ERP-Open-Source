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
                                    <label for="salesorder_code" class="form-label">Sales order</label>
                                    <input type="text" name="salesorder_code" id="codesalesorder" class="form-control" value="{{$dataSalesOrder->salesorder_code}}" disabled>
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label class="form-label" for="date">Estimate Date</label>
                                    <input class="form-control" id="estimate_date" value="{{$dataSalesOrder->estimate_date}}" type="date" name="estimate_date" disabled>
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label class="form-label" for="Partnership">Partnership</label>
                                    <input class="form-control" id="partnershipid" value="{{$dataSalesOrder->partnershipid->name}}" name="partnershipid" disabled>
                                </div>

                                <div class="form-group col-md-6 float-left">
                                    <label class="form-label" for="Garage">Garage</label>
                                    <input class="form-control" id="Garageid" value="{{$dataSalesOrder->garageid->garagename}}" name="garageid" disabled>
                                </div>
                                <div class="form-group col-md-6 float-left mb-3">
                                    <label class="form-label" for="city">City</label>
                                    <input class="form-control" id="city" type="text" name="city" value="{{$dataSalesOrder->city}}" disabled>
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label class="form-label" for="province">Province</label>
                                    <input class="form-control" id="province" type="text" name="province" value="{{$dataSalesOrder->province}}" disabled>
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label class="form-label" for="postal_code">Postal code</label>
                                    <input class="form-control" id="postal_code" type="text" name="postal_code" value="{{$dataSalesOrder->postalcode}}" disabled>
                                </div>
                                <div class="form-group col-md-6 float-right">
                                    <label class="form-label" for="address">Address</label>
                                    <textarea class="form-control" name="address" id="address" rows="1" disabled>{{$dataSalesOrder->address}}</textarea>
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
                                            @foreach($datasalesOrderItem as $i => $u)
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
                                    <h1>Sales order</h1>
                                    <div class="form-group  col-md-6 float-left">
                                        <label class="form-label" for="discount">Discount (%)</label>
                                        <input class="form-control" id="discount" type="text" name="discount" value="{{ $dataSalesOrder->discount }}" disabled>
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label class="form-label" for="total_discount">Discount total</label>
                                        <input class="form-control" id="total_discount" type="text" name="total_discount" value="{{ number_format($dataSalesOrder->total_discount, 2, ',', '.')  }}" disabled>
                                    </div>
                                    <div class="form-group  col-md-6 float-left">
                                        <label class="form-label" for="tax_percent">Tax (%)</label>
                                        <input class="form-control" id="tax_percent" type="text" name="tax_percent" value="{{ $dataSalesOrder->tax_percent }}" disabled>
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label class="form-label" for="tax_total">Tax total</label>
                                        <input class="form-control" id="tax_total" type="text" name="tax_total" value="{{ number_format($dataSalesOrder->tax_total, 2, ',', '.')  }}" disabled>
                                    </div>
                                    <div class="panel-content">
                                        <div class="form-group">
                                            <label class="form-label" for="shipment_cost">Shipment cost</label>
                                            <input class="form-control" id="shipment_cost" type="text" name="shipment_cost" value="{{ number_format($dataSalesOrder->shipment_cost)  }}" disabled>
                                        </div>
                                    </div>
                                    <div class="panel-content">
                                        <div class="form-group">
                                            <label class="form-label" for="globalnotes">Notes</label>
                                            <textarea class="form-control" name="globalnotes" id="globalnotes" rows="3" disabled>{{ $dataSalesOrder->notes }}</textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="border border-top border-right border-right border-bottom border-left p-3">
                                    <h1>Sales Invoice</h1>
                                    <div class="panel-content">
                                        <div class="form-group">
                                            <label class="form-label" for="downpayment">Select payment</label>
                                            <select name="paymnet_id" id="paymnet_id" class="form-control">
                                                <option value="" disabled="" selected="">Select payment
                                                </option>
                                                @foreach($payment as $payment)
                                                @if (old('payment_id') == $payment->id)
                                                <option value="{{ $payment->id }}" selected>{{ $payment->name }}
                                                </option>
                                                @else
                                                <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('payment_id')
                                            <span class="text-danger">{{ $message  }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="panel-content">
                                        <div class="form-group">
                                            <label class="form-label" for="Reference">Reference notes</label>
                                            <textarea class="form-control" name="paymentnotes" id="paymentnotes" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="panel-content">
                                        <div class="form-group custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="defaultUnchecked" onchange="toggleDownPayment()">
                                            <label class="custom-control-label" for="defaultUnchecked">Is down payment?</label>
                                        </div>
                                    </div>
                                    <div class="panel-content">
                                        <div class="form-group" id="downPaymentField" style="display: none;">
                                            <label class="form-label" for="downpayment">Down payment</label>
                                            <input class="form-control" id="downpayment" type="text" name="downpayment" value="" placeholder="Input down payment">
                                        </div>
                                        <div class="form-group" id="paymentField" style="display: none;">
                                            <label class="form-label" for="payment">Payment</label>
                                            <input class="form-control" id="payment" type="text" name="payment" value="" placeholder="Input payment">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div>
                                        <table class="table table-bordered m-0 fw-700 h4 keep-print-font">
                                            <tr>
                                                <td class="text-right">Total</td>
                                                <td class="text-right m-0  keep-print-font" id="totalAmount">{{ number_format($totalSalesOrderItem, 2, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Total Charge</td>
                                                <td class="text-right m-0  keep-print-font" id="totalCharge">{{ number_format($dataSalesOrder->total_charge, 2, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Outstanding</td>
                                                <td class="text-right m-0 keep-print-font" id="currentoutstanding">
                                                    {{ optional(optional($dataSalesOrder->invoice)->outstanding)->format('0,0.00') ?? number_format($dataSalesOrder->total_charge, 2, ',', '.') }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row float-right p-4 mt-4">
                                    <div class="row float-right p-4">
                                        <div class="demo">
                                            <a class="btn-cancel btn btn-warning waves-effect waves-themed float-right" href="{{route('salesorder.index')}}"><span class="fal fa-chevron-left mr-1"></span>Back</a>
                                        </div>
                                        <div class="demo">
                                            <a class="btn-cancel btn btn-info waves-effect waves-themed float-right" id="saveButton" href="javascript:void(0);"><span class="fal fa-save mr-1"></span>Save</a>
                                        </div>
                                        <div class="demo2">
                                            <a class="btn-approve btn btn-success waves-effect waves-themed float-right" id="submitButton" href="javascript:void(0);"><span class="fal fa-paper-plane mr-1"></span>Submit</a>
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

    var IDsalesOrder = {{ $dataSalesOrder->id }};
    var totalCharge = {{ $dataSalesOrder->total_charge}} ;
    var CurrentOutStanding  = {{ optional($dataSalesOrder->invoice)->outstanding ?? $dataSalesOrder->total_charge }};

    // var IDsalesOrder = {{ $dataSalesOrder->id }};
    // var totalCharge = {{ $dataSalesOrder->total_charge}} ;
    // var CurrentOutStanding  = {{ optional($dataSalesOrder->invoice)->outstanding ?? $dataSalesOrder->total_charge }};


    // Event handler untuk tombol "Save"
    $('#saveButton').on('click', function() {
        processPayment(false); // Panggil fungsi processPayment dengan argumen false (menandakan save)
    });

    // Event handler untuk tombol "Submit"
    $('#submitButton').on('click', function() {
        processPayment(true); // Panggil fungsi processPayment dengan argumen true (menandakan submit)
    });

    function processPayment(isSubmit) {
        var checkbox = document.getElementById('defaultUnchecked');
        var paymnetID = $('#paymnet_id').val();
        var reference = $('#paymentnotes').val();
        var payment = $('#payment').val();
        var outstanding = $('#currentoutstanding').text();
        var downpaymentValue = document.getElementById("downpayment").value;
        var paymentValue = document.getElementById("payment").value;

        var submitText = (isSubmit) ? "submit" : "save";
        var confirmText = "Are you sure you want to " + submitText + " the sales order?";

        var dataToSend = {}; // Deklarasi variabel dataToSend di luar blok if-else
        if (checkbox.checked) {
            if (downpaymentValue.trim() === "" || downpaymentValue.trim() === "0") {
                alert("Please input field down payment");
                return false;
            } else {
                dataToSend = {
                    IDsalesOrder: IDsalesOrder,
                    paymnetID: paymnetID,
                    downpaymentvalue: convertCurrencyToNumber(downpaymentValue),
                    downpaymenttype: 1,
                    reference: reference,
                    outstanding: convertCurrencyToNumber(outstanding),
                    isSubmit: submitText,
                };
            console.log(dataToSend);
            }
        } else {
            if (paymentValue.trim() === "" || paymentValue.trim() === "0") {
                alert("Please input field payment");
                return false;
            } else {
                dataToSend = {
                    IDsalesOrder: IDsalesOrder,
                    paymnetID: paymnetID,
                    payment: convertCurrencyToNumber(payment),
                    downpaymenttype: 0,
                    reference: reference,
                    outstanding: convertCurrencyToNumber(outstanding),
                    isSubmit: submitText,
                };
            console.log(dataToSend);

            }
        }
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger mr-2"
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons
            .fire({
                title: confirmText,
                text: (isSubmit) ? "You submit the sales order!" : "You save the sales order!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, " + submitText + "!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            })
            .then(function(result) {
                if (result.value) {
                    var urlPost = "{{ route('salesinvoice.store') }}";
                    var urlRedirect = "{{ route('salesinvoice.index') }}";
                    $.ajax({
                        url: urlPost,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        data: dataToSend,
                        success: function(response) {
                            var successText = (isSubmit) ? "Your sales order has been submitted." : "Your sales order has been saved.";
                            swalWithBootstrapButtons.fire(
                                "Success!",
                                successText,
                                "success"
                            );
                            // Redirect ke halaman yang diinginkan setelah proses selesai
                            if (isSubmit) {
                                // window.location.href = urlRedirect;
                            }
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
                        "Your sales order not " + submitText + "ted",
                        "error"
                    );
                }
            });
    }

    // Event handler untuk tombol "Save"
    $('#saveButton').on('click', function() {
        processPayment(false); // Panggil fungsi processPayment dengan argumen false (menandakan save)
    });

    // Event handler untuk tombol "Submit"
    $('#submitButton').on('click', function() {
        processPayment(true); // Panggil fungsi processPayment dengan argumen true (menandakan submit)
    });


    function validateForm() {
        var downpaymentValue = document.getElementById("downpayment").value;
        var paymentValue = document.getElementById("payment").value;

        if (downpaymentValue.trim() === "" && paymentValue.trim() === "") {
            alert("Harap isi salah satu field");
            return false; // Menghentikan pengiriman form jika kedua field kosong
        }
        return true; // Mengizinkan pengiriman form jika salah satu field diisi
    }


    function toggleDownPayment() {
        var checkbox = document.getElementById('defaultUnchecked');
        var downPaymentField = document.getElementById('downPaymentField');
        var paymentField = document.getElementById('paymentField');

        if (checkbox.checked) {
            downPaymentField.style.display = 'block'; // Tampilkan input teks Down Payment jika checkbox dicentang
            paymentField.style.display = 'none'; // Sembunyikan input teks Payment jika checkbox dicentang
            $('#payment').val(0);
            calcTotalPayment();

        } else {
            downPaymentField.style.display = 'none'; // Sembunyikan input teks Down Payment jika checkbox tidak dicentang
            paymentField.style.display = 'block'; // Tampilkan input teks Payment jika checkbox tidak dicentang
            $('#downpayment').val(0.00);
            calcTotalPayment();
        }
    }
    window.onload = toggleDownPayment;


    $('#downpayment').on('keyup', function() {
        var n = parseFloat($(this).val().replace(/\D/g, '')); // Menghapus karakter non-digit
        if (isNaN(n)) {
            $(this).val(0);
        } else {
            n = n / 100; // Mengubah angka menjadi 2000 dari 200000 (asumsi persen)
            $(this).val(n.toLocaleString('id-ID', {
                minimumFractionDigits: 2
            })); // Format angka
        }
        calcTotalPayment();
    });
    $('#payment').on('keyup', function() {
        var n = parseFloat($(this).val().replace(/\D/g, '')); // Menghapus karakter non-digit
        if (isNaN(n)) {
            $(this).val(0);
        } else {
            n = n / 100; // Mengubah angka menjadi 2000 dari 200000 (asumsi persen)
            $(this).val(n.toLocaleString('id-ID', {
                minimumFractionDigits: 2
            })); // Format angka
        }
        calcTotalPayment();
    });

    function calcTotalPayment() {
        var downPayment = $('#downpayment').val() || "0,00";
        var payment = $('#payment').val() || "0,00";

        var totalPayment = convertCurrencyToNumber(downPayment) + convertCurrencyToNumber(payment);
        var outstandings = CurrentOutStanding - totalPayment
        $('#currentoutstanding').text(formatCurrency(outstandings));

    }

    function formatCurrency(amount) {
        var parts = amount.toFixed(2).toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        return parts.join(",");
    }

    function convertCurrencyToNumber(currencyValue) {
        // Menghapus semua karakter selain angka, titik, dan koma
        var cleanValue = currencyValue.replace(/[^\d,.]/g, '');

        // Menghapus semua titik
        cleanValue = cleanValue.replace(/\./g, '');

        // Mengubah tanda koma menjadi titik untuk desimal
        cleanValue = cleanValue.replace(',', '.');

        // Mengubah string ke nilai numerik (number)
        var numericValue = parseFloat(cleanValue);

        return numericValue;
    }
</script>
@endsection
