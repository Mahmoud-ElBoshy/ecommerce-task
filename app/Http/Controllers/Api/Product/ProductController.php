<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Product\StoreRequest;
use App\Http\Requests\Api\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends BaseApiController
{

    public function index(Request $request)
    {
        $page = $request->page ?? 1;
        $products = Cache::remember('products-page-'.$page, 43200, function () {
            return Product::with('category','user')
                ->paginate(1);
        });
        return response()->json(['data' => $products ,'message' => 'Product retrieved successfully']);
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $product = Product::create($data);
        Cache::flush();
        return response()->json(['data' => $product->load('user','category'),'message' => 'Product created successfully']);
    }

    public function update(UpdateRequest $request)
    {
        $data = $request->validated();
        $product = Product::findOrFail($request->product);
        $product->update($data);
        Cache::flush();
        return response()->json(['data' => $product->load('user','category'),'message' => 'Product updated successfully']);
    }

    public function filter(Request $request)
    {
        $products =  Product::search($request->name,$request->min_price,$request->max_price)->paginate(10);
        return response()->json(['data' => $products,'message' => 'Products retrieved successfully']);
    }

}
