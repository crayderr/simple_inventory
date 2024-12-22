<?php

namespace App\Http\Controllers\Api\Product;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\GetProductsResource;
use App\Http\Requests\Products\GetProductsRequest;


class GetProductDetailController extends Controller
{
    public function __invoke(GetProductsRequest $request, string $productId)
    {
        $products = Product::select('id', 'name', 'price', 'description')
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%");
            })
            ->when($request->category, function ($query) use ($request) {
                $query->where('category', 'like', "%{$request->category}%");
            })
            ->where('id', $productId)->first();

            return new GetProductsResource($products);
    }
}