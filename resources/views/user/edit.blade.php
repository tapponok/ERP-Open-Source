@extends('layouts.master')
@section('linkrel')
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ol>
    <div id="panel-2" class="panel">
        <div class="panel-hdr">
            <h2>
                Update Profile User
            </h2>
            <div class="panel-toolbar">
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                    data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                    data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip"
                    data-offset="0,10" data-original-title="Close"></button>
            </div>
        </div>
        <div class="panel-container show p-2">
            <form action="{{ route('user.update', ['user' => $user->id]) }}" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="panel-content col-xl-12 p-3">
                    <div class="col-md-6 float-left">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{$user->name}}"
                                placeholder="Enter Name">
                            @error('name')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                placeholder="Enter email">
                            @error('email')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="select Category">Garage</label>
                            <select name="garage_id" id="example-select" class="form-control">
                                @foreach($garage as $garage)
                                @if ($user->garage_id == $garage->id)
                                <option value="{{$garage->id}}" selected> {{$garage->garagename}} </option>
                                @else
                                <option value="{{$garage->id}}">{{$garage->garagename}}</option>
                                @endif
                                @endforeach
                            </select>
                            </select>
                            @error('garage')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 float-right">
                        <div class="form-group">
                            <label for="select Category">Team</label>
                            <select name="team_id" id="example-select" class="form-control">
                                @foreach($team as $team)
                                @if ($user->team_id == $team->id)
                                <option value="{{$team->id}}" selected> {{$team->name}} </option>
                                @else
                                <option value="{{$team->id}}">{{$team->name}}</option>
                                @endif
                                @endforeach
                            </select>
                            </select>
                            @error('team_id')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Profile Photo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                            @error('image')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                            <img class="mt-2" width="50" height="40"
                                src="{{ URL::asset('storage/profile/'. $user->profile_photo_path) }}"
                                alt="{{ $user->name }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 float-right p-2">
                    <div class="panel-content float-right">
                        <button type="button" class="btn btn-danger waves-effect waves-themed" value="Go back!"
                            onclick="history.back()">Back</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="panel-2" class="panel">
        <div class="panel-hdr">
            <h2>
                Update User Password
            </h2>
            <div class="panel-toolbar">
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                    data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                    data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip"
                    data-offset="0,10" data-original-title="Close"></button>
            </div>
        </div>
        <div class="panel-container show p-2">
            <form action="{{ route('user.updatepassword', ['user' => $user->id]) }}" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="panel-content col-xl-12 p-3">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                        @error('password')
                        <span class="text-danger">{{ $message  }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control"
                            placeholder="Enter password">
                        @error('confirm_password')
                        <span class="text-danger">{{ $message  }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 float-right p-2">
                    <div class="panel-content float-right">
                        <a class="btn btn-secondary waves-effect waves-themed" href="{{route('user.index')}}">Back</a>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
@section('script')
@endsection
