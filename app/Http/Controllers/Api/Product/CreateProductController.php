<?php

namespace App\Http\Controllers\Api\Product;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Deacero\Api\Product\Application\ProductCreator;
use App\Http\Requests\Products\CreateProductRequest;

class CreateProductController extends Controller
{
    public function __invoke(CreateProductRequest $request, ProductCreator $service)
    {
        DB::beginTransaction();
        try {
            $productId = Str::uuid();
            $service->handle(
                id:           $productId,
                name:         $request->name,
                description:  $request->description,
                category:     $request->category,
                price:        $request->price,
                sku:          $request->sku,
            );

            DB::commit();
            return response(['id' => $productId], 201);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }
}
