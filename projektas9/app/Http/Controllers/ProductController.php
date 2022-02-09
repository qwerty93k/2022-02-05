<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortColumn = 'category_id';
        $sortOrder = $request->sortOrder; // ASC/DESC

        $product_title = Product::all();
        $category = array_keys($product_title->first()->getAttributes());

        if (empty($sortOrder) and empty($sortColumn)) {
            $product = Product::all();
        } else {
            //isrikiuoja kategorijas pagal varda, ne pagal id
            if (isset($sortColumn)) {
                $sortBool = true;
                if ($sortOrder == "asc") {
                    $sortBool = false;
                }

                $product = Product::get()->sortBy(function ($query) {
                    return $query->categoryProducts->title;
                }, SORT_REGULAR, $sortBool)->all();
            } else {
                $product = Product::orderBy($sortColumn, $sortOrder)->get();
            }
        }

        $select_array = $category;

        return view('product.index', ['products' => $product, 'sortColumn' => $sortColumn, 'sortOrder' => $sortOrder, 'select_array' => $select_array]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $select_values = ProductCategory::all();
        return view('product.create', ['select_values' => $select_values]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        $imageName = 'image' . time() . '.' . $request->image_url->extension();
        $request->image_url->move(public_path('images'), $imageName);
        $product->image_url = $imageName;

        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $select_values = ProductCategory::all();
        return view('product.edit', ['product' => $product, 'select_values' => $select_values]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        $imageName = 'image' . time() . '.' . $request->image_url->extension();
        $request->image_url->move(public_path('images'), $imageName);
        $product->image_url = $imageName;

        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }
}
