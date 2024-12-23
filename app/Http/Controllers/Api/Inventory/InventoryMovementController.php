<?php

namespace App\Http\Controllers\Api\Inventory;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\InventoryMovementRequest;
use Deacero\Api\Inventory\Application\InventoryMovementAdder;
use Deacero\Api\Inventory\Application\InventoryMovementCreator;
use Deacero\Api\Inventory\Application\InventoryMovementSubstractor;

class InventoryMovementController extends Controller
{
    public function __invoke(
        InventoryMovementRequest $request,
        InventoryMovementCreator $service,
        InventoryMovementSubstractor $serviceSubstractor,
        InventoryMovementAdder $serviceAdder
        )
    {
        DB::beginTransaction();
        try {
            $inventoryMovementId = Str::uuid();
            $service->handle(
                id:             $inventoryMovementId,
                productId:      $request->product_id,
                sourceStoreId:  $request->source_store_id,
                targetStoreId:  $request->target_store_id,
                quantity:       $request->quantity,
            );

            $serviceSubstractor->handle(
                id:             Str::uuid(),
                productId:      $request->product_id,
                sourceStoreId:  $request->source_store_id,
                targetStoreId:  $request->target_store_id,
                quantity:       $request->quantity,
            );

            $serviceAdder->handle(
                id:             Str::uuid(),
                productId:      $request->product_id,
                sourceStoreId:  $request->source_store_id,
                targetStoreId:  $request->target_store_id,
                quantity:       $request->quantity,
            );

            DB::commit();
            return response(['id' => $inventoryMovementId], 201);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }
}
