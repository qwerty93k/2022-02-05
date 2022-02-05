@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Product</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data"> {{-- bet koki faila uzkoduoja kaip teksta--}}
                            @csrf
    
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Product Name</label>
    
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" required autofocus>
    
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>
    
                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control" name="description" required autofocus>
    
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">Price</label>
    
                                <div class="col-md-6">
                                    <input id="price" type="number" class="form-control" name="price" required autofocus>
    
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category_id" class="col-md-4 col-form-label text-md-end">Category</label>
    
                                <div class="col-md-6">
                                    <select name="category_id" class="form-control">
                                        @foreach ($select_values as $productcategory)
                                            <option value="{{$productcategory->id}}">{{$productcategory->title}}</option>                    
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image_url" class="col-md-4 col-form-label text-md-end">Image</label>
    
                                <div class="col-md-6">
                                    <input id="image_url" type="file" class="form-control" name="image_url" required autofocus>
    
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                    <a class="btn btn-secondary" href="{{route('product.index')}}">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection