@extends('layouts.first')
@section('content')
<div class="flex-1"
    style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
        <div class="row">
            <div class="col-xl-12">
                <h2 class="fs-xxl fw-500 mt-4 text-white text-center">
                    Register now!
                    <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60 hidden-sm-down">
                        To register your accoount please fullfiled form below!
                    </small>
                </h2>
            </div>
            <div class="col-xl-6 ml-auto mr-auto">
                <div class="card p-4 rounded-plus bg-faded">
                    <form id="js-login" novalidate="" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="fname">Name</label>
                            <input id="name" type="text" placeholder="Enter name"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="emailverify">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="Enter mail" required
                                autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="userpassword">Pick a password: <br>Don't reuse
                                your bank password, we didn't spend a lot on security for this app.</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Enter password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="userpassword">Re-enter your password</label>
                            <input type="password" name="password_confirmation" id="userpassword" class="form-control"
                                placeholder="minimm 8 characters" required>
                            <div class="invalid-feedback">Sorry, you missed this one.</div>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-md-4 ml-auto text-right">
                                <button type="submit" class="btn btn-block btn-danger btn-lg mt-3">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
        Warehouse Management System &nbsp;<a href='/login' class='text-white opacity-40 fw-500'></a>
    </div>
</div>
@endsection
