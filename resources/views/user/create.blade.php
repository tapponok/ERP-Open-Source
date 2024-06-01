@extends('layouts.master')
@section('linkrel')
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
        <li class="breadcrumb-item">Create</li>
    </ol>
    <div id="panel-2" class="panel">
        <div class="panel-hdr">
            <h2>
                Create User
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
            <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel-content col-xl-12 p-3">
                    <div class="col-md-6 float-left">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                placeholder="Enter Name">
                            @error('name')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Select team">Team</label>
                            <select name="team_id" id="example-select" class="form-control">
                                <option value="" disabled="" selected="">Select a Type
                                </option>
                                @foreach($team as $team)
                                @if (old('team_id') == $team->id)
                                <option value="{{ $team->id }}" selected>{{ $team->name }}</option>
                                @else
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('team_id')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Select team">Garage</label>
                            <select name="garage_id" id="example-select" class="form-control">
                                <option value="" disabled="" selected="">Select a Type
                                </option>
                                @foreach($garage as $garage)
                                @if (old('garage_id') == $garage->id)
                                <option value="{{ $garage->id }}" selected>{{ $garage->garagename }}</option>
                                @else
                                <option value="{{ $garage->id }}">{{ $garage->garagename }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('garage_id')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                placeholder="Enter email">
                            @error('email')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 float-right">
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
                        <div class="form-group">
                            <label class="form-label">Profile Photo</label>
                            <div class="custom-file">
                                <input type="file" name="image" value="{{ old('image') }}" class="custom-file-input"
                                    id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            @error('image')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 float-right p-2">
                        <div class="panel-content float-right">
                        <a class="btn btn-secondary waves-effect waves-themed"
                            href="{{route('user.index')}}">Back</a>
                            <button type="submit" class="btn btn-info">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
@section('script')
@endsection
