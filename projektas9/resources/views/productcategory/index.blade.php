@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Product Categories</div>
                        <div class="card-body">
                        <a class="btn btn-primary" href="{{route('productcategory.create')}}">Create Category</a>
                        <form method="GET" action={{route('productcategory.index')}}>
                            @csrf
                            <select name="sortColumn">
                                <option value="id" selected>Id</option>
                                <option value="title">Title</option>
                                <option value="description">Description</option>
                            </select>
                            <select name="sortOrder">
                                <option value="asc" selected>Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                            <button type="submit">Sort Category</button>
                        </form>
                        <table class="table table-striped">
                            <tr>
                                <th>Id</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($productcategories as $productcategory)
                                <tr>
                                    <td>{{$productcategory->id}}</td>
                                    <td>{{$productcategory->title}}</td>
                                    <td>{{$productcategory->description}}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{route('productcategory.edit', [$productcategory])}}">Edit</a>
                                        <form method="post" action="{{route('productcategory.destroy', [$productcategory])}}">
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection