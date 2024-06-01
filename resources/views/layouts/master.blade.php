<!DOCTYPE html>
<!--
Template Name:  SmartAdmin Responsive WebApp - Template build with Twitter Bootstrap 4
Version: 4.0.2
Author: Sunnyat Ahmmed
Website: http://gootbootstrap.com
Purchase: https://wrapbootstrap.com/theme/smartadmin-responsive-webapp-WB0573SK0
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Warehouse management system
    </title>
    <meta name="description" content="Basic">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="{{asset('css/vendors.bundle.css')}}">
    <link rel="stylesheet" media="screen, print" href="{{asset('css/app.bundle.css')}}">
    <link rel="stylesheet" media="screen, print" href="{{asset('css/themes/cust-theme-3.css')}}">
    <!-- Place favicon.ico in the root directory -->
    <link rel="jwms" sizes="180x180" href="{{asset('/img/logo.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/img/logo.png')}}">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5')}}">
    <link rel="stylesheet" media="screen, print" href="{{asset('css/datagrid/datatables/datatables.bundle.css')}}">
    <link rel="stylesheet" media="screen, print" href="{{asset('css/notifications/toastr/toastr.css')}}">
    @yield('linkrel')
</head>

<body class="mod-bg-1 ">
    <!-- DOC: script to save and load page settings -->
    <script>
        /**
         *	This script should be placed right after the body tag for fast execution
         *	Note: the script is written in pure javascript and does not depend on thirdparty library
         **/
        'use strict';

        var classHolder = document.getElementsByTagName("BODY")[0],
            /**
             * Load from localstorage
             **/
            themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem(
                'themeSettings')) : {},
            themeURL = themeSettings.themeURL || '',
            themeOptions = themeSettings.themeOptions || '';
        /**
         * Load theme options
         **/
        if (themeSettings.themeOptions) {
            classHolder.className = themeSettings.themeOptions;
            console.log("%c✔ Theme settings loaded", "color: #148f32");
        } else {
            console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
        }
        if (themeSettings.themeURL && !document.getElementById('mytheme')) {
            var cssfile = document.createElement('link');
            cssfile.id = 'mytheme';
            cssfile.rel = 'stylesheet';
            cssfile.href = themeURL;
            document.getElementsByTagName('head')[0].appendChild(cssfile);
        }
        /**
         * Save to localstorage
         **/
        var saveSettings = function() {
            themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item) {
                return /^(nav|header|mod|display)-/i.test(item);
            }).join(' ');
            if (document.getElementById('mytheme')) {
                themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
            };
            localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
        }
        /**
         * Reset settings
         **/
        var resetSettings = function() {
            localStorage.setItem("themeSettings", "");
        }
    </script>
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <!-- BEGIN Left Aside -->
            <aside class="page-sidebar">
                <div class="page-logo" style="padding: 1rem;">
                    <a href="{{ route('home') }}" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                        <img src="{{asset('/img/logo.png')}}" alt="SmartAdmin WebApp" aria-roledescription="logo">
                        <span class="page-logo-text mr-1" style="font-size: 0.8rem;">Warehouse Management System</span>
                        <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                    </a>
                </div>
                <!-- BEGIN PRIMARY NAVIGATION  -->
                <nav id="js-primary-nav" class="primary-nav" role="navigation">
                    <div class="nav-filter">
                        <div class="position-relative">
                            <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                            <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                <i class="fal fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="info-card">
                        @if (Auth::user()->profile_photo_path != null)
                        <img src="{{asset('storage/profile/'.Auth::user()->profile_photo_path)}}" class="profile-image rounded-circle" alt="photo">
                        @else
                        <img src="{{ Auth::user()->getUrlfriendlyAvatar() }}" class="profile-image rounded-circle" alt="users profile">
                        @endif
                        <div class="info-card-text">
                            <a href="#" class="d-flex align-items-center text-white">
                                {{ Auth::user()->name }}
                            </a>
                        </div>
                        <img src="{{asset('img/card-backgrounds/cover-2-lg.png')}}" class="cover" alt="cover">
                        <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                            <i class="fal fa-angle-down"></i>
                        </a>
                    </div>
                    <ul id="js-nav-menu" class="nav-menu">
                        <li class="{{ (request()->is('home*')) ? 'active' : '' }}">
                            <a href="/home" title="Dashboard" data-filter-tags="application intel">
                                <i class="fal fa-chart-pie"></i>
                                <span class="nav-link-text" data-i18n="nav.application_intel">Dashboard</span>
                            </a>
                        </li>
                        @canany(['indexgroupproduct', 'indexcategory', 'indexunit', 'indexunit', 'indexsupplier'])
                        <li class="{{ (request()->is('groupproduct*','category*','unit*','supplier*', 'garage*')) ? 'active open' : '' }}">
                            <a href="#" title="Master Data" data-filter-tags="application intel">
                                <i class="fal fa-database"></i>
                                <span class="nav-link-text" data-i18n="nav.application_intel">Master data</span>
                            </a>
                            <ul>
                                @can('indexgroupproduct')
                                <li class="{{ (request()->is('groupproduct*')) ? 'active' : '' }}">
                                    <a href="{{ route('groupproduct.index') }}" title="group product" data-filter-tags="group product">
                                        <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">Group product</span>
                                    </a>
                                </li>
                                @endcan
                                @can('indexcategory')
                                <li class="{{ (request()->is('category*')) ? 'active' : '' }}">
                                    <a href="{{ route('category.index') }}" title="category" data-filter-tags="application intel analytics dashboard">
                                        <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">Category</span>
                                    </a>
                                </li>
                                @endcan
                                @can('indexunit')
                                <li class="{{ (request()->is('unit*')) ? 'active' : '' }}">
                                    <a href="{{ route('unit.index') }}" title="unit" data-filter-tags="application intel analytics dashboard">
                                        <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">Unit</span>
                                    </a>
                                </li>
                                @endcan
                                @can('indexgarage')
                                <li class="{{ (request()->is('garage*')) ? 'active' : '' }}">
                                    <a href="{{ route('garage.index') }}" title="Garage" data-filter-tags="application intel">
                                        <span class="nav-link-tect" data-i18n="nav.application_intel">Garage</span>
                                    </a>
                                </li>
                                @endcan
                                @can('indexsupplier')
                                <li class="{{ (request()->is('supplier*')) ? 'active' : '' }}">
                                    <a href="{{ route('supplier.index') }}" title="Supplier" data-filter-tags="application intel">
                                        <span class="nav-link-tect" data-i18n="nav.application_intel">Supplier</span>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcan
                        @canany(['indexuser', 'indexrolepermission'])
                        <li class="{{ (request()->is('user*','team*', 'permissions*', 'roles*')) ? 'active open' : '' }}">
                            <a href="#" title="user management" data-filter-tags="application intel">
                                <i class="fal fa-user"></i>
                                <span class="nav-link-text" data-i18n="nav.application_intel">User Management</span>
                            </a>
                            <ul>
                                @can('indexuser')
                                <li class="{{ (request()->is('user*')) ? 'active' : '' }}">
                                    <a href="{{ route('user.index') }}" title="User" data-filter-tags="application intel">
                                        <span class="nav-link-text" data-i18n="nav.application_intel">User</span>
                                    </a>
                                </li>
                                @endcan
                                @can('indexrolepermission')
                                <li class="{{ (request()->is('roles*')) ? 'active' : '' }}">
                                    <a href="{{ route('roles.index') }}" title="roles" data-filter-tags="application intel">
                                        <span class="nav-link-text" data-i18n="nav.application_intel">Roles & permissions</span>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcan
                        @canany(['indexproduct', 'stockproduct','stocklogs', 'indexstockopname'])
                        <li class="{{ (request()->is('product*','stockitem*', 'stockopname*')) ? 'active open' : '' }}">
                            <a href="#" title="Product" data-filter-tags="application intel">
                                <i class="fal fa-shopping-bag"></i>
                                <span class="nav-link-text" data-i18n="nav.application_intel">Product</span>
                            </a>
                            <ul>
                                @can('indexproduct')
                                <li class="{{ (request()->is('product*')) ? 'active' : '' }}">
                                    <a href="{{ route('product.index') }}" title="Product" data-filter-tags="application intel">
                                        <span class="nav-link-text" data-i18n="nav.application_intel">Data
                                            product</span>
                                    </a>
                                </li>
                                @endcan
                                @can('stockproduct')
                                <li class="{{ (\Request::route()->getName() == 'stockitem.index') ? 'active' : '' }}">
                                    <a href="{{ route('stockitem.index') }}" title="Product" data-filter-tags="application intel">
                                        <span class="nav-link-text" data-i18n="nav.application_intel">Stock
                                            product</span>
                                    </a>
                                </li>
                                @endcan
                                @can('stocklogs')
                                <li class="{{ (\Request::route()->getName() == 'stockitem.stocklogs') ? 'active' : '' }}">
                                    <a href="{{ route('stockitem.stocklogs') }}" title="stocklogs" data-filter-tags="application intel">
                                        <span class="nav-link-text" data-i18n="nav.application_intel">Stock logs</span>
                                    </a>
                                </li>
                                @endcan
                                @can('indexstockopname')
                                <li class="{{ (request()->is('stockopname*')) ? 'active' : '' }}">
                                    <a href="{{ route('stockopname.index') }}" title="stockopname" data-filter-tags="application intel">
                                        <span class="nav-link-text" data-i18n="nav.application_intel">Stock
                                            Opname</span>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcan
                        @canany((['indexpurchaseorder', 'indexpurchaseinvoice']))
                        <li class="{{ (request()->is('purchaseorder*','purchaseinvoice*')) ? 'active open' : '' }}">
                            <a href="#" title="Purchase" data-filter-tags="application intel">
                                <i class="fal fa-truck"></i>
                                <span class="nav-link-text" data-i18n="nav.application_intel">Purchase</span>
                            </a>
                            <ul>
                                @can('indexpurchaseorder')
                                <li class="{{ (request()->is('purchaseorder*')) ? 'active' : '' }}">
                                    <a href="{{ route('purchaseorder.index') }}" title="purchase order">
                                        <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">Purchase order</span>
                                    </a>
                                </li>
                                @endcan
                                @can('indexpurchaseinvoice')
                                <li class="{{ (request()->is('purchaseinvoice*')) ? 'active' : '' }}">
                                    <a href="{{ route('purchaseinvoice.index') }}" title="purchase invoice">
                                        <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">Purchase
                                            invoice</span>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcan
                        @can('indexreceiveorder')
                        <li class="{{ (request()->is('receiveorder*')) ? 'active' : '' }}">
                            <a href="{{ route('receiveorder.index') }}" title="receiveoder" data-filter-tags="application intel">
                                <i class="fal fa-check-circle"></i>
                                <span class="nav-link-text" data-i18n="nav.application_intel">Receive order</span>
                            </a>
                        </li>
                        @endcan
                        <li class="{{ (request()->is('payment*')) ? 'active' : '' }}">
                            <a href="{{ route('payment.index') }}" title="payment" data-filter-tags="application intel">
                                <i class="fal fa-credit-card"></i>
                                <span class="nav-link-text" data-i18n="nav.application_intel">Payment</span>
                            </a>
                        </li>
                        <li class="{{ (request()->is('partnership*')) ? 'active' : '' }}">
                            <a href="{{ route('partnership.index') }}" title="partnership" data-filter-tags="application intel">
                                <i class="fal fa-handshake"></i>
                                <span class="nav-link-text" data-i18n="nav.application_intel">Partnership</span>
                            </a>
                        </li>
                        @canany('indexsalesorder', 'indexsalesinvoice')
                        <li class="{{ (request()->is('salesorder*', 'salesinvoice*')) ? 'active open' : '' }}">
                            <a href="#" title="sales order" data-filter-tags="application intel">
                                <i class="fal fa-list-alt"></i>
                                <span class="nav-link-text" data-i18n="nav.application_intel">Sales</span>
                            </a>
                            <ul>
                                <li class="{{ (request()->is('salesorder*')) ? 'active' : '' }}">
                                    <a href="{{ route('salesorder.index') }}" title="sales order">
                                        <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">Sales order</span>
                                    </a>
                                </li>
                                <li class="{{ (request()->is('salesinvoice*')) ? 'active' : '' }}">
                                    <a href="{{ route('salesinvoice.index') }}" title="sales invoice">
                                        <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">Sales invoice</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                    </ul>
                    <div class="filter-message js-filter-message bg-success-600"></div>
                </nav>
                <!-- END PRIMARY NAVIGATION -->
            </aside>
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <header class="page-header" role="banner">
                    <!-- we need this logo when user switches to nav-function-top -->
                    <div class="page-logo">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                            <img src="{{asset('/img/logo.png')}}" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            <span class="page-logo-text mr-1">Ware</span>
                            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                        </a>
                    </div>
                    <!-- DOC: nav menu layout change shortcut -->
                    <div class="hidden-md-down dropdown-icon-menu position-relative">
                        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                            <i class="ni ni-menu"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                                    <i class="ni ni-minify-nav"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                                    <i class="ni ni-lock-nav"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- DOC: mobile button appears during mobile width -->
                    <div class="hidden-lg-up">
                        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                            <i class="ni ni-menu"></i>
                        </a>
                    </div>
                    <div class="search">
                        <form class="app-forms hidden-xs-down" role="search" action="page_search.html" autocomplete="off">
                            <input type="text" id="search-field" placeholder="Search for anything" class="form-control" tabindex="1">
                            <a href="#" onclick="return false;" class="btn-danger btn-search-close js-waves-off d-none" data-action="toggle" data-class="mobile-search-on">
                                <i class="fal fa-times"></i>
                            </a>
                        </form>
                    </div>
                    <div>
                        <a href="#" class="header-icon" data-toggle="dropdown" title="You got 11 notifications">
                            <i class="fal fa-bell"></i>
                            <span class="badge badge-icon">11</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-xl">
                            <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">
                                <h4 class="m-0 text-center color-white">
                                    11 New
                                    <small class="mb-0 opacity-80">User Notifications</small>
                                </h4>
                            </div>
                            <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-messages" data-i18n="drpdwn.messages">Messages</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-notification">
                                <div class="tab-pane active p-3 text-center">
                                    <h5 class="mt-4 pt-4 fw-500">
                                        <span class="d-block fa-3x pb-4 text-muted">
                                            <i class="ni ni-arrow-up text-gradient opacity-70"></i>
                                        </span> Select a tab above to activate
                                        <small class="mt-3 fs-b fw-400 text-muted">
                                            This blank page message helps protect your privacy, or you can show the
                                            first message here automatically through
                                            <a href="#">settings page</a>
                                        </small>
                                    </h5>
                                </div>
                                <div class="tab-pane" id="tab-messages" role="tabpanel">
                                    <div class="custom-scroll h-100">
                                        <ul class="notification">
                                            <li class="unread">
                                                <a href="#" class="d-flex align-items-center">
                                                    <span class="status mr-2">
                                                        <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-c.png')"></span>
                                                    </span>
                                                    <span class="d-flex flex-column flex-1 ml-1">
                                                        <span class="name">Melissa Ayre <span class="badge badge-primary fw-n position-absolute pos-top pos-right mt-1">INBOX</span></span>
                                                        <span class="msg-a fs-sm">Re: New security codes</span>
                                                        <span class="msg-b fs-xs">Hello again and thanks for being
                                                            part...</span>
                                                        <span class="fs-nano text-muted mt-1">56 seconds ago</span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="unread">
                                                <a href="#" class="d-flex align-items-center">
                                                    <span class="status mr-2">
                                                        <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-a.png')"></span>
                                                    </span>
                                                    <span class="d-flex flex-column flex-1 ml-1">
                                                        <span class="name">Adison Lee</span>
                                                        <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                        <span class="fs-nano text-muted mt-1">2 minutes ago</span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="d-flex align-items-center">
                                                    <span class="status status-success mr-2">
                                                        <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-b.png')"></span>
                                                    </span>
                                                    <span class="d-flex flex-column flex-1 ml-1">
                                                        <span class="name">Oliver Kopyuv</span>
                                                        <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                        <span class="fs-nano text-muted mt-1">3 days ago</span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="d-flex align-items-center">
                                                    <span class="status status-warning mr-2">
                                                        <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-e.png')"></span>
                                                    </span>
                                                    <span class="d-flex flex-column flex-1 ml-1">
                                                        <span class="name">Dr. John Cook PhD</span>
                                                        <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                        <span class="fs-nano text-muted mt-1">2 weeks ago</span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="d-flex align-items-center">
                                                    <span class="status status-success mr-2">
                                                        <!-- <img src="img/demo/avatars/avatar-m.png" data-src="img/demo/avatars/avatar-h.png" class="profile-image rounded-circle" alt="Sarah McBrook" /> -->
                                                        <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-h.png')"></span>
                                                    </span>
                                                    <span class="d-flex flex-column flex-1 ml-1">
                                                        <span class="name">Sarah McBrook</span>
                                                        <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                        <span class="fs-nano text-muted mt-1">3 weeks ago</span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="d-flex align-items-center">
                                                    <span class="status status-success mr-2">
                                                        <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-m.png')"></span>
                                                    </span>
                                                    <span class="d-flex flex-column flex-1 ml-1">
                                                        <span class="name">Anothony Bezyeth</span>
                                                        <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                        <span class="fs-nano text-muted mt-1">one month ago</span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="d-flex align-items-center">
                                                    <span class="status status-danger mr-2">
                                                        <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-j.png')"></span>
                                                    </span>
                                                    <span class="d-flex flex-column flex-1 ml-1">
                                                        <span class="name">Lisa Hatchensen</span>
                                                        <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                        <span class="fs-nano text-muted mt-1">one year ago</span>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2 px-3 bg-faded d-block rounded-bottom text-right border-faded border-bottom-0 border-right-0 border-left-0">
                                <a href="#" class="fs-xs fw-500 ml-auto">view all notifications</a>
                            </div>
                        </div>
                    </div>
                    <div class="ml-auto d-flex">
                        <!-- activate app search icon (mobile) -->
                        <!-- app message -->
                        <!-- app notification -->
                        <!-- app user menu -->
                        <div>
                            <a href="#" data-toggle="dropdown" title="user profile" class="header-icon d-flex align-items-center justify-content-center ml-2">
                                @if (Auth::user()->profile_photo_path != null)
                                <img src="{{asset('storage/profile/'.Auth::user()->profile_photo_path)}}" class="profile-image rounded-circle" alt="photo">
                                @else
                                <img src="{{ Auth::user()->getUrlfriendlyAvatar() }}" class="profile-image rounded-circle" alt="users profile">
                                @endif

                                <!-- you can also add username next to the avatar with the codes below:
									<span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
									<i class="ni ni-chevron-down hidden-xs-down"></i> -->
                            </a>

                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                        <span class="mr-2">
                                            @if (Auth::user()->profile_photo_path != null)
                                            <img src="{{asset('storage/profile/'.Auth::user()->profile_photo_path)}}" class="profile-image rounded-circle" alt="photo">
                                            @else
                                            <img src="{{ Auth::user()->getUrlfriendlyAvatar() }}" class="profile-image rounded-circle" alt="users profile">
                                            @endif
                                            <div class="info-card-text">
                                            </div>
                                        </span>
                                        <div class="info-card-text">
                                            <a href="#" class="d-flex align-items-center text-white">
                                                {{ Auth::user()->name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item" href="{{ route('user.detailself') }}">Profile</a>
                                <a class="dropdown-item" href="">API Tokens</a>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Logout
                                    <span data-i18n="drpdwn.page-logout"></span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </div>
                    </div>
                </header>
                @yield('content')
                <!-- BEGIN Page Footer -->
                <footer class="page-footer" role="contentinfo">
                    <div class="d-flex align-items-center flex-1 text-muted">
                        <span class="hidden-md-down fw-700">2020 © Warehouse management system by&nbsp;<a href='' class='text-primary fw-500' title='Jwms' target='_blank'>Jwms</a></span>
                    </div>
                    <div>
                        <ul class="list-table m-0">
                            <li class="pl-3 fs-xl"><a href="https://wrapbootstrap.com/user/MyOrange" class="text-secondary" target="_blank"><i class="fal fa-question-circle" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </footer>
                <!-- we use this only for CSS color refernce for JS stuff -->
                <p id="js-color-profile" class="d-none">
                    <span class="color-primary-50"></span>
                    <span class="color-primary-100"></span>
                    <span class="color-primary-200"></span>
                    <span class="color-primary-300"></span>
                    <span class="color-primary-400"></span>
                    <span class="color-primary-500"></span>
                    <span class="color-primary-600"></span>
                    <span class="color-primary-700"></span>
                    <span class="color-primary-800"></span>
                    <span class="color-primary-900"></span>
                    <span class="color-info-50"></span>
                    <span class="color-info-100"></span>
                    <span class="color-info-200"></span>
                    <span class="color-info-300"></span>
                    <span class="color-info-400"></span>
                    <span class="color-info-500"></span>
                    <span class="color-info-600"></span>
                    <span class="color-info-700"></span>
                    <span class="color-info-800"></span>
                    <span class="color-info-900"></span>
                    <span class="color-danger-50"></span>
                    <span class="color-danger-100"></span>
                    <span class="color-danger-200"></span>
                    <span class="color-danger-300"></span>
                    <span class="color-danger-400"></span>
                    <span class="color-danger-500"></span>
                    <span class="color-danger-600"></span>
                    <span class="color-danger-700"></span>
                    <span class="color-danger-800"></span>
                    <span class="color-danger-900"></span>
                    <span class="color-warning-50"></span>
                    <span class="color-warning-100"></span>
                    <span class="color-warning-200"></span>
                    <span class="color-warning-300"></span>
                    <span class="color-warning-400"></span>
                    <span class="color-warning-500"></span>
                    <span class="color-warning-600"></span>
                    <span class="color-warning-700"></span>
                    <span class="color-warning-800"></span>
                    <span class="color-warning-900"></span>
                    <span class="color-success-50"></span>
                    <span class="color-success-100"></span>
                    <span class="color-success-200"></span>
                    <span class="color-success-300"></span>
                    <span class="color-success-400"></span>
                    <span class="color-success-500"></span>
                    <span class="color-success-600"></span>
                    <span class="color-success-700"></span>
                    <span class="color-success-800"></span>
                    <span class="color-success-900"></span>
                    <span class="color-fusion-50"></span>
                    <span class="color-fusion-100"></span>
                    <span class="color-fusion-200"></span>
                    <span class="color-fusion-300"></span>
                    <span class="color-fusion-400"></span>
                    <span class="color-fusion-500"></span>
                    <span class="color-fusion-600"></span>
                    <span class="color-fusion-700"></span>
                    <span class="color-fusion-800"></span>
                    <span class="color-fusion-900"></span>
                </p>
                <!-- END Color profile -->
            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->
    <!-- BEGIN Messenger -->
    <!-- END Messenger -->
    <!-- BEGIN Page Settings -->
    <script src="{{asset('js/vendors.bundle.js')}}"></script>
    <script src="{{asset('js/app.bundle.js')}}"></script>
    <script src="{{asset('js/notifications/toastr/toastr.js')}}"></script>
    <script src="{{asset('js/datagrid/datatables/datatables.bundle.js')}}"></script>
    <!-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script> -->
    @if(session('succes'))
    <script type="text/javascript">
        $(document).ready(function() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 100,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["success"]("{{ session('succes') }}")
        });
    </script>
    @endif
    @if(session('fail'))
    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 100,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        })
        toastr["error"]("{{session('fail')}}");
    </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#dt-basic-example').dataTable({
                responsive: true
            });
            $('.js-thead-colors a').on('click', function() {
                var theadColor = $(this).attr("data-bg");
                console.log(theadColor);
                $('#dt-basic-example thead').removeClassPrefix('bg-').addClass(theadColor);
            });
            $('.js-tbody-colors a').on('click', function() {
                var theadColor = $(this).attr("data-bg");
                console.log(theadColor);
                $('#dt-basic-example').removeClassPrefix('bg-').addClass(theadColor);
            });
        });
    </script>
    @yield('script')
</body>

</html>
