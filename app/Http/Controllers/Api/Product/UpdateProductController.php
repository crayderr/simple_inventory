<?php

namespace App\Http\Controllers\Api\Product;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Deacero\Api\Product\Application\ProductUpdater;
use App\Http\Requests\Products\UpdateProductRequest;

class UpdateProductController extends Controller
{
    public function __invoke(UpdateProductRequest $request, ProductUpdater $service)
    {
        DB::beginTransaction();
        try {
            $service->handle(
                id:           $request->id,
                name:         $request->name,
                description:  $request->description,
                category:     $request->category,
                price:        $request->price,
                sku:          $request->sku,
            );
            DB::commit();
            return response(['success' => true], 200);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }
}
