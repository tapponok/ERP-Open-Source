@extends('layouts.master')
@section('linkrel')
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('partnership.index') }}">Partnership</a></li>
        <li class="breadcrumb-item"> Update</li>
    </ol>
    <div id="panel-2" class="panel">
        <div class="panel-hdr">
            <h2>
                Update Partnership
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
        <div class="panel-container show p-3">
            <form action="{{ route('partnership.update', $partnership->id) }}" method="POST" id="updatepartnership"
                enctype="multipart/form-data" id="my-awesome-dropzone">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $partnership->name }}"
                        placeholder="Enter Name">
                    @error('name')
                    <span class="text-danger">{{ $message  }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $partnership->email }}"
                        placeholder="Enter email">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Phone">Phone</label>
                    <input type="number" name="phone" class="form-control" value="{{ $partnership->phone }}"
                        placeholder="Enter phone">
                    @error('phone')
                    <span class="text-danger">{{ $message  }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="address">Address</label>
                    <textarea class="form-control" name="address" rows="2">{{ $partnership->address }}</textarea>
                    @error('address')
                    <span class="text-danger">{{ $message  }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="City">City</label>
                    <input type="text" name="city" class="form-control" value="{{ $partnership->city }}"
                        placeholder="Enter city">
                    @error('city')
                    <span class="text-danger">{{ $message  }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="province">Province</label>
                    <input type="text" name="province" class="form-control" value="{{ $partnership->province }}"
                        placeholder="Enter province">
                    @error('province')
                    <span class="text-danger">{{ $message  }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="postalcode">Postal code</label>
                    <input type="number" name="postalcode" class="form-control" value="{{ $partnership->postalcode }}"
                        placeholder="Enter postal code">
                    @error('postalcode')
                    <span class="text-danger">{{ $message  }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="bankname">Bank Name</label>
                    <input type="text" name="bankname" class="form-control" value="{{ $partnership->bankname }}"
                        placeholder="Enter bank name">
                    @error('bankname')
                    <span class="text-danger">{{ $message  }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="bankaccount">Bank Account Number</label>
                    <input type="number" name="bankaccount" class="form-control" value="{{ $partnership->bankaccount }}"
                        placeholder="Enter bank account number">
                    @error('bankaccount')
                    <span class="text-danger">{{ $message  }}</span>
                    @enderror
                </div>
                <div class="col-md-12 float-right">
                    <div class="panel-content float-right">
                        <a class="btn btn-warning waves-effect waves-themed" href="{{route('product.index')}}">Back</a>
                        <button type="submit" id="submitcreate" class="btn btn-info">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
@section('script')
<script type="text/javascript">
    $('form').submit(function () {
        $(this).find(':submit').attr('disabled', 'disabled');
    });

</script>
@endsection
