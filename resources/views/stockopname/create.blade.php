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
        <li class="breadcrumb-item"><a href="{{route('stockopname.index')}}">Stock Opename</a></li>
        <li class="breadcrumb-item">Create</li>
    </ol>
    <div class="subheader">
        <h3 class="subheader-title">
            <i class='subheader-icon fal fa-plus'></i> Create Stock Opename
        </h3>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <h5 class="form-label">
                            Stock Opname
                        </h5>
                        <div class="border border-top border-right border-right border-bottom border-left p-3">
                            <div class="form-group">
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
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" name="stock[]" id="stock" class="form-control" value=""
                                    placeholder="0" disabled>
                            </div>
                            <div class="form-group">
                                <label for="stock" class="form-label">New Stock</label>
                                <input type="number" name="newstock[]" id="newstock" class="form-control" value=""
                                    placeholder="0" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="Name">Notes</label>
                                <textarea class="form-control" id="notes" name="notes[]" rows="2"></textarea>
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
                <form class="p-2" action="{{route('stockopname.store')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel-container show">
                        <div class="panel-content col-md-12">
                            <h5 class="form-label">
                                Stock Opname - List Item
                            </h5>
                            <table id="datatable-stockopname"
                                class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>Garage</th>
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Last Stock</th>
                                        <th>New Stock</th>
                                        <th>Difference</th>
                                        <th>Notes</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-container show p-0">
                        <div class="panel-content">
                            <div class="form-group col-md-12 float-left">
                                <label class="form-label" for="Name">Notes</label>
                                <textarea class="form-control" name="notesstockopname" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="panel-container show p-0 float-right">
                        <div class="panel-content col-md-12 float-right p-3">
                            <a class="btn btn-secondary waves-effect waves-themed"
                                href="{{route('purchaseorder.index')}}">Back</a>
                            <button type="submit" class="btn btn-primary ">Submit</button>
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
        var garageid = $('#garage_id').val();
        var garagename = $("#garage_id  option:selected").text();
        var idproduct = $(".js-data-example-ajax").val();
        var productname = $("#id").text();
        var codeproduct = $("#productcode").val();
        var stock = $("#stock").val();
        var newstock = $("#newstock").val();
        var message = $('textarea#notes').val();
        var difference = newstock - stock;

        if ($('#garage_id').val() == '') {
            errormsg_garageid();
        } else if ($("#productcode").val() == '') {
            errormsg_code();
        } else if ($("#newstock").val() == '') {
            errormsg_newstock();
        } else {
            var markup = "<tr>" +
                "<input type='hidden' class='id-product from-control' id='garageid' name='garageid[]' value='" +
                garageid + "'>" +
                "<input type='hidden' class='id-product from-control' id='garagename' name='garagename[]' value='" +
                garagename + "'>" +
                "<input type='hidden' class='id-product from-control' id='productid' name='idproduct[]' value='" +
                idproduct + "'>" +
                "<input type='hidden' class='id-product from-control' id='productname' name='productname[]' value='" +
                productname + "'>" +
                "<input type='hidden' class='id-product from-control' id='codeproduct' name='codeproduct[]' value='" +
                codeproduct + "'>" +
                "<input type='hidden' class='laststock from-control' name='stock[]' value='" +
                stock + "'required >" +
                "<input type='hidden' class='newstock from-control' name='newstock[]' value='" +
                newstock + "'>" +
                "<input type='hidden' class='difference from-control' name='message[]' value='" +
                message + "'>" +
                "<td>" + garagename + "</td>" +
                "<td>" + productname + "</td>" +
                "<td>" + codeproduct + "</td>" +
                "<td>" + stock + "</td>" +
                "<td>" + newstock + "</td>" +
                "<td>" + difference + "</td>" +
                "<td>" + message + "</td>" +
                "<td>" +
                "<a href='javascript:void(0)'; class='btn btn-sm btn-outline-danger btn-icon btn-inline-block mr-1 btn-removerow' id='btnremoverow' title='Delete Record' style='color: red' onclick='deleteRow(" +
                idproduct +
                ")'><i class='fal fa-trash'></i></a>" +
                "</tr>";
            $("table tbody").append(markup);
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
        var garageid = $('#garage_id').val();
        var nullvalue = 0;
        var url = '{{ route("ajax.getstockitem", ":id") }}';
        if (id) {
            jQuery.ajax({
                url: url.replace(':id', id),
                type: "POST",
                dataType: 'json',
                delay: 250,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    garageid,
                    id
                },
                success: function (data) {
                    $("#productcode").val(data.product_code);
                    $("#stock").val(data.stock);
                    return data;
                },
                error: function () {
                    alert('Error occured');
                }
            })
        } else {

        }
    };

    $('body').on('click', '#btnremoverow', function () {
        $(this).parents("tr").remove();
    });

    function errormsg_garageid() {
        Swal.fire({
            type: "error",
            title: "Oops...Something Wrong",
            text: "Please select garage",
        })
    }

    function errormsg_code() {
        Swal.fire({
            type: "error",
            title: "Oops...Something Wrong",
            text: "Please select a product before add !!!",
        });
    }

    function errormsg_newstock() {
        Swal.fire({
            type: "error",
            title: "Oops...Something Wrong",
            text: "Please input new stock",
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

    function deleteRow(id) {
        var id = id;
        var strid = id.toString();
        var index = arrayid.indexOf(strid);
        if (index > -1) {
            arrayid.splice(index, 1);
        } else if (index > -1)
            arrayid.splice(index, 1);
    }

    function clear() {
        $('#garage_id').val('');
        $(".js-data-example-ajax").empty();
        $("#id").empty();
        $("#productcode").val('');
        $("#stock").val('');
        $("#newstock").val('');
        $('textarea#notes').val('');
    }

    $('form').submit(function () {
        $(this).find(':submit').attr('disabled', 'disabled');
    });

</script>
@endsection
