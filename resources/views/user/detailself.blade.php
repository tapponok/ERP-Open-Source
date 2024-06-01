@extends('layouts.master')
@section('linkrel')
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"> Profile</li>
    </ol>
    <div class="subheader">
        <h3 class="subheader-title">
            Profile
        </h3>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content text-left  mb-2 pb-2" style="color:#212529">
                        <h3>
                            Update Profile
                        </h3>
                    </div>
                    <div class="panel-content">
                        <form id="updateuser" role="form" method="POST" action="{{route('user.updateself')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="py-2 text-center mb-2 pb-2">
                                @if (Auth::user()->profile_photo_path != null)
                                <img src="{{asset('storage/profile/'.Auth::user()->profile_photo_path)}}" class="profile-image rounded-circle" alt="photo">
                                @else
                                <img src="{{ Auth::user()->getUrlfriendlyAvatar() }}" class="profile-image rounded-circle" alt="users profile">
                                @endif
                            </div>
                            <div class="form-group text-center  mb-2 pb-2" style="color:#212529">
                                <h3>
                                    {{ Auth::user()->name }}
                                    <small>
                                        {{ Auth::user()->email }}
                                    </small>
                                </h3>
                                <input type="file" name="image" class="btn btn-sm btn-outline-secondary waves-effect waves-themed" placeholder="upload image">
                                </input>@error('image')
                                <span class="text-danger">{{ $message  }}</span>
                                @enderror
                            </div>
                            <div class="panel-content">
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                                    @error('name')
                                    <span class="text-danger">{{ $message  }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                                </div>
                                @error('email')
                                <span class="text-danger">{{ $message  }}</span>
                                @enderror
                            </div>
                            <div class="panel-content">
                                <button type="submit" class="btn btn-sm btn-info waves-effect waves-themed float-right ">Save</button>
                                <div>
                                    <div class="panel-content"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content text-left  mb-2 pb-2" style="color:#212529">
                        <h3>
                            Update Password
                        </h3>
                    </div>
                    <form role="form" method="POST" action="{{route('user.uprofilepassword')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <div class="panel-content">
                            <div class="form-group">
                                <label for="curentpassword" class="form-label">Current Password</label>
                                <input type="password" name="currentpassword" class="form-control" placeholder="Enter your current password">
                                @error('currentpassword')
                                <span class="text-danger">{{ $message  }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="newpassword" class="form-label">New Password</label>
                                <input type="password" name="newpassword" class="form-control" placeholder="Enter your password">
                                @error('newpassword')
                                <span class="text-danger">{{ $message  }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="confirmpassword" class="form-label">Confirm Password</label>
                                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm your password ">
                                @error('confirmpassword')
                                <span class="text-danger">{{ $message  }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="panel-content">
                            <button type="submit" class="btn btn-sm btn-info waves-effect waves-themed float-right ">Save</button>
                            <div>
                                <div class="panel-content"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
@endsection
