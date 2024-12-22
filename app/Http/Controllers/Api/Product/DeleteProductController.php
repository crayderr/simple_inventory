<?php

namespace App\Http\Controllers\Api\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Deacero\Api\Product\Application\ProductDeleter;

class DeleteProductController extends Controller
{
    public function __invoke(Request $request, string $productId, ProductDeleter $service)
    {
        DB::beginTransaction();
        try {
            $service->handle(
                id: $productId
            );
            DB::commit();
            return response(['success' => true], 200);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }
}
