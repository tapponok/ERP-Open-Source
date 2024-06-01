@extends('layouts.master')
@section('linkrel')
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
        <li class="breadcrumb-item"> Edit</li>
    </ol>
    <div id="panel-2" class="panel">
        <div class="panel-hdr">
            <h2>
                Edit Product
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
            <form action="{{ route('product.update', $product->id) }}" method="POST" id="createproduct"
                enctype="multipart/form-data" id="my-awesome-dropzone">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}"
                        placeholder="Enter Name">
                    @error('product_name')
                    <span class="text-danger">{{ $message  }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Code">Code</label>
                    <input type="text" name="product_code" class="form-control" value="{{ $product->product_code }}"
                        placeholder="Enter Code">
                    @error('product_code')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Select category">Category</label>
                    <select name="category_id" id="example-select" class="form-control">
                        <option value="" disabled="" selected="">Select Category
                        </option>
                        @foreach($category as $category)
                        @if ($product->category_id == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->categ_name }}
                        </option>
                        @else
                        <option value="{{ $category->id }}">{{ $category->categ_name }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message  }}</span>
                    @enderror
                </div>
                <div class="content" id="product">
                    <div class="form-group">
                        <label for="Name">Stock Keeping Unit </label>
                        <input type="text" name="sku" class="form-control" value="{{ $product->sku }}"
                            placeholder="Enter SKU">
                        @error('sku')
                        <span class="text-danger">{{ $message  }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select name="unit_id" class="form-control">
                            <option value="" disabled selected>Select Unit</option>
                            @foreach ($unit as $unit)
                            @if ($product->unit_id == $unit->id)
                            <option value="{{ $unit->id }}" selected>{{ $unit->unit_name }}</option>
                            @else
                            <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('unit_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="minimum_stock">Minimum Stock</label>
                        <input type="number" name="minimum_stock" class="form-control"
                            value="{{ $product->minimum_stock }}" placeholder="Enter minimum Stock">
                    </div>
                    <div class="form-group">
                        <label for="selling_price">Selling Price</label>
                        <input type="number" name="selling_price" class="form-control"
                            value="{{ $product->selling_price }}" placeholder="Enter selling price">
                        @error('selling_price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Photo</label>
                        <div class="custom-file">
                            <input type="file" name="image" value="{{ old('image') }}" class="custom-file-input"
                                id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            @if ($product->product_photo != null)
                            <img src="{{asset('storage/product/'.$product->product_photo)}}"
                                style="height:35px; width: 35px;">
                            @else
                            <img src="{{ $product->getUrlfriendlyAvatar() }}">
                            @endif
                            <div class="info-card-text">
                                <a href="#" class="d-flex align-items-center text-white">
                                    {{ Auth::user()->name }}
                                </a>
                            </div>
                        </div>
                        @error('image')
                        <span class="text-danger">{{ $message  }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 float-right">
                    <div class="panel-content float-right">
                        <a class="btn btn-secondary waves-effect waves-themed" href="{{route('product.index')}}">Back</a>
                        <button type="submit" id="submitcreate" class="btn btn-warning">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
@section('script')
@endsection
