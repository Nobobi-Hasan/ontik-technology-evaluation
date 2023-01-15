@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    {{ __('Products') }}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('create') }}" class="btn btn-success">Add New Product</a>
                    </div>
                </div>


                <div class="px-3 pt-2">

                    <form action="" >
                        <div class="row">
                            <div class="col">
                                <select class="form-select" name="category_id" aria-label="Default select example">
                                    <option selected value="-1">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <select class="form-select" name="subcategory_id" aria-label="Default select example">
                                    <option selected value="-1">Select Subcategory</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <input type="number" name="price_l" id="" class="form-control" min="0" placeholder="Price From">
                            </div>

                            <div class="col order-1">
                                <div class="col order-1">
                                    <input type="number" name="price_h" id="" class="form-control" min="0" placeholder="Max Price">
                                </div>
                            </div>

                            <div class="col order-1">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                
                </div>


                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive my-2">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Description</th>
                                <th scope="col">Subcategory Name</th>
                                <th scope="col">Price (BDT)</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td class="w-35"><img src="{{ url('/uploads/product-image') }}/{{ $product->thumbnail }}" alt="" class="img-fluid rounded w-25 h-25"></td>
                                        {{-- <td>{{ asset('uploads/product_image') }}/{{ $product->thumbnail }}</td> --}}
                                        <td>{!! $product->description !!}</td>
                                        <td>{{ $product->subcategory->title }}</td>
                                        <td>{{ $product->price }}</td>
                                        
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Delete
                                                </button>
                                                <ul class="dropdown-menu">
                                                <li>
                                                    <form action="{{ route('destroy', $product->id) }}" method="post">
                                                        @csrf
                                                        <button class="dropdown-item show_confirm" type="submit"><i class="fas fa-trash"></i> Delete</a></button>
                                                    </form>
                                                </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
