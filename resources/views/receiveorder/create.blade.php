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
        <li class="breadcrumb-item"><a href="/receiveorder">Receive order</a></li>
        <li class="breadcrumb-item">Create</li>
    </ol>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Create receive order
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
                <form class="submitform" action="{{route('receiveorder.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="border border-top border-right border-right border-bottom border-left p-3">
                                <h5 class="form-label">
                                    Input Purchase Order
                                </h5>
                                <div class="form-group">
                                    <select data-placeholder="Select Purchase order" name="idpurchaseorder"
                                        class="form-control" id="idpurchaseoder" required></select>
                                    @error('idpurchaseoder')
                                    <span class="text-danger">{{ $message  }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="lisenseplate">Lisense Plate</label>
                                    <input type="text" name="lisenseplate" class="form-control"
                                        value="{{ old('lisenseplate') }}" placeholder="Enter lisense plate">
                                    @error('lisenseplate')
                                    <span class="text-danger">{{ $message  }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="border border-top border-right border-right border-bottom border-left p-3">
                                <h5 class="form-label">
                                    Detail Purchase Order
                                </h5>
                                <div class="row p-2">
                                    <div class="col-sm-4 d-flex">
                                        <div class="table-responsive">
                                            <table class="table table-clean table-sm align-self-end">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <strong>Puchase Order</strong>
                                                        </td>
                                                        <td class="purchaseorder">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>Purchase Invoice</strong>
                                                        </td>
                                                        <td class="purchaseinvoice">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>Purchaser</strong>
                                                        </td>
                                                        <td class="purchaser">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>Order Date</strong>
                                                        </td>
                                                        <td class="orderdate">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>Invoice Date</strong>
                                                        </td>
                                                        <td class="invoicedate">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 ml-sm-auto">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-clean">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <strong>Supplier</strong>
                                                        </td>
                                                        <td class="supplier">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>Garage</strong>
                                                        </td>
                                                        <td class="garage">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>Total</strong>
                                                        </td>
                                                        <td class="total">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>Notes</strong>
                                                        </td>
                                                        <td class="notes">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content col-md-12">
                            <div class="border border-top border-right border-right border-bottom border-left p-3">
                                <h5 class="form-label">
                                    Detail Items
                                </h5>
                                <table id="dataitems" class="table table-bordered table-hover table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Product Code</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <div
                                    class="border border-top border-right border-right border-bottom border-left p-3 text-right">
                                    <h3 class="m-0 fw-700 h3 keep-print-font">TOTAL
                                        <span id="testku" class="m-0 fw-700 h keep-print-font">
                                        </span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <input type="text" name="productcode[]" id="productcode" class="form-control"
                                        value="" placeholder="product code" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="quantityreceive" class="form-label">Quantity Receivee</label>
                                    <input type="number" name="quantityreceive[]" id="quantityreceive" class="form-control"
                                        value="" placeholder="Input quantity">
                                </div>
                                <div class="panel-content">
                                    <button type="button" id="addopname"
                                        class="btn btn-warning btn-sm float-right btn-addopname">Add to list
                                    </button>
                                    <h1></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content col-md-12">
                            <h5 class="form-label">
                                List Receive Items
                            </h5>
                            <table id="stockin" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Receive Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-content col-md-12 float-right p-3">
                    <a class="btn btn-secondary btn-sm waves-effect waves-themed"
                            href="{{route('receiveorder.index')}}">Back</a>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script src="{{asset('js/formplugins/select2/select2.bundle.js')}}"></script>
<script src="{{asset('js/notifications/sweetalert2/sweetalert2.bundle.js')}}"></script>
<script class="text/javascript">
    $('#idpurchaseoder').change(purchaseorderchange).change();
    $(function () {
        $("#idpurchaseoder").select2({
            minimumInputLength: 2,
            ajax: {
                url: "{{route('ajax.getpurchaseorder')}}",
                type: "POST",
                dataType: 'json',
                delay: 250,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (params) {
                    return {
                        search: params.term,
                    };
                },
                processResults: function (response) {
                    return {
                        results: $.map(response, function (item) {
                            return {
                                id: item.id,
                                text: item.text,
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });

    function removedataitems() {
        $('#dataitems td').remove();
    };

    function purchaseorderchange() {
        removedataitems();
        po_number= [];
        var id = jQuery(this).val();
        var url = '{{ route("ajax.getpodetail", ":id") }}';
        url = url.replace(':id', id);
        var nullvalue = 0;
        if (id) {
            jQuery.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $.each(data.response, function (key, value) {
                        $(".purchaseorder").html(data.purchaseorder)
                        $(".purchaseinvoice").html(data.purchaseinvoice)
                        $(".purchaser").html(data.purchaser)
                        $(".orderdate").html(data.orderdate)
                        $(".invoicedate").html(data.invoicedate)
                        $(".supplier").html(data.supplier)
                        $(".garage").html(data.garage)
                        $(".total").html("Rp" + number_format(data.total))
                        $(".notes").html(data.notes)
                        testku.innerText = "Rp" + number_format(data.total)
                        var html = '<tr>' +
                            '<td>' + value.productname + '</td>' +
                            '<td>' + value.productcode + '</td>' +
                            '<td>' + value.quantity + '</td>' +
                            '<td>' + value.price + '</td>' +
                            '<td>' + value.total + '</td>' +
                            '</tr>';
                        $('#dataitems tr').first().after(html);
                        po_number.push(id);
                    });
                }
            });
        }
    }
    var arrayid = [];
    var po_number = [];
    $('.js-data-example-ajax').change(productchange).change();
    $(function () {
        var url = '{{ route("ajax.getproductreceive") }}';
        $(".js-data-example-ajax").select2({
            minimumInputLength: 1,
            ajax: {
                url: url,
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
                        po_number
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
        var quantity = $("#quantityreceive").val();
        console.log(quantity);
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
                "<td>" + productname + "</td>" +
                "<td>" + codeproduct + "</td>" +
                "<td>" + quantity + "</td>" +
                "<td>" +
                "<a href='javascript:void(0)'; class='btn btn-sm btn-outline-danger btn-icon btn-inline-block mr-1 btn-removerow' id='btnremoverow' title='Delete Record' style='color: red' onclick='deleteRow(" +
                idproduct +
                ")'><i class='fal fa-trash'></i></a>" +
                "</tr>";
            $("#stockin tbody").append(markup);
            arrayid.push(idproduct);
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
                url : url.replace(':id', id),
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

    function deleteRow(id) {
        var id = id;
        var strid = id.toString();
        var index = arrayid.indexOf(strid);
        if (index > -1) {
            arrayid.splice(index, 1);
        } else if (index > -1)
            arrayid.splice(index, 1);
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
        $("#quantityreceive").val('');
    }

    function number_format(number, decimals, decPoint, thousandsSep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
        var n = !isFinite(+number) ? 0 : +number
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
        var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
        var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
        var s = ''
        var toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
        }
        // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
        }
        return s.join(dec)
    }

    $('form').submit(function () {
        $(this).find(':submit').attr('disabled', 'disabled');
    });

</script>
@endsection
