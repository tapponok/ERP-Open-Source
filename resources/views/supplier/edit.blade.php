@extends('layouts.master')
@section('linkrel')
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ol>
    <div id="panel-2" class="panel">
        <div class="panel-hdr">
            <h2>
                Edit Supplier
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
            <form action="{{ route('supplier.update', $supplier->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="panel-content col-xl-12 p-3">
                    <div class="col-md-6 float-left">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" name="supplier_name" class="form-control"
                                value="{{ $supplier->supplier_name }}" placeholder="Enter Name">
                            @error('supplier_name')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" class="form-control" value="{{ $supplier->phone }}" placeholder="Enter phone">
                            @error('phone')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $supplier->email }}"
                                placeholder="Enter email">
                            @error('email')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" value="{{ $supplier->address }}" name="address"
                                placeholder="Enter address" id="" cols="30" rows="5">{{ $supplier->address }}</textarea>
                            @error('address')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="City">City</label>
                            <input type="text" name="city" class="form-control" value="{{ $supplier->city }}"
                                placeholder="Enter city">
                            @error('city')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 float-right">
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" name="province" class="form-control" value="{{ $supplier->province }}"
                                placeholder="Enter province">
                            @error('province')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="postalcode">Postal code</label>
                            <input type="number" name="postalcode" class="form-control" value="{{ $supplier->postalcode }}"
                                placeholder="Enter postal code">
                            @error('postalcode')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Photo</label>
                            <div class="custom-file">
                                <input type="file" name="image" value="{{ $supplier->image }}" class="custom-file-input"
                                    id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            @error('image')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="shop_name">Shop Name</label>
                            <input type="text" name="shop_name" class="form-control" placeholder="Enter shop name" value="{{ $supplier->shop_name }}">
                            @error('shop_name')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="account_number">Account number</label>
                            <input type="number" name="account_number" class="form-control"
                                placeholder="Enter account number" value="{{ $supplier->account_number }}">
                            @error('account_number')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bank_name">Bank Name</label>
                            <input type="text" name="bank_name" class="form-control" placeholder="Enter bank name" value="{{ $supplier->bank_name }}">
                            @error('bank_name')
                            <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 float-right p-2">
                        <div class="panel-content float-right">
                        <a class="btn btn-secondary waves-effect waves-themed"
                            href="{{route('supplier.index')}}">Back</a>
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
