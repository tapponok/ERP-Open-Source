@extends('layouts.master')
@section('linkrel')
<link rel="stylesheet" media="screen, print" href="{{asset('css/notifications/toastr/toastr.css')}}">
@endsection
@section('content')
<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
         <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
        <li class="breadcrumb-item">Detail</li>
    </ol>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Product Detail
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
                                <div class="col-sm-4 d-flex">
                                    <div class="table-responsive">
                                        <table class="table table-clean table-sm align-self-end">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>Product</strong>
                                                    </td>
                                                    <td>
                                                        {{$product->product_name}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Code</strong>
                                                    </td>
                                                    <td>
                                                        {{ $product->product_code }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Category</strong>
                                                    </td>
                                                    <td>
                                                        {{ $product->category->categ_name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Unit</strong>
                                                    </td>
                                                    <td>
                                                        {{ $product->unit->unit_name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Photo</strong>
                                                    </td>
                                                    <td>
                                                        @if ($product->product_photo != null)
                                                        <img src="{{asset('storage/product/'.$product->product_photo)}}"
                                                            class="profile-image-md" alt="photo">
                                                        @else
                                                        <img src="{{ $product->getUrlfriendlyAvatar() }}"
                                                            class="profile-image-md rounded-circle" alt="users profile">
                                                        @endif
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
                                                        <strong>Minimum Stock</strong>
                                                    </td>
                                                    <td>
                                                        {{ $product->minimum_stock }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Stock</strong>
                                                    </td>
                                                    <td>
                                                        {{ number_format($product->stock) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Selling Price</strong>
                                                    </td>
                                                    <td>
                                                        {{ number_format($product->selling_price) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row float-right p-4">
                                <div class="demo">
                                    <a class="btn-cancel btn btn-secondary waves-effect waves-themed float-right"
                                        href="{{route('product.index')}}"><span
                                            class="fal fa-chevron-left mr-1"></span>Back</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Info -->
</main>
@endsection
@section('script')
@endsection
