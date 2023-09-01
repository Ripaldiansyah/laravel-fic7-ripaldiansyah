<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return ProductResource::collection(Product::paginate(10)) ;
    // return Product::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $product = Product::create([
        ...$request->validate([
            'name' => 'required|string|max:40',
            'description' => 'required|string',
            'price' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'image_url' => 'required',
            'user_id' => auth()->user()->id,
        ]),

        // 'user_id' =>1
       ]);


       return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category', 'user');
      return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update([
            $request->validate([
                'name' => 'required|string|max:40',
                'description' => 'required|string',
                'price' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                'image_url' => 'required',
                'user_id' => auth()->user()->id,
            ]),
        ]);

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response(status:204);
    }
}