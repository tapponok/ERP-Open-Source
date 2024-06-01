@extends('layouts.first')
@section('content')
<div class="flex-1"
    style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
        <div class="row">
            <div class="col col-md-6 col-lg-7 hidden-sm-down">
                <h2 class="fs-xxl fw-500 mt-4 text-white">
                    WMS &amp; MiniErp
                    <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.
                    </small>
                </h2>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
                <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
                    Secure login
                </h1>
                <div class="card p-4 rounded-plus bg-faded">
                <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                placeholder="Enter email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                placeholder="Enter password" value=""  required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group text-left">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember" id="rememberme">
                                <label class="custom-control-label" for="rememberme">{{ __('Remember me') }}</label>
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-lg-12 pl-lg-1 my-2">
                                <button id="js-login-btn" type="submit" class="btn btn-danger btn-block btn-lg">Secure
                                    login</button>
                                <a class="help-block" href="">
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
            Warehouse Management System &nbsp;<a href='/login' class='text-white opacity-40 fw-500'></a>
        </div>
    </div>
</div>
@endsection