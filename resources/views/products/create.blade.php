@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Product Add Form') }}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('home') }}" class="btn btn-success">Dashboard</a>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="" class="form-label">Product Name</label>
                            <input type="text" name="title" id="" class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Product Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3"></textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Select SubCategory Name</label>
                            <select class="form-select @error('subcategory_id') is-invalid @enderror" name="subcategory_id" aria-label="Default select example">
                                <option selected value="0">Select a subcategory</option>

                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <label for="" class="form-label">Product Price</label>
                            <input type="number" name="price" id="" class="form-control @error('price') is-invalid @enderror" min="0">
                            
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="mb-3">
                            <label for="" class="form-label">Product Image</label>
                            <input type="file" id="thumbnail" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
                            @error('thumbnail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add New Product</button>
                        </div>
    
    
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
