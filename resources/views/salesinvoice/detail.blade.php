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


@endsection
