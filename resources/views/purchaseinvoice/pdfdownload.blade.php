@extends('layouts.master')
@section('linkrel')
<link rel="stylesheet" media="screen, print" href="{{ asset('css/page-invoice.css') }}">
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h3 class="subheader-title" style="padding-left: 3rem;">
            <i class='subheader-icon fal fa-plus-circle'></i>Print Invoice
        </h3>
        <div class="subheader-title" style="padding-right: 3rem;">
            <button class="btn btn-primary waves-effect waves-themed float-right" onclick="window.print()"><span
                    class="fal fa-print mr-1"></span>
                Print Print Invoice</button>
        </div>
    </div>
    <div class="container">
        <div data-size="A4">
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex align-items-center mb-5">
                        <h2 class="keep-print-font fw-500 mb-0 text-primary flex-1 position-relative">
                            PT Rajasinakti Indonesia
                            <small class="text-muted mb-0 fs-xs">
                                Jl. Kartini No.21, Proklamasi, Kec. Siantar Bar,
                                Kota Pematang Siantar, Sumatera Utara 21146
                            </small>
                        </h2>
                    </div>
                    <h3 class="fw-300 display-4 fw-500 color-primary-600 keep-print-font pt-4 l-h-n m-0">
                        INVOICE
                    </h3>
                    <div class="text-dark fw-700 h1 mb-g keep-print-font">
                        {{ $pi_detail->pi_number }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 d-flex">
                    <div class="table-responsive">
                        <table class="table table-clean table-sm align-self-end">
                            <tbody>
                                <tr>
                                    <td>
                                        Purchase Order:
                                    </td>
                                    <td>
                                        {{$pi_detail->puchaseorderid->po_number}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Order Date:
                                    </td>
                                    <td>
                                        {{ $pi_detail->puchaseorderid->created_at->format('Y-m-d') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Purchaser:
                                    </td>
                                    <td>
                                        {{ $pi_detail->createdby->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Invoice date:
                                    </td>
                                    <td>
                                        {{ $pi_detail->created_at->format('Y-m-d') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Notes:
                                    </td>
                                    <td>
                                        {{ $pi_detail->note }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-4 ml-sm-auto">
                    <div class="table-responsive">
                        <table class="table table-sm table-clean text-right">
                            <tbody>
                                <tr>
                                    <td>
                                        <strong>Invoice to:</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>{{ $pi_detail->supplierid->supplier_name }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $pi_detail->supplierid->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $pi_detail->supplierid->city }} , {{ $pi_detail->supplierid->province }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $pi_detail->supplierid->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $pi_detail->supplierid->email }}
                                    </td>
                                </tr>
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
                                    <th class="text-center border-top-0 table-scale-border-bottom fw-700">
                                        No
                                    </th>
                                    <th class="text-center border-top-0 table-scale-border-bottom fw-700">
                                        Product Name</th>
                                    <th class="text-center border-top-0 table-scale-border-bottom fw-700">
                                        Product Code</th>
                                    <th class="text-center border-top-0 table-scale-border-bottom fw-700">
                                        Qty
                                    </th>
                                    <th class="text-center border-top-0 table-scale-border-bottom fw-700">
                                        Price
                                    </th>
                                    <th class="text-center border-top-0 table-scale-border-bottom fw-700">
                                        Sub Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pi_item as $i => $u)
                                <tr>
                                    <td class="text-center">{{ ++$i }} </td>
                                    <td class="text-center">{{ $u->product_code }}</td>
                                    <td class="text-center">{{ $u->product_name }}</td>
                                    <td class="text-center">{{ number_format($u->quantity) }}</td>
                                    <td class="text-center"> {{ number_format($u->price) }}</td>
                                    <td class="text-center"> {{ number_format($u->subtotal) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row p-4">
                <div class="col-sm-4 ml-sm-auto">
                    <table class="table table-clean">
                        <tbody>
                            <tr class="table-scale-border-top border-left-0 border-right-0 border-bottom-0">
                                <td class="text-left keep-print-font">
                                    <h4 class="m-0 fw-700 h2 keep-print-font color-primary-700">Total
                                    </h4>
                                </td>
                                <td class="text-right keep-print-font">
                                    <h4 class="m-0 fw-700 h2 keep-print-font">
                                        {{number_format($pi_detail->total)}}</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="py-5 text-primary">
                        Thank you very much. We really appreciate your business.
                    </h4>
                    <p class="mt-2 text-muted mb-0">
                        Payment details: ACC:123006705 IBAN:US100000060345 SWIFT:BOA447
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
@endsection
