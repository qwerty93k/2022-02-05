@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Products</div>
    
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{route('product.create')}}">Create Product</a>
                        {{--RIKIAVIMAS--}}
                        <form method="GET" action={{route('product.index')}}>
                            @csrf
                            <select name="sortOrder">
                                <option value="asc" selected>Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                            <button type="submit">Sort Category</button>
                        </form>
                        {{--FILTRAS--}}
                        <form method="GET" action="{{route('product.filter')}}">
                            @csrf
                            <select name="category_id">
                            @foreach ($products as $product)
                                <option value="{{$product->category_id}}">{{$product->categoryProducts->title}}</option>
                            @endforeach
                        </select>
                        <button type="submit">Filter</button>
                        <table class="table table-striped">
                            <tr>
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->title}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->categoryProducts->title}}</td>
                                    <td><a href="{{$product->image_url}}" target="_blank"><img src="{{--/images/--}}{{$product->image_url}}" alt=" {{$product->title}}" width="50" height="50"></a></td>
                                    <td>
                                        <a class="btn btn-primary" href="{{route('product.edit', [$product])}}">Edit</a>
                                        <form method="post" action="{{route('product.destroy', [$product])}}">
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection