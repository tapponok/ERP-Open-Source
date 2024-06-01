@extends('layouts.master')
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{ $total_user }}
                        <small class="m-0 l-h-n">Total User</small>
                    </h3>
                </div>
                <i class="fal fa-user position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1"
                    style="font-size:6rem"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="p-3 bg-info-200 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{ $total_product }}
                        <small class="m-0 l-h-n">Total Product</small>
                    </h3>
                </div>
                <i class="fal fa-tag position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4"
                    style="font-size: 6rem;"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{ $total_purchaseorder }}
                        <small class="m-0 l-h-n">Total Puchase Order</small>
                    </h3>
                </div>
                <i class="fal fa-file position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4"
                    style="font-size: 6rem;"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{ $total_purchaseinvoice }}
                        <small class="m-0 l-h-n">Total Purchase Order</small>
                    </h3>
                </div>
                <i class="fal fa-file position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6"
                    style="font-size: 8rem;"></i>
            </div>
        </div>
    </div>
    <div id="panel-6" class="panel panel-sortable" role="widget">
        <div class="panel-hdr" role="heading">
            <h2 class="ui-sortable-handle">Secession Scale </h2>
            <div class="panel-saving mr-2" style="display:none"><i class="fal fa-spinner-third fa-spin-4x fs-xl"></i>
            </div>
            <div class="panel-toolbar" role="menu"><a href="#"
                    class="btn btn-panel hover-effect-dot js-panel-collapse waves-effect waves-themed"
                    data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></a> <a href="#"
                    class="btn btn-panel hover-effect-dot js-panel-fullscreen waves-effect waves-themed"
                    data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></a> <a href="#"
                    class="btn btn-panel hover-effect-dot js-panel-close waves-effect waves-themed"
                    data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></a></div>
            <div class="panel-toolbar" role="menu"><a href="#" class="btn btn-toolbar-master waves-effect waves-themed"
                    data-toggle="dropdown"><i class="fal fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-animated dropdown-menu-right p-0"><a href="#"
                        class="dropdown-item js-panel-refresh"><span data-i18n="drpdwn.refreshpanel">Refresh
                            Content</span></a> <a href="#" class="dropdown-item js-panel-locked"><span
                            data-i18n="drpdwn.lockpanel">Lock Position</span></a>
                    <div class="dropdown-multilevel dropdown-multilevel-left">
                        <div class="dropdown-item"> <span data-i18n="drpdwn.panelcolor">Panel Style</span> </div>
                        <div class="dropdown-menu d-flex flex-wrap"
                            style="min-width: 9.5rem; width: 9.5rem; padding: 0.5rem"><a href="#"
                                class="btn d-inline-block bg-primary-700 bg-success-gradient width-2 height-2 p-0 rounded-0 js-panel-color hover-effect-dot waves-effect waves-themed"
                                data-panel-setstyle="bg-primary-700 bg-success-gradient" style="margin:1px;"></a> <a
                                href="#"
                                class="btn d-inline-block bg-primary-500 bg-info-gradient width-2 height-2 p-0 rounded-0 js-panel-color hover-effect-dot waves-effect waves-themed"
                                data-panel-setstyle="bg-primary-500 bg-info-gradient" style="margin:1px;"></a> <a
                                href="#"
                                class="btn d-inline-block bg-primary-600 bg-primary-gradient width-2 height-2 p-0 rounded-0 js-panel-color hover-effect-dot waves-effect waves-themed"
                                data-panel-setstyle="bg-primary-600 bg-primary-gradient" style="margin:1px;"></a> <a
                                href="#"
                                class="btn d-inline-block bg-info-600 bg-primray-gradient width-2 height-2 p-0 rounded-0 js-panel-color hover-effect-dot waves-effect waves-themed"
                                data-panel-setstyle="bg-info-600 bg-primray-gradient" style="margin:1px;"></a> <a
                                href="#"
                                class="btn d-inline-block bg-info-600 bg-info-gradient width-2 height-2 p-0 rounded-0 js-panel-color hover-effect-dot waves-effect waves-themed"
                                data-panel-setstyle="bg-info-600 bg-info-gradient" style="margin:1px;"></a> <a href="#"
                                class="btn d-inline-block bg-info-700 bg-success-gradient width-2 height-2 p-0 rounded-0 js-panel-color hover-effect-dot waves-effect waves-themed"
                                data-panel-setstyle="bg-info-700 bg-success-gradient" style="margin:1px;"></a> <a
                                href="#"
                                class="btn d-inline-block bg-success-900 bg-info-gradient width-2 height-2 p-0 rounded-0 js-panel-color hover-effect-dot waves-effect waves-themed"
                                data-panel-setstyle="bg-success-900 bg-info-gradient" style="margin:1px;"></a> <a
                                href="#"
                                class="btn d-inline-block bg-success-700 bg-primary-gradient width-2 height-2 p-0 rounded-0 js-panel-color hover-effect-dot waves-effect waves-themed"
                                data-panel-setstyle="bg-success-700 bg-primary-gradient" style="margin:1px;"></a> <a
                                href="#"
                                class="btn d-inline-block bg-success-600 bg-success-gradient width-2 height-2 p-0 rounded-0 js-panel-color hover-effect-dot waves-effect waves-themed"
                                data-panel-setstyle="bg-success-600 bg-success-gradient" style="margin:1px;"></a> <a
                                href="#"
                                class="btn d-inline-block bg-danger-900 bg-info-gradient width-2 height-2 p-0 rounded-0 js-panel-color hover-effect-dot waves-effect waves-themed"
                                data-panel-setstyle="bg-danger-900 bg-info-gradient" style="margin:1px;"></a> <a
                                href="#"
                                class="btn d-inline-block bg-fusion-400 bg-fusion-gradient width-2 height-2 p-0 rounded-0 js-panel-color hover-effect-dot waves-effect waves-themed"
                                data-panel-setstyle="bg-fusion-400 bg-fusion-gradient" style="margin:1px;"></a> <a
                                href="#"
                                class="btn d-inline-block bg-faded width-2 height-2 p-0 rounded-0 js-panel-color hover-effect-dot waves-effect waves-themed"
                                data-panel-setstyle="bg-faded" style="margin:1px;"></a></div>
                    </div>
                    <div class="dropdown-divider m-0"></div><a href="#" class="dropdown-item js-panel-reset"><span
                            data-i18n="drpdwn.resetpanel">Reset Panel</span></a>
                </div>
            </div>
        </div>
        <div class="panel-container show" role="content">
            <div class="loader"><i class="fal fa-spinner-third fa-spin-4x fs-xxl"></i></div>
            <div class="panel-content">
                <div class="row  mb-g">
                    <div class="col-md-12 col-lg-5 mr-lg-auto">
                        <div class="d-flex mt-2 mb-1 fs-xs text-primary">
                            Current Usage
                        </div>
                        <div class="progress progress-xs mb-3">
                            <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="70"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex mt-2 mb-1 fs-xs text-info">
                            Net Usage
                        </div>
                        <div class="progress progress-xs mb-3">
                            <div class="progress-bar bg-info-500" role="progressbar" style="width: 30%;"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex mt-2 mb-1 fs-xs text-warning">
                            Users blocked
                        </div>
                        <div class="progress progress-xs mb-3">
                            <div class="progress-bar bg-warning-500" role="progressbar" style="width: 40%;"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex mt-2 mb-1 fs-xs text-danger">
                            Custom cases
                        </div>
                        <div class="progress progress-xs mb-3">
                            <div class="progress-bar bg-danger-500" role="progressbar" style="width: 15%;"
                                aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex mt-2 mb-1 fs-xs text-success">
                            Test logs
                        </div>
                        <div class="progress progress-xs mb-3">
                            <div class="progress-bar bg-success-500" role="progressbar" style="width: 25%;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex mt-2 mb-1 fs-xs text-dark">
                            Uptime records
                        </div>
                        <div class="progress progress-xs mb-3">
                            <div class="progress-bar bg-fusion-500" role="progressbar" style="width: 10%;"
                                aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
<script src="{{asset('js/statistics/chartjs/chartjs.bundle.js')}}"></script>
<script>
</script>
@endsection
