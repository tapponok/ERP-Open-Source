@extends('layouts.master')
@section('linkrel')
<link rel="stylesheet" media="screen, print" href="{{asset('css/notifications/toastr/toastr.css')}}">
@endsection
@section('content')
<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('partnership.index') }}">Partnership</a></li>
        <li class="breadcrumb-item">Detail</li>
    </ol>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Partnership Detail
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
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
                                                        <strong>Partnership</strong>
                                                    </td>
                                                    <td>
                                                        {{$partnership->name}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Email</strong>
                                                    </td>
                                                    <td>
                                                        {{ $partnership->email }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Bank Name</strong>
                                                    </td>
                                                    <td>
                                                        {{ $partnership->bankname }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Bank Account</strong>
                                                    </td>
                                                    <td>
                                                        {{ $partnership->bankaccount }}
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
                                                        <strong>Phone</strong>
                                                    </td>
                                                    <td>
                                                        {{ $partnership->phone }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>City</strong>
                                                    </td>
                                                    <td>
                                                        {{ $partnership->city }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>province</strong>
                                                    </td>
                                                    <td>
                                                        {{ $partnership->province }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Address</strong>
                                                    </td>
                                                    <td>
                                                        {{ $partnership->address }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Postal Code</strong>
                                                    </td>
                                                    <td>
                                                        {{ $partnership->postalcode }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row float-right p-4">
                                <div class="demo">
                                    <a class="btn-cancel btn btn-secondary waves-effect waves-themed float-right" href="{{route('partnership.index')}}"><span class="fal fa-chevron-left mr-1"></span>Back</a>
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
