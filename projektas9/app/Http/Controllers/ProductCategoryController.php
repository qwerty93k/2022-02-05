<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortColumn = $request->sortColumn; // Column
        $sortOrder = $request->sortOrder; // ASC/DESC

        $productcategory = ProductCategory::orderBy($sortColumn, $sortOrder)->get();;

        return view('productcategory.index', ['productcategories' => $productcategory, 'sortColumn' => $sortColumn, 'sortOrder' => $sortOrder]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productcategory = new ProductCategory;

        $productcategory->title = $request->title;
        $productcategory->description = $request->description;

        $productcategory->save();

        return redirect()->route('productcategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productcategory)
    {
        return view('productcategory.edit', ['productcategory' => $productcategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductCategoryRequest  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productcategory)
    {
        $productcategory->title = $request->title;
        $productcategory->description = $request->description;

        $productcategory->save();

        return redirect()->route('productcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productcategory)
    {
        $productcategory->delete();
        return redirect()->route('productcategory.index');
    }
}
