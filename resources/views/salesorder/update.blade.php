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
                                    <input class="form-control" id="estimate_date" value="{{$salesorder->estimate_date}}" type="date" name="estimate_date">
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
                                    <input class="form-control" id="city" type="text" name="city" value="{{$partnership->city}}" placeholder="Input city">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label class="form-label" for="province">Province</label>
                                    <input class="form-control" id="province" type="text" name="province" value="{{$partnership->province}}" placeholder="Input province">
                                </div>
                                <div class="form-group col-md-6 float-left">
                                    <label class="form-label" for="postal_code">Postal code</label>
                                    <input class="form-control" id="postal_code" type="text" name="postal_code" value="{{$partnership->postalcode}}" placeholder="Input postal code">
                                </div>
                                <div class="form-group col-md-6 float-right">
                                    <label class="form-label" for="address">Address</label>
                                    <textarea class="form-control" name="address" id="address" rows="1">{{$partnership->address}}</textarea>
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
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-primary btn-sm float-right" onclick="showCreateModal({{$salesorder->id}})" data-salesorder="{{$salesorder->id}}" data-toggle="modal" data-target="#createModal">
                            Add product
                        </button>
                    </div>
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
                                                <th>Action</th>
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
                                                <td>
                                                    <div class="d-flex demo">
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary btn-icon btn-inline-block mr-1" title="update" id="update" data-toggle="modal" data-salesOrderItemID="{{ $u->id }}" data-salesOrderID="{{ $salesorder->id }}" data-productID="{{ $u->product_id }}" data-productName="{{ $u->product_name }}" data-productCode="{{ $u->product_code }}" data-price="{{ $u-> price }}" data-quantity="{{ $u->quantity }}" data-discountPercentage="{{ $u->discount_percentage }}" data-discountTotal="{{ $u->discounttotal }}" data-subTotal="{{ $u->subtotal }}" data-totalAfterDiscount="{{ $u->total_after_discount }}" data-target="#combinedModal" onclick="showUpdateModal({{$salesorder->id}})" data-salesorder="{{$salesorder->id}}">
                                                            <i class="fal fa-edit"></i></a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger btn-icon btn-inline-block mr-1" title="Delete Record" data-toggle="modal" data-salesOrderID="{{ $salesorder->id }}" onclick="deleteData({{$u->id}})" data-target="#DeleteModal" style="color: red"><i class="fal fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- datatable end -->
                                </div>
                                <div class="border border-top border-right border-right border-bottom border-left p-3">
                                    <div class="form-group  col-md-6 float-left">
                                        <label class="form-label" for="discount">Discount (%)</label>
                                        <input class="form-control" id="discount" type="text" name="discount" placeholder="Input discount">
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label class="form-label" for="total_discount">Discount total</label>
                                        <input class="form-control" id="total_discount" type="text" name="total_discount" placeholder="Input total discount">
                                    </div>
                                    <div class="form-group  col-md-6 float-left">
                                        <label class="form-label" for="tax_percent">Tax (%)</label>
                                        <input class="form-control" id="tax_percent" type="text" name="tax_percent" placeholder="Input tax">
                                    </div>
                                    <div class="form-group col-md-6 float-left">
                                        <label class="form-label" for="tax_total">Tax total</label>
                                        <input class="form-control" id="tax_total" type="text" name="tax_total" disabled>
                                    </div>
                                    <div class="panel-content">
                                        <div class="form-group">
                                            <label class="form-label" for="shipment_cost">Shipment cost</label>
                                            <input class="form-control" id="shipment_cost" type="text" name="shipment_cost" placeholder="Input shipment cost">
                                        </div>
                                    </div>
                                    <div class="panel-content">
                                        <div class="form-group">
                                            <label class="form-label" for="globalnotes">Notes</label>
                                            <textarea class="form-control" name="globalnotes" id="globalnotes" rows="3"></textarea>
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
                                                    <td class="text-right m-0  keep-print-font" id="totalCharge">{{ number_format($totalSalesOrderItem, 2, ',', '.') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row float-right p-4 mt-4">
                                        <div class="demo">
                                            <a class="btn btn-success btn-ms waves-effect waves-themed float-right" id="submitglobal">Submit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- add item to group modal -->
        <div class="modal fade" id="combinedModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Add product</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="addtogroup" method="POST">
                            {{csrf_field()}}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="form-label" for="select2-ajax">
                                        Select product
                                    </label>
                                    <select data-placeholder="Select product" name="productid" class="js-data-example-ajax form-control" id="selectidproduct"></select>
                                </div>
                                <input type="hidden" name="salesorderitemid" id="salesorderitemid" class="form-control" value="">
                                <div class="form-group">
                                    <label for="product_code">Product code</label>
                                    <input type="text" name="product_code" id="product_code" class="form-control" value="{{ old('product_code') }}" disabled>
                                    @error('product_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="string" id="selling_price" name="price" class="form-control" value="{{ old('price') }}" disabled>
                                    @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" id="inputQuantity" name="quantity" class="form-control" value="{{ old('quantity') }}" placeholder="Enter quantity" required>
                                    @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span id="quantityError" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="discount_percentage">Discount (%)</label>
                                    <input type="number" id="inputDiscountPercentage" name="discount_percentage" class="form-control" value="{{ old('discount_percentage') }}" placeholder="Enter discount %">
                                    @error('discount_percentage')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="discounttotal">Discount</label>
                                    <input type="text" id="inputDiscountTotal" name="discounttotal" class="form-control" value="{{ old('discounttotal') }}" placeholder="Enter discount">
                                    @error('discounttotal')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="subtotal">Subtotal</label>
                                    <input type="text" id="inputTotal" name="subtotal" class="form-control" value="{{ old('subtotal') }}" disabled>
                                    @error('inputTotal')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="TotalAfterDiscount">Total after discount</label>
                                    <input type="text" id="inputTotalAfterDiscount" name="totalafterdiscount" class="form-control" value="{{ old('totalafterdiscount') }}" disabled>
                                    @error('totalafterdiscount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" onclick="validateQuantity()" id="submitButton" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- delete modal -->
        <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Confirmation!!!</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <form action="" id="deleteForm" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <input type="hidden" name="permission_id" value="">
                            <h5 class="modal-title">Are you sure to delete this item?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Error...!!!</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title" id="errorModalContent"></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="errorModal" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

<script class="text/javascript">
    // Inisialisasi variabel global
    var salesOrderID = null;
    var DataMode = null;
    var totalCharge = 0;
    // var IDsalesOrder = {{$salesorder->id}};
    // var totalAmount = {{ $totalSalesOrderItem }};
    var IDsalesOrder = {{$salesorder->id}};
    var totalAmount = {{ $totalSalesOrderItem }};


    function validateQuantity() {
        let quantityInput = document.getElementById('inputQuantity').value;

        if (quantityInput === '') {
            document.getElementById('quantityError').innerHTML = 'Quantity is required!';
            return false;
        }

        document.getElementById('quantityError').innerHTML = ''; // Reset pesan kesalahan jika valid
        return true; // Kembalikan nilai true jika validasi berhasil
    }
    // Fungsi untuk menangani aksi Simpan di modal
    $('#submitButton').on('click', function() {
        if (validateQuantity()) {
            var sellingPrice = $('#selling_price').val();
            var inputQuantity = $('#inputQuantity').val();
            var inputDiscountPercentage = $('#inputDiscountPercentage').val();
            if (isNaN(inputDiscountPercentage) || inputDiscountPercentage === '') {
                inputDiscountPercentage = "0.00"; // Set the value to 0 if it's NaN or an empty string
            }
            var inputDiscountTotal = $('#inputDiscountTotal').val();
            var inputSubtotal = $('#inputTotal').prop('value');
            var inputTotalAfterDiscount = $('#inputTotalAfterDiscount').val();
            var selectedValue = $('#selectidproduct').val();
            var salesOrderItemID = $('#salesorderitemid').val();

            // Siapkan data yang akan dikirim ke backend, bisa berupa objek atau data yang sesuai dengan kebutuhan Anda
            var dataToSend = {
                sellingPrice: convertCurrencyToNumber(sellingPrice),
                inputQuantity: convertCurrencyToNumber(inputQuantity),
                inputDiscountPercentage: inputDiscountPercentage,
                inputDiscountTotal: convertCurrencyToNumber(inputDiscountTotal),
                inputSubtotal: convertCurrencyToNumber(inputSubtotal),
                inputTotalAfterDiscount: convertCurrencyToNumber(inputTotalAfterDiscount),
                productID: parseInt(selectedValue),
                salesOrderID: parseInt(salesOrderID),
                salesOrderItemID: parseInt(salesOrderItemID),
                ActionFor: DataMode
            };
            var url = "{{ route('salesorder.update', ':id') }}";
            url = url.replace(':id', salesOrderID) + "?_token={{ csrf_token() }}";
            var urlRedirect = "{{ route('salesorder.show', ':id') }}";
            urlRedirect = urlRedirect.replace(':id', salesOrderID)
            $.ajax({
                url: "url",
                method: 'PUT',
                data: dataToSend,
                success: function(response) {
                    // Redirect ke halaman yang diinginkan setelah proses selesai
                    window.location.href = urlRedirect;
                },
                error: function(xhr, status, error) {
                    // Handle error jika ada kesalahan dalam pengiriman data ke backend
                    $('#errorModal').modal('show'); // Tampilkan modal kesalahan
                    $('#errorModalContent').text('Terjadi kesalahan: ' + xhr.responseJSON.error); // Tampilkan pesan kesalahan dalam modal
                }
            });
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Fungsi untuk menampilkan modal dalam mode Create
    function showCreateModal(salesorder) {
        $('#combinedModal')
            .modal('show');
        DataMode = 'create';
        salesOrderID = salesorder;
        initializeModalElements();
    }

    function showUpdateModal(salesorder) {
        $('#combinedModal').on('show.bs.modal', function(event) {
            // Lainnya dari kode Anda
            $(this).modal('show'); // Tampilkan modal
            salesOrderID = salesorder;
            DataMode = 'update';
            $('#selectidproduct').prop('disabled', true).trigger('change');
            var salesOrderItemID = $(event.relatedTarget).data('salesorderitemid');
            var productID = $(event.relatedTarget).data('productid');
            var productName = $(event.relatedTarget).data('productname');
            var productCode = $(event.relatedTarget).data('productcode');
            var price = $(event.relatedTarget).data('price');
            var quantity = $(event.relatedTarget).data('quantity');
            var discountPercentage = $(event.relatedTarget).data('discountpercentage');
            var discountTotal = $(event.relatedTarget).data('discounttotal');
            var subtTotal = $(event.relatedTarget).data('subtotal');
            var totalAfterDiscount = $(event.relatedTarget).data('totalafterdiscount');

            // Buat objek yang merepresentasikan opsi yang ingin Anda tambahkan
            var newOption = new Option(productName, productID, true, true);

            // Tambahkan opsi yang dibuat ke dalam elemen select
            $('#selectidproduct').append(newOption).trigger('change');

            // Set text untuk opsi yang dipilih
            $('#selectidproduct').val(productID).trigger('change');
            // Set nilai ke elemen-elemen yang sesuai di dalam modal
            $('#salesorderitemid').val(salesOrderItemID);
            $('#product_code').val(productCode);
            $('#selling_price').val(formatCurrency(parseFloat(price)));
            $('#inputQuantity').val(quantity)
            $('#inputDiscountPercentage').val(parseFloat(discountPercentage));
            $('#inputDiscountTotal').val(formatCurrency(parseFloat(discountTotal)));
            $('#inputTotal').val(formatCurrency(parseFloat(subtTotal)));
            $('#inputTotalAfterDiscount').val(formatCurrency(parseFloat(totalAfterDiscount)));
            initializeModalElements();



        });
    }
    $('#combinedModal').on('hidden.bs.modal', function() {
        DataMode = null;
        $('#inputDiscountPercentage').prop('disabled', false).trigger('change');
        $('#inputDiscountTotal').prop('disabled', false).trigger('change');

    });


    function initializeModalElements() {
        $(".js-data-example-ajax").select2({
            minimumInputLength: 2,
            dropdownParent: $('#combinedModal'),
            ajax: {
                url: "{{route('ajax.getproduct')}}" + "?_token=" + "{{ csrf_token() }}",
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
                                text: item.text,
                                product_code: item.product_code,
                                selling_price: item.selling_price
                            }
                        })
                    };
                },
                cache: true
            }
        }).on('select2:select', function(e) {
            var data = e.params.data;
            // Mengambil nilai id dan text dari data yang dipilih
            var selectedId = data.id;
            var selected_product_code = data.product_code;
            var selected_selling_price = data.selling_price;
            var sellingPrice = parseFloat(selected_selling_price) || 0;

            // Menempatkan nilai ke dalam input teks di modal
            $('#product_code').val(selected_product_code);
            $('#selling_price').val(formatCurrency(sellingPrice));
            $('#inputTextDiModal').val(selectedId);
        });
        // Event listener untuk perubahan pada field kuantitas
        $('#inputQuantity').on('input', function() {
            calculateQuantity($(this));
        });
        // Event listener untuk perubahan pada field Diskon Persentase
        $('#inputDiscountPercentage').on('input', function() {
            $('#inputDiscountTotal').prop('disabled', true).trigger('change');
            calculateDiscountPercentage($(this)); // Pass elemen sebagai argumen ke fungsi
        });
        // Event listener untuk perubahan pada field Diskon Total
        $('#inputDiscountTotal').on('keyup', function() {
            $('#inputDiscountPercentage').prop('disabled', true).trigger('change');
            var n = parseFloat($(this).val().replace(/\D/g, '')); // Menghapus karakter non-digit
            if (isNaN(n)) {
                $(this).val(0);
            } else {
                n = n / 100; // Mengubah angka menjadi 2000 dari 200000 (asumsi persen)
                $(this).val(n.toLocaleString('id-ID', {
                    minimumFractionDigits: 2
                })); // Format angka
                calculateDiscountTotal();
            }
        });

        $('#selectidproduct').on('change', function() {
            $('#selling_price').val('');
            $('#inputQuantity').val('');
            $('#inputDiscountPercentage').val(0);
            $('#inputDiscountTotal').val(0);
            $('#inputTotal').val('');
            $('#inputTotalAfterDiscount').val('');
        });
    }


    function calculateQuantity(quantity) {
        var sellingPrice = convertCurrencyToNumber($('#selling_price').val());
        var quantity = $(quantity).val(); // Ambil nilai kuantitas
        var total = sellingPrice * parseFloat(quantity); // Hitung total harga

        // Format angka menjadi string dengan pemisah ribuan dan desimal yang diinginkan secara manual
        var formattedTotal = formatCurrency(total);

        // Tampilkan total harga yang diformat di field total
        if (isNaN(quantity) || quantity === '') {
            // Jika tidak ada angka atau kosong, atur nilai total menjadi 0 atau kosongkan field total
            $('#inputTotal').val(0);
        } else {
            // Jika quantity adalah angka, lanjutkan dengan perhitungan total
            $('#inputTotal').val(formattedTotal);
        }
        calculateAndUpdate();
    }

    function calculateDiscountPercentage(discountInput) {
        var discountPercentage = parseFloat(discountInput.val()) || 0; // Menggunakan variabel discountInput sebagai referensi elemen
        var Price = convertCurrencyToNumber($('#selling_price').val()) || 0; // Ambil nilai Harga Jual atau tetapkan 0 jika kosong
        var quantity = $('#inputQuantity').val() || 0;

        var sellingPrice = Price * quantity
        // Hitung Diskon Total berdasarkan Persentase
        var roundUpDiscTotal = (sellingPrice * discountPercentage) / 100;

        var discountTotal = Math.ceil(roundUpDiscTotal)
        // Tampilkan Diskon Total yang dihitung di field Diskon Total
        $('#inputDiscountTotal').val(formatCurrency(discountTotal));

        // Hitung dan tampilkan Harga Setelah Diskon
        var totalPriceAfterDiscount = sellingPrice - discountTotal;

        $('#inputTotalAfterDiscount').val(formatCurrency(totalPriceAfterDiscount));
    }

    function calculateDiscountTotal() {
        var discountTotal = $('#inputDiscountTotal').val() || 0; // Ambil nilai Diskon Total atau tetapkan 0 jika kosong
        var discountTotalParse = convertCurrencyToNumber(discountTotal);
        var Price = convertCurrencyToNumber($('#selling_price').val()) || 0; // Ambil nilai Harga Jual atau tetapkan 0 jika kosong
        var quantity = $('#inputQuantity').val() || 0;
        var sellingPrice = Price * quantity
        // Hitung Diskon Persentase berdasarkan Total
        var discountPercentage = (discountTotalParse * 100) / sellingPrice;

        // Tampilkan Diskon Persentase yang dihitung di field Diskon Persentase
        $('#inputDiscountPercentage').val(discountPercentage);

        // Hitung dan tampilkan Harga Setelah Diskon
        var totalPriceAfterDiscount = sellingPrice - discountTotalParse;
        $('#inputTotalAfterDiscount').val(formatCurrency(totalPriceAfterDiscount));
    }

    function calculateAndUpdate() {
        var sellingPrice = convertCurrencyToNumber($('#selling_price').val()) || 0;
        var quantity = parseFloat($('#inputQuantity').val()) || 0;
        var discountPercentage = parseFloat($('#inputDiscountPercentage').val()) || 0;


        var discountTotal = (sellingPrice * quantity * discountPercentage) / 100;
        $('#inputDiscountTotal').val(formatCurrency(discountTotal));

        var subtotal = sellingPrice * quantity - discountTotal;
        $('#inputSubtotal').val(subtotal.toFixed(2));

        // Hitung Harga Setelah Diskon
        var totalPriceAfterDiscount = subtotal; // Harga Setelah Diskon adalah nilai Subtotal
        $('#inputTotalAfterDiscount').val(formatCurrency(totalPriceAfterDiscount));
    }
    // Event listener untuk perubahan pada field Diskon Persentase
    $('#inputDiscountPercentage').on('input', function() {
        calculateAndUpdate();
    });

    // Event listener untuk perubahan pada field Quantity (jika diperlukan)
    $('#inputQuantity').on('input', function(quantity) {
        if (isNaN(quantity) || quantity === '') {
            // Jika tidak ada angka atau kosong, atur nilai total menjadi 0 atau kosongkan field total
            $('#inputTotal').val(0);
        } else {
            // Jika quantity adalah angka, lanjutkan dengan perhitungan total
            calculateAndUpdate();
        }
    });
    // Fungsi untuk mengubah angka menjadi format mata uang yang diinginkan (pemisah ribuan dan desimal)
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

    function deleteData(id) {
        var id = id;
        var url = '{{ route("salesorder.destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    // Event listener untuk perubahan pada field Quantity (jika diperlukan)
    $('#discount').on('input', function() {
        $('#total_discount').prop('disabled', true).trigger('change');
        calculateSalesOrderDiscount()
    });
    $('#tax_percent').on('input', function() {
        calculateSalesOrder()
    });

    $('#shipment_cost').on('keyup', function() {
        var n = parseFloat($(this).val().replace(/\D/g, '')); // Menghapus karakter non-digit
        if (isNaN(n)) {
            $(this).val(0);
        } else {
            n = n / 100; // Mengubah angka menjadi 2000 dari 200000 (asumsi persen)
            $(this).val(n.toLocaleString('id-ID', {
                minimumFractionDigits: 2
            })); // Format angka
            calculateSalesOrder();
        }
    });

    $('#total_discount').on('keyup', function() {
        $('#discount').prop('disabled', true).trigger('change');
        var n = parseFloat($(this).val().replace(/\D/g, '')); // Menghapus karakter non-digit
        if (isNaN(n)) {
            $(this).val(0);
        } else {
            n = n / 100; // Mengubah angka menjadi 2000 dari 200000 (asumsi persen)
            $(this).val(n.toLocaleString('id-ID', {
                minimumFractionDigits: 2
            })); // Format angka
            calculateSalesOrderUpdate();
        }
    });

    function keyUpdata(n) {
        if (isNaN(n)) {
            $(this).val(0);
        } else {
            var n = parseInt($(this).val().replace(/\D/g, ''), 10);
            $(this).val(n.toLocaleString());
            calculateSalesOrderUpdate();
        }
    }

    function calculateSalesOrderDiscount() {
        var discount = $('#discount').val() || 0;
        var totaldiscuount = (totalAmount * discount) / 100;
        var subtotalCharge = totalAmount - totaldiscuount;

        var taxPercent = $('#tax_percent').val() || 0;
        var totalTax = (subtotalCharge * taxPercent) / 100;

        var shipmentCostVal = $('#shipment_cost').val() || "0";
        var shipmentCost = parseFloat(shipmentCostVal.replace(/,/g, ''));

        var totalCharge = subtotalCharge + totalTax + shipmentCost;

        $('#tax_total').val(formatCurrency(totalTax));
        $('#total_discount').val(formatCurrency(totaldiscuount));
        $('#totalCharge').text(formatCurrency(totalCharge));


    }
    function calculateSalesOrder() {
        var totaldiscount = $('#total_discount').val() || 0;
        var taxPercent = $('#tax_percent').val() || 0;
        var subtotalCharge = totalAmount - convertCurrencyToNumber(totaldiscount);
        var totalTax = (subtotalCharge * taxPercent) / 100;
        var shipmentCostVal = $('#shipment_cost').val() || "0";
        var shipmentCost = convertCurrencyToNumber(shipmentCostVal);

        var totalCharge = subtotalCharge + totalTax + shipmentCost;

        $('#totalCharge').text(formatCurrency(totalCharge));
        $('#tax_total').val(formatCurrency(totalTax));
    }

    function calculateSalesOrderUpdate() {
        var totalDiscount = $('#total_discount').val() || 0;
        var totalDiscountParse = convertCurrencyToNumber(totalDiscount); // Parse string ke number

        var discTotalPercentage = (totalDiscountParse * 100) / totalAmount;
        var shipmentCostVal = $('#shipment_cost').val() || 0;
        var totalTax = $('#tax_total').val() || 0;

        var subtotalCharge = totalAmount - totalDiscountParse;
        var totalCharge = subtotalCharge + parseFloat(totalTax) + parseFloat(shipmentCostVal);

        $('#discount').val(discTotalPercentage.toFixed(2)); // Menyimpan discTotalPercentage dengan 2 angka desimal
        $('#totalCharge').text(formatCurrency(totalCharge));
    }
    $("#submitglobal").on("click", function() {
        var globalNotes = $('#globalnotes').val();
        var city = $('#city').val();
        var partnershipID = $('#partnership-select').val();
        var garageID = $('#garage-select').val();

        var estimateDate = $('#estimate_date').val();
        var province = $('#province').val();
        var postalCode = $('#postal_code').val();

        var addressValue = $('#address').val();
        var discount = $('#discount').val() || "0";
        var totalDiscount = $('#total_discount').val() || "0";
        var taxPercent = $('#tax_percent').val() || "0";
        var totalTax = $('#tax_total').val() || "0";
        var shipmentCostVal = $('#shipment_cost').val() || "0";
        var totalCharge = $('#totalCharge').text();
        var totalAmount = $('#totalAmount').text();

        var dataToSend = {
            IDsalesOrder: IDsalesOrder,
            globalNotes: globalNotes,
            partnershipID: partnershipID,
            garageID: garageID,
            estimateDate: estimateDate,
            city: city,
            province: province,
            postalCode: postalCode,
            addressValue: addressValue,
            discount: discount,
            totalDiscount: convertCurrencyToNumber(totalDiscount),
            taxPercent: convertCurrencyToNumber(taxPercent),
            totalTax: convertCurrencyToNumber(totalTax),
            shipmentCostVal: convertCurrencyToNumber(shipmentCostVal),
            totalAmount: convertCurrencyToNumber(totalAmount),
            totalCharge: convertCurrencyToNumber(totalCharge)
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
                title: "Are you sure?",
                text: "You submit the sales order!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, submit!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            })
            .then(function(result) {
                if (result.value) {
                    var urlPost = "{{ route('salesorder.submit', ':id') }}";
                    urlPost = urlPost.replace(':id', IDsalesOrder) + "?_token={{ csrf_token() }}";
                    var urlRedirect = "{{ route('salesorder.index') }}";
                    $.ajax({
                        url: urlPost,
                        method: 'post',
                        data: dataToSend,
                        success: function(response) {
                            swalWithBootstrapButtons.fire(
                                "Submited!",
                                "Your sales order has been submited.",
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
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                    // window.location.href = urlRedirect
                    // Read more about handling dismissals
                ) {
                    swalWithBootstrapButtons.fire(
                        "Cancelled",
                        "Your sales order not submited",
                        "error"
                    );
                }
            });
    }); // A message with a custom image and CSS animation disabled
</script>
@endsection
