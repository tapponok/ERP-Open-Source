@extends('layouts.master')
@section('linkrel')
<link rel="stylesheet" media="screen, print" href="{{asset('css/notifications/toastr/toastr.css')}}">
@endsection
@section('content')
<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        User Detail
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
                                                        <strong>Name</strong>
                                                    </td>
                                                    <td>
                                                        {{ $user->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Team</strong>
                                                    </td>
                                                    @if( $user->team_id == null)
                                                    <td>
                                                        <p>empty</p>
                                                    </td>
                                                    @else
                                                    <td>
                                                        {{ $user->team->name }}
                                                    </td>
                                                    @endif
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
                                                        <strong>Email</strong>
                                                    </td>
                                                    <td>
                                                        {{ $user->email }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Photo</strong>
                                                    </td>
                                                    <td>
                                                        @if ($user->profile_photo_path != null)
                                                        <img src="{{asset('storage/user/'.$user->profile_photo_path)}}"
                                                            class="profile-image-md" alt="photo">
                                                        @else
                                                        <img src="{{ $user->getUrlfriendlyAvatar() }}"
                                                            class="profile-image-md rounded-circle" alt="users profile">
                                                        @endif
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
                                        href="{{route('user.index')}}"><span
                                            class="fal fa-chevron-left mr-1"></span>Back</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
@endsection
