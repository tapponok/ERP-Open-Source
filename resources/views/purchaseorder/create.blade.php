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
        <li class="breadcrumb-item"><a href="{{route('purchaseorder.index')}}">Purchase Order</a></li>
        <li class="breadcrumb-item">Create</li>
    </ol>
    <div class="subheader">
        <h3 class="subheader-title">
            <i class='subheader-icon fal fa-plus'></i> Create Purchase Order
        </h3>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <h5 class="form-label">
                            Input Product
                        </h5>
                        <div class="border border-top border-right border-right border-bottom border-left p-3">
                            <div class="form-group">
                                <label class="form-label" for="select2-ajax">
                                    Select Product
                                </label>
                                <select data-placeholder="Select product" name="id[]"
                                    class="js-data-example-ajax form-control" id="id"></select>
                            </div>
                            <div class="form-group">
                                <label for="productcode" class="form-label">Product Code</label>
                                <input type="text" name="productcode[]" id="productcode" class="form-control" value=""
                                    placeholder="product code" disabled>
                            </div>
                            <div class="form-group">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" name="quantity[]" id="quantity" class="form-control" value=""
                                    placeholder="0" required>
                            </div>
                            <div class="form-group">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" name="price[]" id="price" class="form-control" value=""
                                    placeholder="0" required>
                            </div>
                            <div class="form-group">
                                <label for="subtotal" class="form-label">Subtotal</label>
                                <input type="number" name="subtotal[]" id="subtotal" class="form-control" value=""
                                    placeholder="0" disabled>
                            </div>
                            <div class="panel-content">
                                <button type="submit" id="addopname"
                                    class="btn btn-warning btn-sm float-right btn-addopname">Add to list
                                </button>
                                <h1></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="p-3" action="{{route('purchaseorder.store')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel-container show">
                        <div class="panel-content col-md-12">
                            <h5 class="form-label">
                                Purchase Order - List Item
                            </h5>
                            <table id="datatable-stockopname"
                                class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @error('idproduct')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Important!</strong> Please select product berfore submit data </div>
                                    @enderror
                                </tbody>
                            </table>
                            <div
                                class="border border-top border-right border-right border-bottom border-left p-3 text-right">
                                <h3 class="m-0 fw-700 h3 keep-print-font">TOTAL
                                    <span class="m-0 fw-700 h keep-print-font" id="total"> 0
                                    </span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="panel-container show p-0">
                        <div class="panel-content">
                            <div class="form-group col-md-6 float-left">
                                <label for="select Category">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="form-control">
                                    <option value="" disabled="" selected="{{ old('supplier_name') }}" required>Select
                                        supplier
                                    </option>
                                    @foreach ($supplier as $c)
                                    @if (old('supplier_id') == $c->id)
                                    <option value="{{ $c->id }}" selected>{{ $c->supplier_name }}</option>
                                    @else
                                    <option value="{{$c->id}}">{{$c->supplier_name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                <span class="text-danger">{{ $message  }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 float-left">
                                <label for="select Category">Garage</label>
                                @if (Auth::user()->hasRole('superadmin'))
                                <select name="garage_id" id="garage_id" class="form-control">
                                    <option value="" disabled="" selected="{{ old('garage_id') }}" required>Select
                                        garage
                                    </option>
                                    @foreach ($garage as $c)
                                    <option value="{{$c->id}}">{{$c->garagename}}</option>
                                    @endforeach
                                </select>
                                @else
                                <select name="garage_id" id="garage_id" class="form-control">
                                    <option value="" disabled="" selected="{{ old('garage_id') }}" required>Select
                                        garage
                                    </option>
                                    <option value="{{ Auth::user()->garage_id }}">
                                        {{ Auth::user()->garageid->garagename }}
                                    </option>
                                </select>
                                @endif
                                @error('garage_id')
                                <span class="text-danger">{{ $message  }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 float-right">
                                <label class="form-label" for="Name">Notes</label>
                                <textarea class="form-control" name="notes" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 float-right p-4">
                        <div class="panel-content float-right">
                            <a class="btn btn-secondary btn-sm waves-effect waves-themed"
                                href="{{route('purchaseorder.index')}}">Back</a>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</main>
@endsection
@section('script')
<script src="{{asset('js/formplugins/select2/select2.bundle.js')}}"></script>
<script src="{{asset('js/notifications/sweetalert2/sweetalert2.bundle.js')}}"></script>
<script class="text/javascript">
    var arrayid = [];
    $('.js-data-example-ajax').change(productchange).change();
    $('#quantity, #price').on('change keyup', function (e) {
        calculate();
    });
    $(function () {
        $(".js-data-example-ajax").select2({
            minimumInputLength: 2,
            ajax: {
                url: "{{route('ajax.getproduct')}}",
                type: "POST",
                dataType: 'json',
                delay: 250,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (params) {
                    return {
                        search: params.term,
                        arrayid,
                    };
                },
                processResults: function (response) {
                    return {
                        results: $.map(response, function (item) {
                            return {
                                id: item.id,
                                text: item.text
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });
    $(".btn-addopname").click(function () {
        var idproduct = $(".js-data-example-ajax").val();
        var productname = $("#id").text();
        var codeproduct = $("#productcode").val();
        var quantity = $("#quantity").val();
        var price = $("#price").val();
        var subtotal = $("#subtotal").val();

        if ($("#productcode").val() == '') {
            errormsg_code();
        } else if ($("#quantity").val() == '') {
            errormsg_quantity();
        } else if ($("#price").val() == '') {
            errormsg_price();
        } else {
            var markup = "<tr>" +
                "<input type='hidden' class='id-product from-control' id='productid' name='idproduct[]' value='" +
                idproduct + "'>" +
                "<input type='hidden' class='id-product from-control' id='productname' name='productname[]' value='" +
                productname + "'>" +
                "<input type='hidden' class='id-product from-control' id='codeproduct' name='codeproduct[]' value='" +
                codeproduct + "'>" +
                "<input type='hidden' class='laststock from-control' name='quantity[]' value='" +
                quantity + "'required >" +
                "<input type='hidden' class='newstock from-control' name='price[]' value='" +
                price + "'>" +
                "<input type='hidden' class='difference from-control' name='subtotal[]' value='" +
                subtotal + "'>" +
                "<td>" + productname + "</td>" +
                "<td>" + codeproduct + "</td>" +
                "<td>" + quantity + "</td>" +
                "<td>" + price + "</td>" +
                "<td>" + subtotal + "</td>" +
                "<td>" +
                "<a href='javascript:void(0)'; class='btn btn-sm btn-outline-danger btn-icon btn-inline-block mr-1 btn-removerow' id='btnremoverow' title='Delete Record' style='color: red' onclick='deleteRow(" +
                idproduct +
                ")'><i class='fal fa-trash'></i></a>" +
                "</tr>";
            $("table tbody").append(markup);
            arrayid.push(idproduct);
            calcultetotal();
            successmsg();
            clear();
        }
    });
    $('body').on('click', '#btnremoverow', function () {
        $(this).parents("tr").remove();
    })

    function productchange() {
        var id = jQuery(this).val();
        var nullvalue = 0;
        var url = '{{ route("ajax.getproductdetail", ":id") }}';
        if (id) {
            jQuery.ajax({
                url: url.replace(':id', id),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    jQuery.each(data, function (key, value, route) {
                        $('#productcode').val(value);
                        if (key == "") {
                            $('#laststock').val(nullvalue);
                        } else {
                            $('#laststock').val(key);
                        }
                    });
                }
            })
        } else {
            $('#productcode').empty();
            $('#laststock').empty();
        }
    };

    function calculate() {
        var resultku = "";
        var quantity = parseFloat($('#quantity').val());
        var price = parseFloat($('#price').val());
        var result = (quantity * price);
        if (quantity = null) {
            $('#subtotal').val(resultku);
        } else if (price = null) {
            $('#subtotal').val(resultku);
        } else {
            $('#subtotal').val(result);
        }
    }

    function calcultetotal() {
        var subtotal = parseFloat($('#subtotal').val());
        var input = document.getElementById("total");
        var text = parseFloat(input.innerHTML);
        var total = text + subtotal;
        if (total != null) {
            $('#total').text(total);;
        }
    }

    function deleteRow(id) {
        var id = id;
        var strid = id.toString();
        var index = arrayid.indexOf(strid);
        if (index > -1) {
            arrayid.splice(index, 1);
        } else if (index > -1)
            arrayid.splice(index, 1);
        calculatedatatotal();
    }

    function calculatedatatotal() {
        var input = document.getElementById("total");
        var text = parseFloat(input.innerHTML);
        var table = document.getElementById("purchaseorder");
        var rows = table.getElementsByTagName('tr');
        var value = "";
        var input = document.getElementById("total");
        var text = parseFloat(input.innerHTML);
        var total = "";
        for (var i = 1; i < rows.length; i++) {
            rows[i].i = i;
            rows[i].onclick = function () {
                value = table.rows[this.i].cells[4].innerHTML;
                total = text - value;
                $('#total').text(total);
            }
        }
    }
    $('body').on('click', '#btnremoverow', function () {
        $(this).parents("tr").remove();
    });

    function errormsg_code() {
        Swal.fire({
            type: "error",
            title: "Oops...Something Wrong",
            text: "Please select a product before add !!!",
        });
    }

    function errormsg_quantity() {
        Swal.fire({
            type: "error",
            title: "Oops...Something Wrong",
            text: "Please input quantity",
        })
    }

    function errormsg_price() {
        Swal.fire({
            type: "error",
            title: "Oops...Something Wrong",
            text: "Please input price",
        })
    }

    function successmsg() {
        Swal.fire({
            position: "top-end",
            type: "success",
            title: "Product add to list",
            showConfirmButton: false,
            timer: 7000
        });
    }

    function clear() {
        $(".js-data-example-ajax").empty();
        $('#productcode').val('');
        $("#id").val('');
        $("#laststock").val('');
        $("#quantity").val('');
        $("#price").val('');
        $("#subtotal").val('');
    }
    $('form').submit(function () {
        $(this).find(':submit').attr('disabled', 'disabled');
    });

</script>
@endsection
